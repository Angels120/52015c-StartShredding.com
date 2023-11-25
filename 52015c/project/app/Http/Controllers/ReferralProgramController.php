<?php

namespace App\Http\Controllers;

use App\ReferralProgram;
use Illuminate\Http\Request;

class ReferralProgramController extends Controller
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
        return view('admin.referral.index')->with(['refPrograms' => ReferralProgram::all()]);
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
        $ReferralProgram = ReferralProgram::find($id);

        if ($ReferralProgram) {
            return view('admin.referral.edit', compact('ReferralProgram'));
        }
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
        $ReferralProgram = ReferralProgram::find($id);

        if ($ReferralProgram) {
            $ReferralProgram->update([
                'name' => $request->name,
                'uri' => $request->uri,
                'limit' => $request->limit,
                'amount' => $request->amount,
                'expire_date' => $request->expire_date
            ]);

            return redirect(url('admin/referrals'));
        }
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
