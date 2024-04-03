<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Redirect;
use DateTime;

use App\Coupon;

class CouponController extends Controller
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
        $this->middleware('auth');
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('admin.coupons', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        $id = 'new';
        $types = explode(',', str_replace('in:', '', explode('|', Coupon::$rules['type'])[1]));
        return view('admin.coupon', compact('id', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        $data = new Coupon();
        $this->validate($request, Coupon::$rules);

        $data->fill($request->all());
        $data->save();
        // $lastid = $data->id;

        Session::flash('message', 'New Coupon Added Successfully.');
        return redirect('admin/coupons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('auth');
        return $id;
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
        $this->middleware('auth');
        $coupon = Coupon::findOrFail($id);
        $types = explode(',', str_replace('in:', '', explode('|', Coupon::$rules['type'])[1]));
        return view('admin.coupon', compact('id', 'coupon', 'types'));
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
        $this->middleware('auth');
        $data = Coupon::findOrFail($id);
        if ($data['code'] === $request['code']) {
            $rules = Coupon::$rules;
            unset($rules['code']);
            $this->validate($request, $rules);
        } else {
            $this->validate($request, Coupon::$rules);
        }
        $data->fill($request->all());
        $data->update();

        Session::flash('message', 'Coupon Updated Successfully.');
        return redirect('admin/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth');
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect('admin/coupons')->with('message', 'Coupon Delete Successfully.');
    }

    public function status($id, $status)
    {
        $this->middleware('auth');
        $coupon = Coupon::findOrFail($id);
        $input['status'] = $status;

        $coupon->update($input);
        Session::flash('message', 'Coupon Status Updated Successfully.');
        return redirect('admin/coupons');
    }

}
