<?php

namespace App\Http\Controllers;

use App\User;
use App\Vendors;
use App\VendorPaymentAccount;
use App\VendorUser;
use App\Helper;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VendorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:vendor');
        //$this->userid = Auth::user()->id;
    }

    public function index()
    {
        $vendor = Vendors::find(Auth::user()->id);
        return view('vendor.vendorprofile' , compact('vendor'));
    }

    public function password()
    {
        $vendor = Vendors::find(Auth::user()->id);
        return view('vendor.vendorchangepass' , compact('vendor'));
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
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Vendors::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')){
            $photo = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/vendor',$photo);
            $input['photo'] = $photo;
        }
		
		$section = "company";
		if(isset($_POST['shipping_fee'])){
			$section = "store-settings";	
		}

        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Doesnot match.');
                    return redirect('vendor/settings?section='.$section);
                }
            }else{
                Session::flash('error', 'Vendor Profile Updated Successfully.');
                return redirect('vendor/settings?section='.$section);
            }
        }
        //return $request->cpass;
        //return "Not..";
        $user->update($input);
        Session::flash('message', 'Your Vendor Profile Updated Successfully.');
        return redirect('vendor/settings?section='.$section);
    }

    public function changepass(Request $request, $id)
    {
        $user = Vendors::findOrFail($id);
        $input['password'] = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('error', 'Confirm Password Does not match.');
                    return redirect('vendor/vendorpassword');
                }
            }else{
                Session::flash('error', 'Current Password Does not match');
                return redirect('vendor/vendorpassword');
            }
        }

        $user->update($input);
        Session::flash('message', 'Your Vendor Password Updated Successfully.');
        return redirect('vendor/vendorpassword');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        //
    }
	
	
	public function loginuser(Request $request){
		$response = array('status'=>'error','message'=>'Failed to save');
		$postParams = array('username','email','password');
		$verifyPost = Helper::checkPostParams($postParams);		
		if($verifyPost){
			 
		 	$model = new VendorUser();
		 	if(isset($_POST['id']) && $_POST['id']!="" && is_numeric($_POST['id'])){
		 		$model = VendorUser::find($_POST['id']);
				if($model==null){
					$response['message'] =  'Invalid Request';
					echo json_encode($response);die;
				}
		 	}			
			
        	$model->fill($request->all());
	        $model->vendorid=Auth::user()->id; 
	        if($model->save()){
	        	$response = array('status'=>'success','message'=>'User account saved successfully');
			}						
		}else{
			$response['message'] =  'All Fields are required.';
		}
		echo json_encode($response);die;
	}
	
	public function bankaccount(Request $request){
		$response = array('status'=>'error','message'=>'Failed to save');
		$postParams = array('name','institution','account_number','password','api_url');
		$verifyPost = Helper::checkPostParams($postParams);		
		if($verifyPost){
			 
		 	$model = new VendorPaymentAccount();
		 	if(isset($_POST['id']) && $_POST['id']!="" && is_numeric($_POST['id'])){
		 		$model = VendorPaymentAccount::find($_POST['id']);
				if($model==null){
					$response['message'] =  'Invalid Request';
					echo json_encode($response);die;
				}
		 	}			
			
        	$model->fill($request->all());
	        $model->vendorid=Auth::user()->id;
	        if($model->save()){
	        	$response = array('status'=>'success','message'=>'Bank account saved successfully');
			}						
		}else{
			$response['message'] =  'All Fields are required.';
		}
		echo json_encode($response);die;
	}
	
	public function deletebankaccount()
	{
		$backLink = 'vendor/settings?section=bank-accounts';
		if(isset($_GET['id']) && $_GET['id']!="" && is_numeric($_GET['id'])){
	 		$model = VendorPaymentAccount::find($_GET['id']);
			if($model==null){
				Session::flash('error', 'Bank account not found.');        		
			}else{
				DB::delete('delete from vendor_payment_accounts where id = ?',[$_GET['id']]);
			 	Session::flash('message', 'Bank account deleted successfully.');
			} 
	 	}		
		return redirect($backLink);
	}
	  
	
	public function deleteloginuser(){
		$backLink = 'vendor/settings?section=login-users';
		if(isset($_GET['id']) && $_GET['id']!="" && is_numeric($_GET['id'])){
	 		$model = VendorUser::find($_GET['id']);
			if($model==null){
				Session::flash('error', 'User account not found.');        		
			}else{
				DB::delete('delete from vendor_members where id = ?',[$_GET['id']]);
			 	Session::flash('message', 'User account deleted successfully.');
			}  
	 	}		
		return redirect($backLink);
	}  
	  
}
