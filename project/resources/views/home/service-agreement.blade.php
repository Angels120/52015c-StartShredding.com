@extends('home.shop.user.new_main')
@section('title','My Account')
@section('content')

<style>
    .order-div {
        width: 55%;
        margin-left: 2%;
        background-color: #fffefa;
        border: 1px solid #FFF0A6;
        border-radius: 7px;
    }
    .client-info {
        width: 43%;
        border: 1px solid #e5e5e5;
        border-radius: 7px;
    }
    #selector select.input-lg {
        height: 25px !important;
        line-height: 25px !important;
    }
    .form-group-default.input-group .form-input-group {
        position: relative;
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        width: 1%;
        margin-bottom: 0;
    }

    #selector i {
    font-size: 16px;
    font-weight: bold;
    color: rgba(75, 75, 75, 0.67);
    }
    [class^="icon-"], [class*=" icon-"] {
        font-family: 'icomoon' !important;
        speak: never;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    select + i {
        float: right;
        margin-top: -32px;
        margin-right: 9px;
        pointer-events: none;
        padding-right: 5px;
    }
    .mt-year{
        margin-top:8px;
    }
    .credit-card .form-group-default .form-control, .credit-card .form-group .form-control {
        font-size: 16px !important;
    }
    .mh-55 {
        min-height: 54px;
    }
    .slide-left label, .slide-right label {
        font-size: 11px !important;
    }
    canvas {
    width: 275px;
    height: 125px;
    border: 1px solid rgba(224, 224, 224, 0.7);
    border-radius: 5px;
}
.signature-pad-container {
	width: 275px;
    height: 125px;
    position: relative;
    background-color: white;
}
#clear_button {
    cursor: pointer;
}
#finish_button {
    cursor: pointer;
}
.pay-invoice .card-controls .demo-fs-23 {
	margin: 0;
}
.invoice-logo {
	margin-left: 7px;
}
.borderless th {
    border: none;
}
.iframe-container {
	overflow: hidden;
	width: 275px;
    height: 245px; 
	position: relative;
  }
  .iframe-container iframe {
	 border: 0;
	 height: 100%;
	 left: 0;
	 position: absolute;
	 top: 0;
	 width: 100%;
  }
  .sig-pad {
	  width: 300px;
	  margin: 0 auto;
  }
  .tab-pane ol,.tab-pane ul {
	  padding-left: 12px;
  }
  .sign-pad-iframe {
	   width: 35%;
   }
   .sign-note {
	width: 60%;
    }
