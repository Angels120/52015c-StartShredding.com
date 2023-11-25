<?php

namespace App\Listeners;

use App\Events\UserReferred;
use App\ReferralLink;
use App\ReferralProgram;
use App\ReferralRelationship;
use App\Transactions;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cookie;
use App\Mail\ReferBonus;

class RewardUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserReferred  $event
     * @return void
     */
    public function handle(UserReferred $event)
    {
        // dd($event->referralId);
        $referral = ReferralLink::where('id', $event->referralId)->first();
        // if ($referral) {
        $referral_programms = ReferralProgram::find($referral->referral_program_id);
        // if (!is_null($referral)) {
        ReferralRelationship::create(['referral_link_id' => $event->referralId, 'user_id' => $event->user->id]);

        // Example...
        if ($referral->program->name === 'Sign-up Bonus') {
            // User who was sharing link
            $provider = $referral->user;
            $provider->balance = $provider->balance + $referral->program->amount;
            $provider->save();
            $provider_name  = $provider->first_name;
            // User who used the link
            $user = $event->user;
            //$user->balance = $referral->program->amount;
            //return $user;
            //$user->save();
            \App\Clients::where('id', '=', $user->id)
                ->update(['balance' => (float) $referral->program->amount]);
            if ((int) $referral->program->amount > 0) {
                $user_pro = \App\Clients::where('id', '=', $user->id)->first();

                $email_subject = \App\Models\EmailSubject::where('token', '=', 'gItwxVXF')
                    ->first();
                $template = \App\Models\EmailTemplate::where('subject_id', '=', $email_subject->id)->first();
                \Illuminate\Support\Facades\Mail::to($provider->email)->send(new ReferBonus($email_subject->subject, $template, $provider_name, $referral->program->amount, $user_pro->name, $user_pro->email));
            }
            // }
            // }
            $item_number = str_random(4) . time();
            //save data to transactions table
            $transactions = new Transactions;
            $transactions['user_id'] = $user->id;
            $transactions['reference_id'] = $item_number;
            $transactions['type'] = 'bonus';
            $transactions['type_id'] = $referral_programms->id;
            $transactions['amount'] = $referral_programms->amount;

            $transactions->save();

            $transactions2 = new Transactions;
            $transactions2['user_id'] = $referral->user->id;
            $transactions2['reference_id'] = $item_number;
            $transactions2['type'] = 'bonus';
            $transactions2['type_id'] = $referral_programms->id;
            $transactions2['amount'] = $referral_programms->amount;

            $transactions2->save();
        }
    }
}
