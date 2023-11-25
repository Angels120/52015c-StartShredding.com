<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use DateTime;

class UserUsedCoupons extends Model
{
    public $table = "user_used_coupons";
    protected $fillable = ['code', 'user_id'];

}