</style>

    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  p-b-50 m-t-40">
            <div class="row">
                
            <div id="rootwizard" class="m-t-10">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm" role="tablist" id="top">
                        <li class="nav-item">
                          <a class="active d-flex align-items-center" data-toggle="tab" href="#tab1" data-target="#tab1" role="tab"><i class="icon-user fs-14 tab-icon"></i> <span>Client information</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="d-flex align-items-center" data-toggle="tab" href="#tab2" data-target="#tab2" role="tab"><i class="icon-file-text1 fs-14 tab-icon"></i> <span>Terms and Conditions</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="d-flex align-items-center" data-toggle="tab" href="#tab3" data-target="#tab3" role="tab"><i class="icon-credit-card1 fs-14 tab-icon"></i> <span>Credit card information</span></a>
                        </li>
                        <!--li class="nav-item">
                          <a class="d-flex align-items-center" data-toggle="tab" href="#tab4" data-target="#tab4" role="tab"><i class="material-icons fs-14 tab-icon">done</i> <span>Summary</span></a>
                        </li-->
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                        
                        <div class="tab-pane padding-20 sm-no-padding active slide-left" id="tab1">
                          <div class="row row-same-height">
                            <div class="client-info sm-m-b-3">
                              <div class="pl-4 pr-4 row-same-height">
                                <div class="row sm-p-0">
                                  <div class="main-title mt-4 ml-1">
                                    <h3 class="font-montserrat bold fs-16 bold all-caps no-margin">Client info</h3>
                                  </div>
                                </div>
                                <div class="row clearfix mb-1 sm-p-0 mt-4">
                                    <div class="col-md-6">
                                      <div class="form-group form-group-default required">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="companyName" placeholder="Company Name" value="<?php echo $order->customer_name?>" required>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group form-group-default required">
                                        <label>Contact Name</label>
                                        <input type="text" class="form-control" name="contactName" placeholder="Contact Name" value="<?php echo $order->customer_name?>" required>
                                       </div>
                                    </div>
                                  </div>  
                                 <div class="row clearfix mb-2">
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default required">
                                      <label>Phone</label>
                                      <input id="phone" type="tel" pattern="\d{3}\-\d{3}\-\d{4}" class="form-control telephone" data-mask="(999)-999-9999" placeholder="(999)-999-9999" value="<?php echo $order->customer_phone?>"  required />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email" value="<?php echo $order->customer_email?>"  placeholder="joan@lifeforcephysio.com">
                                    </div>
                                  </div>
                                </div>
                               <p class="font-montserrat bold fs-16 bold mt-3 mb-3">Billing Address</p>
                               <div class="row clearfix mb-1">
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default required">
                                      <label>Addresss Line 1</label>
                                      <input type="text" class="form-control" id="bill-firstName" name="firstName" placeholder="577" value="<?php echo $customer->address?>"  required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Addresss Line 2</label>
                                      <input type="text" class="form-control" id="bill-lastName" name="lastName" placeholder="Burnhamthorpe Road">
                                    </div>
                                  </div>
                                </div>
                                <div class="row clearfix mb-1">
                                  <div class="col-md-4">
                                    <div class="form-group form-group-default required">
                                      <label>City</label>
                                      <input type="text" class="form-control" id="bill-city" name="city" value="<?php echo $customer->city?>"  placeholder="Toronto" required>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                      <label>State/Province/Region</label>
                                      <input type="text" class="form-control" id="bill-state" name="state" value="<?php echo $customer->Province_State?>"  placeholder="Ontario">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group form-group-default required">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control" id="bill-postal" name="postal"  placeholder="M9C 2Y3" required>
                                    </div>
                                  </div>
                                </div>
                              <div class="row clearfix mb-2">
                                <div class="col-md-6">
                                  <div class="form-group form-group-default required">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" id="bill-phoneNumber" name="phoneNumber" value="<?php echo $customer->phone?>"  id="phoneNumber2" value="" placeholder="(999)-999-9999">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group form-group-default">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="bill-email" name="email" value="<?php echo $customer->email?>"  placeholder="joan@lifeforcephysio.com">
                                  </div>
                                </div>
                              </div>
                              <div class="serv-check justify-content-between d-inline-flex w-100">
                                <p class="font-montserrat bold fs-16 bold mt-3 mb-3">Shipping Address</p>
                                <div class="form-check primary mt-1">
                                  <input type="checkbox" onclick="checkBox(this)" id="defaultCheck">
                                  <label for="defaultCheck" class="bold">
                                    Same as Billing
                                  </label>
                                </div>
                              </div>
                                <div class="row clearfix mb-1">
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default required">
                                      <label>Addresss Line 1</label>
                                      <input type="text" class="form-control" id="shipp-firstName" name="firstName" placeholder="577" required>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                      <label>Addresss Line 2</label>
                                      <input type="text" class="form-control" id="shipp-lastName" name="lastName" placeholder="Burnhamthorpe Road">
                                    </div>
                                  </div>
                                </div>
                                <div class="row clearfix mb-1">
                                  <div class="col-md-4">
                                    <div class="form-group form-group-default required">
                                      <label>City</label>
                                      <input type="text" class="form-control" id="shipp-city" name="city" placeholder="Toronto" required>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                      <label>State/Province/Region</label>
                                      <input type="text" class="form-control" id="shipp-state" name="state" placeholder="Ontario">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group form-group-default required">
                                      <label>Postal Code</label>
                                      <input type="text" class="form-control" id="shipp-postal" name="postal" placeholder="M9C 2Y3" required>
                                    </div>
                                  </div>
                                </div>
                              <div class="row clearfix mb-5">
                                <div class="col-md-6">
                                  <div class="form-group form-group-default required">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" id="shipp-phoneNumber" name="phoneNumber" id="phoneNumber3" value="" placeholder="(999)-999-9999">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group form-group-default">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="shipp-email" name="email" placeholder="joan@lifeforcephysio.com">
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            <div class="order-div row-same-height">
                              <div class="pl-4 pr-4 row-same-height">
                              <div class="row sm-p-0">
                                <div class="main-title mt-4 ml-1">
                                  <h3 class="font-montserrat bold fs-16 bold all-caps no-margin">Order info</h3>
                                </div>
                              </div>
                              <div class="row mb-3 sm-p-0 mt-4"> 
                                <div class="col-md-6 mb-2">
                                  <!--label>Pick Up Date</label>
                                  <div class="input-group date">
                                    <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                                      <input class="form-control" type="text" readonly />
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                  </div>
                                  </div-->
                                  <h5 class="all-caps fs-14 mt-1 mb-1">Service Date</h5>
                                  <div class="form-group form-group-default input-group col-md-10">
                                    <div class="form-input-group">
                                      <label>Pick Up Date</label>
                                      <input type="text" class="form-control" placeholder="Pick Up Date" id="datepicker-component2">
                                    </div>
                                    <div class="input-group-append ">
                                      <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <h5 class="all-caps fs-14 mt-1 mb-1">Hours of operations</h5>
                                  <div class="row">
                                    <div class="col-md-6 mb-2">
                                     <div class="form-group form-group-default input-group col-md-12 time-group">
                                        <div class="form-input-group">
                                          <label>From</label>
                                          <div id="selector">
                                            <select class="form-control input-lg">
                                              <option>7.00AM</option>
                                              <option selected="selected">8.00AM</option>
                                              <option>9.00AM</option>
                                              <option>10.00AM</option>
                                              <option>11.00AM</option>
                                              <option>12.00PM</option>
                                              <option>1.00PM</option>
                                              <option>2.00PM</option>
                                              <option>3.00PM</option>
                                              <option>4.00PM</option>
                                              <option>5.00PM</option>
                                              <option>6.00PM</option>
                                              <option>7.00PM</option>
                                           </select>
                                            <i class="icon-clock1"></i>
                                           </div>
                                         </div>
                                      </div>
                                    </div>  
                                    <div class="col-md-6 mb-2">
                                      <div class="form-group form-group-default input-group col-md-12 time-group">
                                        <div class="form-input-group">
                                          <label>To</label>
                                          <div id="selector">
                                            <select class="form-control input-lg">
                                              <option>7.00AM</option>
                                              <option>8.00AM</option>
                                              <option>9.00AM</option>
                                              <option>10.00AM</option>
                                              <option>11.00AM</option>
                                              <option>12.00PM</option>
                                              <option>1.00PM</option>
                                              <option>2.00PM</option>
                                              <option>3.00PM</option>
                                              <option>4.00PM</option>
                                              <option selected="selected">5.00PM</option>
                                              <option>6.00PM</option>
                                              <option>7.00PM</option>
                                           </select>
                                            <i class="icon-clock1"></i>
                                           </div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                               <div class="col-lg-12 col-sm-12">
                                  <div class="row sm-p-0">
                                   <div class="table-responsive table-orderinfo">
                                      <table class="table borderless no-margin">
                                        <thead>
                                          <tr>
                                            <th class="fs-14 font-montserrat text-center bold">QTY</th>
                                            <th class="fs-14 font-montserrat text-center bold">Item</th>
                                            <th class="fs-14 font-montserrat text-center bold">Rate</th>
                                            <th class="fs-14 font-montserrat text-left bold" width="5%">Total</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php $sub_total=0;?>
                                          @foreach($order_details as $item)
                                          <tr>
                                            <td class="text-center"><?php echo $item->quantity?></td>
                                            <td class="text-center"><?php echo $item->title?></td>
                                            <td class="text-center">$<?php echo number_format($item->cost/$item->quantity,2,'.', '') ?></td>
                                            <td class="text-left">$<?php echo number_format($item->cost,2,'.', '')?></td>
                                          </tr>
                                            <?php $sub_total+=$item->cost; ?>
                                          @endforeach
                                          
                                          <tr>
                                            <td class="text-right" colspan="3">Sub Total</td>
                                            <td class="text-left bold">$<?php echo number_format((float)$sub_total,2,'.', '');?></td>
                                          </tr>
                                          <tr>
                                            <td class="text-center" colspan="2"></td>
                                            <td class="text-right">HST(13%)</td>
                                            <?php $hst = $sub_total*0.13;?>
                                            <td class="text-left">$<?php echo number_format((float)$hst,2,'.','');?></td>
                                          </tr>
                                          <tr>
                                            <td class="text-center" colspan="3">
                                              <div class="popdiv text-right">
                                                <img class="makeitcounticon" src="assets/img/ribon.jpg"> Make It Count <a id="popover-div"  target="_blank" rel="popover" title="Make It Count"><i class="icon-info1 fs-16 bold color-danger"></i></a> 
                                              </div>
                                            </td>
                                            <td class="text-left">
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bold">$</span>
                                                </div>
                                                <input type="number" min="0" step="0.01" value="0.75" class="form-control">
                                            </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="text-right bold" colspan="3">
                                              Estimated Grand Total
                                            </td>
                                            <td class="text-left font-montserrat demo-fs-23 bold fs-sm-18">$<?php echo number_format((float)$sub_total+$hst,2,'.','');?></td>
                                          </tr>
                                        </tbody>
                                     </table>
                                    </div>
                                    <p class="fs-14 mt-5">The Grand Total and Line amounts displayed are estimates based on the quantity displayed. The final amount for invoicing and payment may change
                                      depending on the final quantity of materials received and if there are any applicable surcharges as outlined in the Terms and Conditions of this agreement.</p>
                                    </div> 
                                   </div>  
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane padding-20 sm-no-padding" id="tab2">
                          <div class="row row-same-height">
                           <div class="col-md-12">
                               <h3 class="font-montserrat">Terms and Conditions</h3>
                               <p>This AGREEMENT is entered into between <b>SHREDEX INC.</b>a corporation incorporated under the laws of the Province of Ontario (hereinafter referred to
                                as “SHREDEX”, “CONTRACTOR”, “Company”, “Supplier”, “Seller”, “Service Provider”, or “Vendor”), and Life Force Physiotherapy (hereinafter referred to
                                as the “Client” or “Customer”). The laws of the Province of Ontario shall control this Agreement and any documents to which it is appended.</p>
                             <ol>
                               <li><span class="font-montserrat bold">Scheduling</span>
                                 <p>In order to reduce costs to our clients, our routes are scheduled for maximum efficiency. We will make every attempt to provide service to you at a
                                  time that is most convenient, however we can only guarantee that service will be done between our operating hours of 8am to 5pm, unless certain
                                  times are specifically requested. You may contact our dispatch office on the day of your pick up to request a narrower time window, for your
                                  convenience. If additional material is presented to us upon our arrival at your facility, we will do our best to complete the entire job on the same
                                  day. However, if our prior commitments to other clients prevent us from completing the job, we will re-schedule a pickup of your additional items on
                                  another day. Please note that this will result in additional costs for travel and shredding time.</p>
                               </li>
                               <li><span class="font-montserrat bold">Definition of File Boxes</span>
                                 <p>When rates are provided based on a per ‘file box’ basis, we refer to boxes that measure 15”D x 10”W x 12” H. If your boxes are not the same
                                  dimension, you will be notified by our driver if there will be changes to your rates, depending on the size of the boxes.</p>
                               </li>
                               <li><span class="font-montserrat bold">Location of Documents</span>
                                 <p>Unless specified in the Pickup Confirmation document, Quotes are provided with the understanding that your documents/materials will be located
                                  in an area that will be readily accessible to our employees upon arrival. Materials should be at ground floor level, no greater than 30 feet from the
                                  doorway access, or loading dock area. If documents are not within these parameters, our staff will inform you immediately if any additional charges
                                  will occur, prior to commencing service. A Labour Charge of $2.00 per box will be applied for every 10 steps either up or down, if boxes need to be
                                  manually moved to ground level.</p>
                               </li>
                               <li><span class="font-montserrat bold">Quoted Rates</span>
                                 <p>We offer competitive pricing based on volume, scheduled date of pickup, and the type of service required. If there is a change in the parameters of
                                  the service you requested (ie. Change in quantity of material, or additional labour required to collect materials), you will be notified by our Customer
                                  Service Representative prior to commencement of the job. Changes in your service may result in higher or lower pricing than your quoted rate.
                                  </p>
                               </li>
                               <li><span class="font-montserrat bold">Payment Terms</span>
                                 <p>Our payment terms for non-contract clients are COD. We accept Visa and Mastercard, as well as a company or personal cheque. Cash payments
                                  are accepted, but please note that our drivers cannot make change, therefore exact payment will be required. A $25.00 NSF Fee will apply for
                                  Credit Card Payments that are declined. A $50.00 NSF Fee is applicable for cheque payments that are returned for insufficient funds. In addition,
                                  the Client shall be liable for the <b>shredEX</b>'s expenses for the collection of any unpaid debt including but not limited to termination fees, interest
                                  expenses, court filing fees and legal costs.</p>
                               </li>
                               <li><span class="font-montserrat bold">Cancellation Fee</span>
                                 <p>A Cancellation Fee of $125.00 or 50% of the service order value (whichever is greater) will apply for any service cancelled with less than 24 hours
                                  notice. For Mobile Shredding Service the Cancellation Fee of $250.00 or 100% of the Service Order Value, applies if the service is cancelled with
                                  less than 72 hours notice.</p>
                               </li>
                               <li><span class="font-montserrat bold">Parking Tickets</span>
                                 <p><b>shredEX</b> will make every effort to legally park for the duration of the service. However, the Client agrees to pay for any parking tickets incurred by
                                 <b>shredEX</b> while providing service to the Client, plus a $25.00 administration fee.</p>
                               </li>
                               <li><span class="font-montserrat bold">Payments and Invoices</span>
                                 <p>The Client agrees to pay <b>shredEX</b> for all services rendered. If the Client is delinquent in payment of fees or any other charges due under this
                                  agreement for more than thirty one (31) days, the Client agrees to pay and administration of $7.50 per month per overdue invoice or calculated as
                                  an interest at the rate of 28% per annum, whichever is greater. This fee is continually applied monthly until the balance is paid in full. A $25.00 NSF
                                  Fee will apply for Credit Card or Electronic Fund Transfer Payments that are declined. A $50.00 NSF Fee is applicable for cheque payments that
                                  are returned for insufficient funds.</p>
                                  <p class="bold">If you have any questions regarding this Agreement, please contact your Account Manager at 416-255-1500 or send an email to <a href="mailto:info@shredex.ca">info@shredex.ca</a>
                                  </p>
                               </li>
                             </ol>
                             <div class="row">
                              <div class="col-12 mt-3">
                                <div class="form-check primary m-t-0 ml-2 text-right">
                                  <input type="checkbox" value="1" id="checkbox-agree" required>
                                  <label for="checkbox-agree" class="fs-16 bold font-montserrat">The undersigned hereby agrees to this agreement, on behalf of the
                                    Client.
                                  </label>
                                  <div id="checkbox-agree-valid"></div>
                                </div>
                              </div>
                             </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane slide-left padding-20 sm-no-padding" id="tab3">
                        <div class="row column-seperation">
                        <div class="col-lg-12">
                           <div class="credit-derails">
                              <div class="sm-padding-5">
                                <!-- <form role="form"> -->
                                  <div class="bg-contrast-lower b-rad-lg credit-card">
                                    <h3 class="font-montserrat pull-left no-margin p-sm-b-3">Credit Card</h3>
                                    <ul class="list-unstyled pull-right list-inline sm-pull-left sm-p-0">
                                      <li>
                                        <a href="#">
                                          <img width="51" height="32" data-src-retina="home_assets/images/form-wizard/visa2x.png" data-src="home_assets/images/form-wizard/visa.png" class="brand" alt="logo" src="home_assets/images/form-wizard/visa.png">
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#" class="hint-text">
                                          <img width="51" height="32" data-src-retina="home_assets/images/form-wizard/mastercard2x.png" data-src="home_assets/images/form-wizard/mastercard.png" class="brand" alt="logo" src="home_assets/images/form-wizard/mastercard.png">
                                        </a>
                                      </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <div class="form-group form-group-default required m-t-25">
                                      <label>Card holder's name</label>
                                      <input type="text" class="form-control" placeholder="Name on the card" value="<?php echo $card_details->card_holder_name?>" required>
                                    </div>
                                    <div class="form-group form-group-default required">
                                      <label>Card number</label>
                                      <!--input type="text" class="form-control" placeholder="8888-8888-8888-8888" required-->
                                      <input type="text" class="form-control card-no" name="card-num" placeholder="8888 8888 8888 8888" value="<?php echo $card_details->card_number?>" size="18" id="cr_no" minlength="19" maxlength="19" required>
                                    </div>
                                      <div class="card-date mb-3 w-100">
                                         <div class="row no-margin">
                                          <div class="col-md-3 no-padding-sm">
                                            <label class="fs-14"><b>Expiration</b></label>
                                            <div class="form-group form-group-default input-group time-group">
                                              <div class="form-input-group">
                                                <label class="fade">Month</label>
                                                <div id="selector">
                                                  <select class="form-control input-lg">
                                                    <option selected="selected">Jan (01)</option>
                                                    <option>Feb (02)</option>
                                                    <option>Mar (03)</option>
                                                    <option>Apr (04)</option>
                                                    <option>May (05)</option>
                                                    <option>Jun (06)</option>
                                                    <option>Jul (07)</option>
                                                    <option>Aug (08)</option>
                                                    <option>Sep (09)</option>
                                                    <option>Oct (10)</option>
                                                    <option>Nov (11)</option>
                                                    <option>Dec (12)</option>
                                                 </select>
                                                 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                 </div>
                                               </div>
                                            </div>
                                          </div>
                                          <div class="col-md-3 no-padding-sm">
                                            <label class="d-none-sm fs-14"></label>
                                            <div class="form-group form-group-default input-group time-group mt-year">
                                              <div class="form-input-group">
                                                <label class="fade">Year</label>
                                                <div id="selector">
                                                  <select class="form-control input-lg">
                                                    <option selected="selected">2022</option>
                                                    <option>2023</option>
                                                    <option>2024</option>
                                                    <option>2025</option>
                                                    <option>2026</option>
                                                    <option>2027</option>
                                                    <option>2028</option>
                                                    <option>2029</option>
                                                    <option>2030</option>
                                                 </select>
                                                 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                 </div>
                                               </div>
                                            </div>
                                          </div>
                                          <div class="col-md-2 p-0">
                                            <label class="fs-14 m-25 sm-ml-0"><b>CCV Code</b></label>
                                              <div class="form-group required">
                                                <input class="form-control mh-55 m-25 sm-ml-0" type="password" name="ccv" value="<?php echo $card_details->ccv?>" placeholder="000" size="1" minlength="3" maxlength="3" required>
                                              </div>
                                          </div>
                                        </div>
                                       </div>
                                    </div>
                                <!-- </form> -->
                              </div>
                              <div class="row">
                                <div class="sign-pad-iframe">
                                  <div class="iframe-container ml-5 ml-m-3">
                                    <iframe src="/new_assets/signature.html"></iframe>
                                  </div>
                                </div>
                                <div class="sign-note">
                                  <p class="fs-14">By digitally Signing this Agreement, and electronically entering your name on this form, you hereby attest to being authorized to provide the Credit Card information above, and hereby authorize <b>SHREDEX INC.</b> to post charges for services rendered, including any Cancellation Fees, Late Fee and any additional charges as outlined in the Terms and Conditions of this Agreement</p>
                                </div> 
                              </div>
                            </div>
                          </div>
                          </div>
                          </div>
                         <!--div class="tab-pane slide-left padding-20 sm-no-padding" id="tab4">
                          <h1>Thank you.</h1>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et bibendum diam. Nunc facilisis nibh vitae sagittis luctus. Suspendisse aliquet purus nec vestibulum molestie. Maecenas sollicitudin efficitur ornare. Maecenas odio leo, lobortis eget libero id, dictum tincidunt libero.</p>
                         </div-->
                        <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                          <ul class="pager wizard no-style">
                            <li class="next">
                              <button aria-label="" class="btn btn-primary btn-cons from-left pull-right" type="button">
                                <span><a href="#top">Next</a></span>
                              </button>
                            </li>
                            <li class="next finish hidden">
                              <a href="thankyou.html">
                                <button aria-label="" class="btn btn-primary btn-cons from-left pull-right" type="submit">
                                  <span>Confirm</span>
                                </button>
                              </a>
                            </li>
                            <li class="previous first hidden">
                              <button aria-label="" class="btn btn-default btn-cons from-left pull-right" type="button">
                                <span>First</span>
                                </button>
                            </li>
                            <li class="previous">
                              <button aria-label="" class="btn btn-default btn-cons from-left pull-right" type="button">
                                <span><a href="#top">Previous</a></span>
                              </button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

            </div>
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->

        @endsection
        @section('scripts')
        
                <script>
