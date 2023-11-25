<?php

namespace App\Http\Controllers;

use App\PageSettings;
use App\Settings;
use App\SiteLanguage;
use App\PickUpLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // //
         $setting = DB::select('select * from settings where id=?',[1]);
         $pickups = PickUpLocations::all();
         $pageset = PageSettings::findOrFail(1);
         return view('admin.settings', compact('setting','pickups','pageset'));
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
        //return $request->all();
        DB::table('settings')
            ->where('id', 1)
            ->update(['title' => $request->title]);
        Session::flash('message', 'Title Updated Successfully.');
        return redirect('admin/settings');
    }

    public function title(Request $request)
    {
        $homesections = PageSettings::findOrFail(1);

        $input['slider_status'] = 1;
        $input['category_status'] = 1;
        $input['sbanner_status'] = 1;
        $input['latestpro_status'] = 1;
        $input['featuredpro_status'] = 1;
        $input['lbanner_status'] = 1;
        $input['popularpro_status'] = 1;
        $input['blogs_status'] = 1;
        $input['testimonial_status'] = 1;
        $input['brands_status'] = 1;
        $input['subscribe_status'] = 1;

        if ($request->slider_status != 1){
            $input['slider_status'] = 0;
        }
        if ($request->category_status != 1){
            $input['category_status'] = 0;
        }
        if ($request->sbanner_status != 1){
            $input['sbanner_status'] = 0;
        }
        if ($request->latestpro_status != 1){
            $input['latestpro_status'] = 0;
        }
        if ($request->featuredpro_status != 1){
            $input['featuredpro_status'] = 0;
        }
        if ($request->lbanner_status != 1){
            $input['lbanner_status'] = 0;
        }
        if ($request->popularpro_status != 1){
            $input['popularpro_status'] = 0;
        }
        if ($request->blogs_status != 1){
            $input['blogs_status'] = 0;
        }
        if ($request->testimonial_status != 1){
            $input['testimonial_status'] = 0;
        }
        if ($request->brands_status != 1){
            $input['brands_status'] = 0;
        }
        if ($request->subscribe_status != 1){
            $input['subscribe_status'] = 0;
        }

        $tags = str_replace(', ',',',$request->popular_tags);
        DB::table('settings')
            ->where('id', 1)
            ->update(['title' => $request->title,'currency_sign' => $request->currency_sign,'popular_tags' => $tags]);

        $homesections->update($input);

        Session::flash('message', 'Website Content Updated Successfully.');
        return redirect('admin/settings');
    }

    public function themecolor(Request $request)
    {
        $color = Settings::findOrFail(1)->theme_color;

        $actual_path = str_replace('project','',base_path());
        $style1 = $actual_path.'assets/css/go-style.css';
        $style2 = $actual_path.'assets/css/style.css';

        $file1_contents = file_get_contents($style1);
        $file2_contents = file_get_contents($style2);
        $file1_contents = str_replace($color,$request->color,$file1_contents);
        $file2_contents = str_replace($color,$request->color,$file2_contents);
        file_put_contents($style1,$file1_contents);
        file_put_contents($style2,$file2_contents);

        DB::table('settings')
            ->where('id', 1)
            ->update(['theme_color' => $request->color]);

        Session::flash('message', 'Theme Color Updated Successfully.');
        return redirect('admin/themecolor');
    }

    public function payment(Request $request)
    {
        $paypal = 0;
        $stripe = 0;
        $mobile = 0;
        $bank = 0;
        $cash = 0;
        if ($request->paypal_status == 1){
            $paypal = 1;
        }
        if ($request->stripe_status == 1){
            $stripe = 1;
        }
        if ($request->mobile_status == 1){
            $mobile = 1;
        }
        if ($request->bank_status == 1){
            $bank = 1;
        }
        if ($request->cash_status == 1){
            $cash = 1;
        }

        DB::table('settings')
            ->where('id', 1)
            ->update([
                'paypal_business' => $request->paypal,
                'stripe_key' => $request->stripe_key,
                'stripe_secret' => $request->stripe_secret,
                'dynamic_commission' => $request->dynamic_commission,
                'fixed_commission' => $request->fixed_commission,
                'tax' => $request->tax,
                'mobile_money' => $request->mobile_money,
                'bank_wire' => $request->bank_wire,
                'shipping_cost' => $request->shipping_cost,
                'withdraw_fee' => $request->withdraw_fee,
                'withdraw_charge' => $request->withdraw_charge,
                'paypal_status' => $paypal,
                'stripe_status' => $stripe,
                'mobile_status' => $mobile,
                'bank_status' => $bank,
                'cash_status' => $cash
            ]);

        Session::flash('message', 'Payment Informations Updated Successfully.');
        return redirect('admin/settings');
    }

    //Payment Old
    public function payment_old(Request $request)
    {

        DB::table('settings')
            ->where('id', 1)
            ->update(['paypal_business' => $request->paypal,'stripe_key' => $request->stripe_key,'stripe_secret' => $request->stripe_secret,'withdraw_fee' => $request->withdraw_fee,'withdraw_charge' => $request->withdraw_charge]);

        Session::flash('message', 'Payment Informations Updated Successfully.');
        return redirect('admin/settings');
    }

    public function about(Request $request)
    {
        //return $request->all();
        DB::table('settings')
            ->where('id', 1)
            ->update(['about' => $request->about]);


        Session::flash('message', 'About Us Text Updated Successfully.');
        return redirect('admin/settings');
    }
    /*delivery fee update*/
    public function delivery_fee(Request $request)
    {
        //return $request->all();
        DB::table('settings')
            ->where('id', 1)
            ->update(['delivery_fee' => $request->delivery_fee]);


        Session::flash('message', 'About Us Text Updated Successfully.');
        return redirect('admin/settings');
    }

    /* Update Donation Amount */
    public function updateDonationAmount(Request $request)
    {
        //return $request->all();
        DB::table('settings')
            ->where('id', 1)
            ->update(['donation_amount' => $request->donation_amount]);

        Session::flash('message', 'Donation Amount Updated Successfully.');
        return redirect('admin/settings');
    }

    public function address(Request $request)
    {
        //return $request->all();
        DB::table('settings')
            ->where('id', 1)
            ->update(['address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'email' => $request->email]);
        Session::flash('message', 'Address Updated Successfully.');
        return redirect('admin/settings');
    }

    public function footer(Request $request)
    {
        //return $request->all();
        DB::table('settings')
            ->where('id', 1)
            ->update(['footer' => $request->footer]);
        Session::flash('message', 'Footer Updated Successfully.');
        return redirect('admin/settings');
    }

    public function logo(Request $request)
    {
        $logo = $request->file('logo');
        $name = $logo->getClientOriginalName();
        $logo->move('assets/images/logo',$name);
        DB::table('settings')
            ->where('id', 1)
            ->update(['logo' => $name]);
        Session::flash('message', 'Website Logo Updated Successfully.');
        return redirect('admin/settings');
    }

    public function favicon(Request $request)
    {
        $logo = $request->file('favicon');
        $name = $logo->getClientOriginalName();
        $logo->move('assets/images/',$name);
        DB::table('settings')
            ->where('id', 1)
            ->update(['favicon' => $name]);
        Session::flash('message', 'Website Favicon Updated Successfully.');
        return redirect('admin/settings');
    }

    public function background(Request $request)
    {
        //return $request->all();

        ///return redirect('admin/settings');
        $logo = $request->file('background');
        $name = $logo->getClientOriginalName();
        $logo->move('assets/images',$name);
        DB::table('settings')
            ->where('id', 1)
            ->update(['background' => $name]);
        Session::flash('message', 'Background Image Updated Successfully.');
        return redirect('admin/settings');
    }

    public function setlanguage()
    {
        $language = SiteLanguage::findOrFail(1);
        return view('admin.language',compact('language'));
    }

    public function language(Request $request)
    {
        $language = SiteLanguage::findOrFail(1);
        $data = $request->all();
        $language->update($data);
        return redirect('admin/language-settings')->with('message','Website Language Updated Successfully.');
    }

    public function pickup(Request $request)
    {
        $pickl = new PickUpLocations();
        $pickl->address = $request->address;
        $pickl->save();
        return redirect('admin/settings')->with('message','New Pickup Location Added Successfully.');
    }
    
    public function pickdel($id)
    {
        $pickl = PickUpLocations::findOrFail($id);
        $pickl->delete();
        return redirect('admin/settings')->with('message','Pickup Location Deleted Successfully.');
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
        //
        //return $request->all();

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
}
