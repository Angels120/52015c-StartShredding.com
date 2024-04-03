<?php

namespace App\Http\Controllers;

use App\Clients;
use App\ClientType;
use App\VendorCustomers;
use App\Vendors;
use App\Zones;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Clients::leftjoin('client_type', 'clients.client_type', '=', 'client_type.id')
            ->leftjoin('zones', 'clients.zone_id', '=', 'zones.id')
            ->orderBy('clients.id', 'desc')
            ->get(['clients.*', 'client_type.type', 'zones.zone_name']);

        $vendors = Vendors::where('status', 1)
            ->distinct('shop_name')
            ->get();
 
        $client_types = ClientType::all();
        $zones = Zones::all();

        return view('admin.customers', compact('customers', 'vendors', 'client_types', 'zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Clients::findOrFail($id);
        return view('admin.customerdetails', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function email($id)
    {
        $customer = Clients::findOrFail($id);
        return view('admin.sendemail', compact('customer'));
    }

    public function sendemail(Request $request)
    {
        mail($request->to, $request->subject, $request->message);
        return redirect('admin/customers')->with('message', 'Email Send Successfully');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Clients::findOrFail($id);
        $customer->delete();
        return redirect('admin/customers')->with('message', 'Customer Delete Successfully.');
    }

    //Get Clients according to the search value
    public function getCities()
    {
        $city = $_GET['keyword'];

        if (!empty($city)) {
            $cities = Clients::where('city', 'LIKE', '%' . $city . '%')
                ->get();

            if (count($cities) > 0) {
                foreach ($cities as $cit) {
                    $name = "'$cit->city'";

                    echo '<li onclick="selectCity(' . $name . ');"><b>' . $cit->city . '</b></li>';
                }
            } else {
                echo "No results found";
            }
        }
    }

    public function getCustomerSearchResults()
    {
        $query = "";
        
        $store = empty($_POST['store']) ? "" : $_POST['store'];
        $status = empty($_POST['status']) ? "" : $_POST['status'];
        $clientType = empty($_POST['client_type']) ? "" : $_POST['client_type'];
        $zone = empty($_POST['zone']) ? "" : $_POST['zone'];
        $city = empty($_POST['city']) ? "" : $_POST['city'];  

        if (isset($_POST['status']) && $_POST['status'] != "") {
            if($_POST['status'] == 1) {
                $query .= " and c.status = 1";
            } else {
                $query .= " and c.status = 0";
            }            
        }

        if (isset($_POST['client_type']) && $_POST['client_type'] != "") {
            $query .= " and c.client_type = '" . $_POST['client_type'] . "'";
        }

        if (isset($_POST['zone']) && $_POST['zone'] != "") {
            $query .= " and c.zone_id = '" . $_POST['zone'] . "'";
        }

        if (isset($_POST['city']) && $_POST['city'] != "") {
            $query .= " and c.city = '" . trim($_POST['city']) . "'";
        }

        if (isset($_POST['store']) && $_POST['store'] != "") {
            $query .= " and vc.vendor_id = '" . $_POST['store'] . "'";
        }

        if (empty($_POST['store']) || $_POST['store'] == "") {
            $query = "SELECT c.*, ct.type, zo.zone_name FROM clients c
            LEFT JOIN client_type ct ON ct.id=c.client_type
            LEFT JOIN zones zo ON zo.id=c.zone_id
            WHERE 1=1" . $query . " ORDER BY c.id DESC";
        } else {
            $query = "SELECT vp.shop_name, c.*, ct.type, zo.zone_name FROM vendor_customers vc 
                        INNER JOIN vendor_profiles vp ON vp.id = vc.vendor_id
                        INNER JOIN clients c ON c.id = vc.customer_id
                        LEFT JOIN client_type ct ON ct.id=c.client_type
                        LEFT JOIN zones zo ON zo.id=c.zone_id
                        WHERE 1=1" . $query . "ORDER BY c.id DESC";
        }

        $customers = DB::select(DB::raw($query));

        $vendors = Vendors::where('status', 1)
            ->get();

        $client_types = ClientType::all();
        $zones = Zones::all();

        return view('admin.customers', compact('customers', 'status', 'clientType', 'zone', 'city', 'store', 'vendors', 'client_types', 'zones'));
    }

    function assignCustomers()
    {
        $list = $_GET['selectedList'];
        $ven_id = $_GET['vendorId'];

        for($i=0; $i<count($list); $i++) {
            $recAvail = VendorCustomers::where('vendor_id', '=', $ven_id)
                                ->where('customer_id', '=', $list[$i]['cus_id'])
                                ->where('status', 1)
                                ->first();

            if($recAvail == null) {

                $customer = Clients::find($list[$i]['cus_id']);

                VendorCustomers::create([
                    'vendor_id' => $ven_id,
                    'customer_id' => $list[$i]['cus_id'],
                    'phone' => $list[$i]['phone'],
                    'name' => $list[$i]['name'],
                    'business_name' => $customer->business_name,
                    'status' => 1,
                ]);
            }
            
        }

        echo "Customers successfully assigned";

    }
}