$(document).ready(function(){

//For Card Number formatted input
var cardNum = document.getElementById('cr_no');
cardNum.onkeyup = function (e) {
    if (this.value == this.lastValue) return;
    var caretPosition = this.selectionStart;
    var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    var parts = [];
    
    for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
        parts.push(sanitizedValue.substring(i, i + 4));
    }
    
    for (var i = caretPosition - 1; i >= 0; i--) {
        var c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 4);
    
    this.value = this.lastValue = parts.join(' ');
    this.selectionStart = this.selectionEnd = caretPosition;
}

//For Date formatted input
var expDate = document.getElementById('exp');
expDate.onkeyup = function (e) {
    if (this.value == this.lastValue) return;
    var caretPosition = this.selectionStart;
    var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    var parts = [];
    
    for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
        parts.push(sanitizedValue.substring(i, i + 2));
    }
    
    for (var i = caretPosition - 1; i >= 0; i--) {
        var c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 2);
    
    this.value = this.lastValue = parts.join('/');
    this.selectionStart = this.selectionEnd = caretPosition;
}


});



function checkBox(){
  if ($('#defaultCheck').is(':checked')) {
     $('#shipp-firstName').val($('#bill-firstName').val());
     $('#shipp-lastName').val($('#bill-lastName').val());
     $('#shipp-city').val($('#bill-city').val());
     $('#shipp-state').val($('#bill-state').val());
     $('#shipp-postal').val($('#bill-postal').val());
     $('#shipp-phoneNumber').val($('#bill-phoneNumber').val());
     $('#shipp-email').val($('#bill-email').val());
     
  } else {
    $('#shipp-firstName,#shipp-lastName,#shipp-city,#shipp-state,#shipp-postal,#shipp-phoneNumber,#shipp-email').val('');
  }

}

$('.tree [data-toggle="popover"  ]').popover({
    html: true,
    content: function () {
        return $(this).prev().html();
    }
});

$('#popover-div').popover({
    html: true,
    trigger: 'hover',
    container: '#popover-div',
    placement: 'bottom',
    content: function () {
        return '<div class="popbox">Help Us Make A Difference!<br>Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href="https://dryclean.io/makeitcount.php" title="test add link">Click Here </a> to learn more about this program and the Janeen Foundation</div>';
    }
});

  </script>
  <script type="text/javascript">
    $('#phoneNumber1').inputmask("(999) 999-9999");
    $('#phoneNumber2').inputmask("(999) 999-9999");
    $('#phoneNumber3').inputmask("(999) 999-9999");
</script>
  <!-- END PAGE LEVEL JS -->


  

@endsection