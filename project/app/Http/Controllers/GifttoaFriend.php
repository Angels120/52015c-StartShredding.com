<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoughtGiftCard;

class GifttoaFriend extends Controller
{
    //this is the controller for the gift card sent
    
   public function gift($id)
   {
        $send_gc = BoughtGiftCard::with('gift_card')
            ->with('bought_by')
            ->findOrFail($id);
       return view('new_pages.giftcard-friend', compact('send_gc'));
   }
}
