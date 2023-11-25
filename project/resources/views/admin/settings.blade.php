@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <h3>General Settings</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="res">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.start -->
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#logo" data-toggle="tab" aria-expanded="true">Logo</a>
                                <li class=""><a href="#favicon" data-toggle="tab" aria-expanded="true">Favicon</a>
                                <li class=""><a href="#website" data-toggle="tab" aria-expanded="false">Website Contents</a>
                                <li class=""><a href="#payment" data-toggle="tab" aria-expanded="false">Payment Settings</a></li>
                                
                                <li class=""><a href="#pickup" data-toggle="tab" aria-expanded="false">PickUp Locations</a>
                                </li>
                                <li class=""><a href="#background" data-toggle="tab" aria-expanded="false">Background</a>
                                </li>
                                <li class=""><a href="#about" data-toggle="tab" aria-expanded="false">About Us</a>
                                </li>
                                <li class=""><a href="#address" data-toggle="tab" aria-expanded="false">Office Address</a>
                                </li>
                                <li class=""><a href="#footer" data-toggle="tab" aria-expanded="false">Footer</a>
                                </li>
                                <li class=""><a href="#delivery" data-toggle="tab" aria-expanded="false">Delivery Fee</a>
                                </li>
                                <li class=""><a href="#donation_amount" data-toggle="tab" aria-expanded="false">Donation Amount</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-xs-12">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="logo">
                                    <p class="lead">Website Logo</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/logo" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Current Logo
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <img class="col-md-6" src="../assets/images/logo/{{$setting[0]->logo}}">
                                            </div>

                                        </div><br>
                                        <!-- <input type="hidden" name="id" value="1"> -->
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Setup New Logo <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="logo" required/>
                                            </div>

                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="favicon">
                                    <p class="lead">Website Favicon</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/favicon" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Current Favicon
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <img class="col-md-3" src="../assets/images/{{$setting[0]->favicon}}">
                                            </div>

                                        </div><br>
                                        <!-- <input type="hidden" name="id" value="1"> -->
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Setup New Favicon <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="favicon" required/>
                                            </div>

                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="website">
                                    <p class="lead">Website Contents</p>

                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/title" class="form-horizontal form-label-left" id="website_form">
                                                {{csrf_field()}}
                                        {{--<input type="hidden" name="_method" value="PUT">--}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> Website Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="title" placeholder="Website Title" required="required" type="text" value="{{$setting[0]->title}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> Popular Tags <span class="required">*</span>
                                            <p class="small-label">Separated By Comma(,)</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12" name="popular_tags" placeholder="Popular Tags" required="required">{{$setting[0]->popular_tags}}</textarea>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> Currency Sign <span class="required">*</span>
                                            <p class="small-label">e.g. $ , &euro;</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="currency_sign" placeholder="Currency Sign" required="required" value="{{$setting[0]->currency_sign}}"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h3>Home Page Customizations</h3>
                                            <hr>
                                            <div class="col-md-6">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Home Slider <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->slider_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="slider_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="slider_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Featured Category <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->category_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="category_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="category_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Small Banners <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->sbanner_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="sbanner_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="sbanner_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Latest Products <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->latestpro_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="latestpro_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="latestpro_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Featured Products <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->featuredpro_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="featuredpro_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="featuredpro_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Subscription <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->subscribe_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="subscribe_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="subscribe_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Large Banner <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->lbanner_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="lbanner_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="lbanner_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Popular Products <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->popularpro_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="popularpro_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="popularpro_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Blog Section <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->blogs_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="blogs_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="blogs_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Testimonial Section <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->testimonial_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="testimonial_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="testimonial_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Brand Logos <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($pageset->brands_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="brands_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="brands_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" id="website_update" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="payment">
                                    <p class="lead">Payment Settings</p>

                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/payment" class="form-horizontal form-label-left" id="website_form">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Paypal Business Account <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="paypal" placeholder="Paypal Business" required="required" type="text" value="{{$setting[0]->paypal_business}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Stripe Key <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="stripe_key" placeholder="Stripe Key" required="required" type="text" value="{{$setting[0]->stripe_key}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Stripe Secret Key <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="stripe_secret" placeholder="Stripe Secret Key" required="required" type="text" value="{{$setting[0]->stripe_secret}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Mobile Money Instruction <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="mobile_money" placeholder="Mobile Money Instruction" required="required" type="text" value="{{$setting[0]->mobile_money}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Bank Information <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="bank_wire" placeholder="Bank Information" required="required" type="text" value="{{$setting[0]->bank_wire}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Dynamic Commission(%) <span class="required">*</span>
                                                <p class="small-label">dynamic commission Charge(product price + commission%)</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="dynamic_commission"  pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                                       title="Shipping Cost must be numeric or up to 2 decimal places." placeholder="Withdraw Charge(%)" required="required" type="text" value="{{$setting[0]->dynamic_commission}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Fixed Commission(FCFA) <span class="required">*</span>
                                                <p class="small-label">Fixed Commission Charge(product price + commission)</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="fixed_commission"  pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                                       title="Shipping Cost must be numeric or up to 2 decimal places." placeholder="Withdraw Charge(%)" required="required" type="text" value="{{$setting[0]->fixed_commission}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> TAX(%) <span class="required">*</span>
                                                <p class="small-label">Dynamic TAX Fee(product price + tax%)</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="tax"  pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                                       title="Shipping Cost must be numeric or up to 2 decimal places." placeholder="Withdraw Charge(%)" required="required" type="text" value="{{$setting[0]->tax}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Withdraw Fee(FCFA) <span class="required">*</span>
                                            <p class="small-label">Static Withdraw Fee</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="withdraw_fee"  pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                                       title="Shipping Cost must be numeric or up to 2 decimal places." placeholder="Withdraw Fee" required="required" type="text" value="{{$setting[0]->withdraw_fee}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Withdraw Charge(%) <span class="required">*</span>
                                            <p class="small-label">Dynamic Withdraw Charge(withdraw amount + withdraw charge%)</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="withdraw_charge"  pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                                       title="Shipping Cost must be numeric or up to 2 decimal places." placeholder="Withdraw Charge(%)" required="required" type="text" value="{{$setting[0]->withdraw_charge}}">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title"> Shipping Cost(FCFA) <span class="required">*</span>
                                            <p class="small-label">(Total amount + shipping cost)</p>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="shipping_cost"  pattern="[0-9]+(\.[0-9]{0,2})?%?"
                                                       title="Shipping Cost must be numeric or up to 2 decimal places." placeholder="Shipping Charge($)" required="required" type="text" value="{{$setting[0]->shipping_cost}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h3>Payment Options</h3>
                                            <hr>
                                            <div class="col-md-6">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Stripe <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($setting[0]->stripe_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="stripe_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="stripe_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Mobile Money <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($setting[0]->mobile_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="mobile_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="mobile_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Cash On Delivery <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($setting[0]->cash_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="cash_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="cash_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Paypal <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($setting[0]->paypal_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="paypal_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="paypal_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-6 col-sm-6 col-xs-12" for="facebook"> Disable/Enable Bank <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        @if($setting[0]->bank_status == 1)
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="bank_status" value="1" data-off="Disabled" checked>
                                                        @else
                                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="bank_status" value="1" data-off="Disabled">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" id="website_update" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="background">
                                    <p class="lead">Background Image</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/background" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Current Background Image
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <img class="col-md-10" src="../assets/images/{{$setting[0]->background}}">
                                            </div>

                                        </div><br>
                                        <!-- <input type="hidden" name="id" value="1"> -->
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Setup New Background <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="background" required="required" />
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="about">
                                    <p class="lead">About Us</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/about" class="form-horizontal form-label-left" id="about_form">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="about"> About Us Text <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea rows="10" cols="60" id="aboutpnael" class="form-control" name="about">{{$setting[0]->about}}</textarea>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" id="about_update" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{--change dilevery fee details--}}
                                <div class="tab-pane" id="delivery">
                                    <p class="lead">Delivery Fee</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/delivery-fee" class="form-horizontal form-label-left" id="about_form">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="about"> Delivery Fee($) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="delivery_fee" value="{{$setting[0]->delivery_fee}}">
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" id="about_update" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{--change donation amount details--}}
                                <div class="tab-pane" id="donation_amount">
                                    <p class="lead">Donation Amount</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/donation-amount" class="form-horizontal form-label-left" id="donation_amount_form">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="about"> Donation Amount ($) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" id="donation_amount" name="donation_amount" value="{{$setting[0]->donation_amount}}" type="number" step="0.01" min="0" onkeypress="return (event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode == 46  || event.charCode == 0">
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button type="submit" id="about_update" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="pickup">
                                    <p class="lead">Pickup Locations</p>
                                    <form method="POST" action="settings/pickup" class="form-horizontal form-label-left">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> PickUp Address <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" placeholder="New Pickup Address" name="address" required="required">
                                            </div>
                                            <div class="col-md-3">
                                                <button id="office_update" type="submit" class="btn btn-success btn-block">Add New Location</button>
                                            </div>
                                        </div>
                                        
                                    </form>
                                  <p class="lead">Current Locations</p>  
                                    <div class="ln_solid"></div>         
				  <table class="table">
				    <thead>
				      <tr>
				        <th>PickUp Address</th>
				      	<th>Action</th>
				      </tr>
				    </thead>
				    <tbody>
				    @foreach($pickups as $pickup)
				      <tr>
				        <td>{{$pickup->address}}</td>
				      	<td><a href="{{url('/')}}/admin/settings/pickup-del/{{$pickup->id}}" class="btn btn-danger btn-xs">Remove</a></td>
				      </tr>
				    @endforeach
				    </tbody>
				  </table>
                                    
                                    
                                    
                                </div>
                                <div class="tab-pane" id="address">
                                    <p class="lead">Office Address</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/address" class="form-horizontal form-label-left" id="about_form">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Street Address <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea rows="3" cols="60" class="form-control col-md-7 col-xs-12" name="address" required="required">{{$setting[0]->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="phone" placeholder="Phone Number" required="required" type="text" value="{{$setting[0]->phone}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax"> Fax <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="fax" placeholder="Fax" required="required" type="text" value="{{$setting[0]->fax}}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="email" placeholder="Email Address" required="required" type="text" value="{{$setting[0]->email}}">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button id="office_update" type="submit" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="footer">
                                    <p class="lead">Website Footer</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="settings/footer" class="form-horizontal form-label-left" id="footer_form">
                                        {{csrf_field()}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="footer"> Footer Text <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea rows="2" cols="60" id="footerpnael" class="form-control" name="footer" required="required">{{$setting[0]->footer}}</textarea>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <!--  <button type="submit" class="btn btn-primary">Cancel</button> -->
                                                <button id="footer_update" type="submit" class="btn btn-success btn-block">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.end -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->



@stop

@section('footer')
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor().panelInstance('aboutpnael');
            new nicEditor().panelInstance('footerpnael');
        });
    </script>
@stop