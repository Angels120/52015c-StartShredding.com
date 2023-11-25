<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class VendorUser extends Model
{
    protected $table = 'vendor_members';
    protected $fillable = ['username', 'email','password'];
    public $timestamps = false;
}