<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\UserProfile;
use App\AddressMultiple;
use App\Clients;
use App\Mail\UserRegistrationMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use App\Mail\UserRegisterVerification;
use App\VendorCustomers;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function getAJAXClient()
    {
        $client_id = Input::get('client_id');
        $client = DB::table('clients')
            ->when($client_id, function ($client) use ($client_id) {
                return $client->where('id', '=', '' . $client_id . '');
            })
            ->where('id', '<>', '')
            ->first();
        echo json_encode($client);
    }

    public function getAJAXSearchClient()
    {
        DB::enableQueryLog();
        $keyword = empty(Input::get('keyword')) ? "" : Input::get('keyword');
        $phone = empty(Input::get('phone')) ? "" : Input::get('phone');
        $clients = DB::table('vendor_customers')
            ->when($keyword, function ($clients) use ($keyword) {
                return $clients->where('business_name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($keyword, function ($clients) use ($keyword) {
                return $clients->orWhere('name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($phone, function ($clients) use ($phone) {
                return $clients->where('phone', 'LIKE', '%' . $phone . '%');
            })
            ->where('vendor_id', '=', Auth::user()->id)
            ->where('status', '=', 1)
            ->distinct()
            ->orderBy('name')
            ->get();

        if (count($clients) > 0) {
            echo '<div class="tableDescription">Select a profile to edit</div>';
            echo '<table class="table table-striped table-bordered table-hover" id="searchClientResult">';
            echo "<thead class='res-tbl-head'>";
            echo "<tr>";
            echo "<th class='text-center'>#</td>";
            echo "<th class='text-center'>Customer Name</td>";
            echo "<th class='text-center'>Business Name</td>";
            echo "<th class='text-center'>Phone</th>";
            echo "<th class='text-center'><i class='fa fa-edit'></i></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $i = 1;
            foreach ($clients as $client) {
                echo '<tr class="client" data-id="' . $client->customer_id . '">';
                echo '<td>' . $i . '</td>';
                echo '<td>' . trim($client->name) . '</td>';
                echo '<td>' . trim($client->business_name) . '</td>';
                echo '<td>' . trim($client->phone) . '</td>';
                echo '<td class="vCenter" align="center"><button style="padding: 2px 5px;" class="btn btn-success js-edit_client_button" data-id="' . $client->customer_id . '" onclick="openEditPopup(' . $client->customer_id . ');"><i class="fa fa-edit"></i></button></td>';
                echo '</tr>';

                $i++;
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No results found";
        }
    }

    public function customerAdd()
    {

        if (empty(Input::get('gender'))) {
            return redirect()->back()
                ->with('error', 'Please, select gender!')
                ->withInput();
        }

        $fname = Input::get('first_name');
        $lname = Input::get('last_name');
        $gender = Input::get('gender');
        $phone = Input::get('phone1') . Input::get('phone2') . Input::get('phone3');
        $email = empty(Input::get('email')) ? "" : Input::get('email');
        $address = empty(Input::get('address')) ? "" : Input::get('address');
        $country = empty(Input::get('country')) ? "" : Input::get('country');
        $city = empty(Input::get('city')) ? "" : Input::get('city');
        $province = empty(Input::get('province')) ? "" : Input::get('province');
        $zip = Input::get('zip1') . Input::get('zip2');
        $longi = empty(Input::get('lontude')) ? 0 : Input::get('lontude');
        $lat = empty(Input::get('latude')) ? 0 : Input::get('latude');
        $business_name = empty(Input::get('business_name')) ? "" : Input::get('business_name');

        $user = Clients::create([
            'name' => $fname . ' ' . $lname,
            'first_name' => $fname,
            'last_name' => $lname,
            'gender' => $gender,
            'phone' => $phone,
            'balance' => 0,
            'email' => $email,
            'password' => Hash::make(123),
            'address' => $address,
            'city' => $city,
            'Province_State' => $province,
            'Country' => $country,
            'zip' => $zip,
            'longitude' => $longi,
            'latitude' => $lat,
            'business_name' => $business_name
        ]);

        if (!empty(Input::get('address'))) {
            AddressMultiple::create([
                'user_id' => $user->id,
                'address_alias' => "Default",
                'address' => $address,
                'city' => $city,
                'zip' => $zip,
                'province' => $province,
                'longitude' => $longi,
                'latitude' => $lat,
            ]);
        }

        VendorCustomers::create([
            'vendor_id' => Auth::user()->id,
            'customer_id' => $user->id,
            'phone' => $phone,
            'name' => $fname . ' ' . $lname,
            'business_name' => $business_name,
            'status' => 1
        ]);

        return redirect()->back()
            ->with('message', 'Customer successfully added!');
    }

    public function customerUpdate()
    {
        $client_id = Input::get('hf_client_id');

        $business_name = empty(Input::get('txt_business_name')) ? "" : Input::get('txt_business_name');
        $first_name = Input::get('txt_first_name');
        $last_name = Input::get('txt_last_name');
        $name = $first_name . ' ' . $last_name;
        $gender = Input::get('txt_gender');
        $email = Input::get('txt_email');
        $phone = Input::get('txt_phone1') . Input::get('txt_phone2') . Input::get('txt_phone3');
        $address = empty(Input::get('txt_address')) ? "" : Input::get('txt_address');
        $country = empty(Input::get('txt_country')) ? "" : Input::get('txt_country');
        $city = empty(Input::get('txt_city')) ? "" : Input::get('txt_city');
        $province = empty(Input::get('cmb_province')) ? "" : Input::get('cmb_province');
        $zip = Input::get('txt_fsa1') . Input::get('txt_fsa2');

        $qry = "";
        $qry .= "UPDATE clients set name='" . $name . "', first_name='" . $first_name . "', last_name='" . $last_name . "',";
        $qry .= " gender='" . $gender . "', phone='" . $phone . "', email='" . $email . "', address='" . $address . "', city='" . $city . "',";
        $qry .= " Province_State='" . $province . "', Country='" . $country . "', zip='" . $zip . "', business_name='" . $business_name . "'";
        $qry .= " WHERE id = ?";
        $affected = DB::update($qry, [$client_id]);

        $qry1 = "";
        $qry1 .= "UPDATE multiple_address SET address='".$address."', city='".$city."', zip='".$zip."',";
        $qry1 .= "province='".$province."'";
        $qry1 .= " WHERE user_id = ? AND address_alias=?";
        $affected = DB::update($qry1, [$client_id, 'Default']);

        $qry2 = "";
        $qry2 .= "UPDATE vendor_customers set phone='".$phone."', name='".$name."', business_name='".$business_name."'";
        $qry2 .= "WHERE vendor_id=? AND customer_id = ?";
        $affected = DB::update($qry2, [Auth::user()->id, $client_id]);

        return redirect()->back()
            ->with('message', 'Customer successfully updated!');
    }
}
