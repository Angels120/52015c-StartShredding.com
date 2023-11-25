<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTemplateItem extends Model
{
protected $fillable = ['order_template_id','product_id','base_price','qty','item_note'];
}
