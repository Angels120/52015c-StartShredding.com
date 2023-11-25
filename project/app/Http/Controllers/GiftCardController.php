<?php

namespace App\Http\Controllers;

use App\GiftCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Redirect;

class GiftCardController extends Controller
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
        $giftcards = GiftCard::where('is_deleted', 0)->where('type', 1)->get();
        return view('admin.giftcards',compact('giftcards'));
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
        return view('admin.giftcard', compact('id'));
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
        $data = new GiftCard();

        $this->validate($request, GiftCard::$rules);
        $data->fill($request->all());

        if ($file = $request->file('image')){
            $photo_name = time().$request->file('image')->getClientOriginalName();
            $file->move('assets/img/gift-cards',$photo_name);
            $data['image'] = $photo_name;
        }

        $data->save();
        // $lastid = $data->id;

        Session::flash('message', 'New Gift Card Added Successfully.');
        return redirect('admin/gift-cards');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('auth');
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('auth');
        $giftcard = GiftCard::findOrFail($id);
        return view('admin.giftcard',compact('id', 'giftcard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware('auth');
        $giftcard = GiftCard::findOrFail($id);
        
        $rules = GiftCard::$rules;

        if (!$request->has('image')) {
            unset($rules['image']);
        }

        if ($giftcard['title'] === $request['title']) {
            unset($rules['title']);
        }

        $this->validate($request, $rules);

        $giftcard->is_deleted = 1;
        $giftcard->update();

        $data = new GiftCard();
        $data->fill($request->all());

        if ($file = $request->file('image')){
            $photo_name = time().$request->file('image')->getClientOriginalName();
            $file->move('assets/img/gift-cards',$photo_name);
            $data['image'] = $photo_name;
        } else {
            $data['image'] = $giftcard['image'];
        }

        $data->save();

        Session::flash('message', 'Gift Card Updated Successfully.');
        return redirect('admin/gift-cards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth');
        $giftcard = GiftCard::findOrFail($id);
        $giftcard->is_deleted = 1;
        $giftcard->update();

        return redirect('admin/gift-cards')->with('message','Gift Card Delete Successfully.');
    }

    public function status($id , $status)
    {
        $this->middleware('auth');
        $giftcard = GiftCard::findOrFail($id);
        $input['status'] = $status;

        $giftcard->update($input);
        Session::flash('message', 'Gift Card Status Updated Successfully.');
        return redirect('admin/gift-cards');
    }
}
