<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class VendorPaymentAccount extends Model
{
    protected $table = 'vendor_payment_accounts';
    protected $fillable = ['vendorid', 'name', 'institution', 'account_number','password','api_url'];
    public $timestamps = false;
}
