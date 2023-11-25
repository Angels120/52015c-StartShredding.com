<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GiftCode;
use DateTime;
use App\Mail\GiftCodeMail;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use Session;

class GiftCodeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('order-confirm', compact('response', 'user','multiple_address'));
        return view('giftcode');
    }

    public function isUniqueCode(Request $request)
    {
        if (count(GiftCode::where('code', $request['code'])->get()) > 0) {
            return json_encode(['isUniqueCode' => false]);
        } else {
            return json_encode(['isUniqueCode' => true]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['credit_amount'] = 25;
        $request['count'] = 0;
        $date = new DateTime('now');
        $date->modify('+3 month');
        $request['expire_date'] = $date->format('Y-m-d');
        $this->validate($request, GiftCode::$rules);

        $data = new GiftCode();
        $data->fill($request->all());
        $data->save();

        $EmailSubject = EmailSubject::where('token', 'T2b2BENf')->first();
        $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubject['id'])->first();

        Mail::to($data->recipient_emails)->queue(new GiftCodeMail($data, $EmailSubject['subject'], $EmailTemplate));

        Session::flash('message', 'Gift Code send Successfully. Please do not forget to remember your unique Gift Code: ' . $request->code);
        return redirect()->back();
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
