@extends('includes.newmaster')

@section('content')

<body class="userloggedin">
    
<style>
    .cradit-tabs-holder h3{
        margin-top: 0px;
    }
    .cradit-tabs-holder .tab-pane {
        padding: 20px 15px 40px;
        background: #fff;
        border-right: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
    .cradit-tabs-holder table, .cradit-tabs-holder select{
        width: 100%;
    }
    .cradit-tabs-holder form table tr td:first-child{
        text-align: right;
        width: 50%;
    }
    .cradit-tabs-holder form table tr td:last-child{
        padding-left: 10px;
    }
    .cradit-tabs-holder form table tr:last-child td{
        text-align: center;
        width: 100%;
    }
.cradit-tabs-holder form table tr td {
        font-size: 13px;
        padding: 4px 0px;
        color: #6d6d6d;
    }
    .btn.credits-btn, .btn.edit-btn, .btn.delete-btn, .btn.green-btn{
    background: #085394;
    color: #fff;
    width: auto !important;
    margin: 0 5px;
    font-size: 13px;
    padding: 3px 10px;
border-radius: 0px;
}
    .btn.green-btn{
        background: #009E0F;
    }
    .btn.edit-btn{
        background: #fba811;
    }
    .btn.delete-btn{
        background: #ef0a0a;
    }
    input.card-text.not-editable {
    border: 2px solid #fff; 
     cursor: default; 
     pointer-events: none; 
    
}
    input.card-text{
        width: 100%;
    }
    #card-lists, #card-history{
        font-size: 13px;
    white-space: nowrap;
    }
    table#card-lists th, table#card-history th {
    font-size: 12px;
    }
     table#card-lists th, table#card-history th,  table#card-lists td, table#card-history td{
        padding: 5px 4px;
    }
    table#card-lists a{
        font-size: 12px;
        padding: 4px 7px;
        margin: 0 2px;
    }
    #addnew-card-form input[type="text"]{
        width: 70px;
    }
    .checkbox-holder {margin: 5px; font-size: 11px; position: relative;
    padding-left: 15px;}
    .checkbox-holder input{position: absolute; left: 0;}
    #manage-credits .btn{
        font-size: 10px;
    } #manage-credits .checkbox-holder{
        font-size: 9;
    }
    .cradit-tabs-holder select{
        height: 24px;
    max-width: 170px;
    }
    h5 .fa {
    font-size: 28px;
    vertical-align: middle;
    margin-top: -4px;
    margin-right: 4px;
}
    .ml-30 {margin-left: 30px;}
    .filter-form input[type="date"], .filter-form input[type="text"]  {
        width: 40px;
        font-size: 12px;

    }
    .filter-form .fa{
    font-size: 25px;
    margin: 0 5px 0px 2px;
    }
    .f-12{
        font-size: 12px;
    }
    .filter-form select {
    width: 120px;
    font-size: 12px;
}
   input.apply-filter {
    background: transparent;
    border: 0;
    text-decoration: underline;
    color: #1b18ef;
    font-size: 14px;
    margin-left: 5px;
}
    @media screen and (max-width: 767px){
        .ml-30 {margin-left: 0px;}
    .cradit-tabs-holder form table tr td:first-child, .cradit-tabs-holder table,  .cradit-tabs-holder form table tr:last-child td {
        width: auto;}
        }
    </style>
    
 <header>
        <div class="container">
            <a class="menu" href="javascript:;"><i class="fa fa-bars"></i></a>
            <h1>Transaction Details</h1>
            <a class="setting" href=""><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
        <div class="menu-wrap">
            <ul>
                <li><a href="">Menu 1</a></li>
                <li><a href="">Menu 2</a></li>
            </ul>
        </div>
    </header>
    	
    <div class="container">
    	<div class="row tarn_detailblock">            
        	<div class="col-xs-12">
                <div  class="cradit-tabs-holder">
                    
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#loan-credits">Loan Credits</a></li>
    <li><a data-toggle="tab" href="#manage-credits">Manage Credits</a></li>
    <li><a data-toggle="tab" href="#history">History</a></li>
  </ul>

  <div class="tab-content">
    <div id="loan-credits" class="tab-pane fade  in active">
        <div class="col-sm-6">
            <h4>Default Card</h4>
            <form id="edit-card-form">
            <table>
                <tbody>
                    <tr><td>Card Holder Name:</td><td><input type="text" name="card-holder" class="card-text not-editable" value="John Doe"></td></tr>
                    <tr><td>Card No:</td><td><input type="text" name="card-no"  class="card-text not-editable" value="9876 6546 6546 6546" /></td></tr>
                    <tr><td>Expiry(mm/yy):</td><td><input type="text"  class="card-text not-editable" name="expiry" value="12/18" /></td></tr>
                    <tr><td>CVV No.:</td><td><input type="text"  class="card-text not-editable" name="cvv" value="080" /></td></tr>
                    <tr><td>Card Description:</td><td><input type="text"  class="card-text not-editable" name="card-detail" value="John Personal card" /></td></tr>
                    <tr><td colspan="2"><input type="button" class="edit-btn edit-default-card btn btn" value="Edit Card" /><input type="submit" class="btn credits-btn" value="Save" /></td></tr>
                </tbody>
            </table>
            </form>
            <br>
            <h4>Add New Card</h4>
            <form id="addnew-card-form">
            <table>
                <tbody>
                    <tr><td>Card Holder Name:</td><td><input type="text" name="card-holder" class="" ></td></tr>
                    <tr><td>Card No:</td><td><input type="text" name="card-no"  /></td></tr>
                    <tr><td>Expiry(mm/yy):</td><td><input type="text"   name="expiry" /></td></tr>
                    <tr><td>CVV No.:</td><td><input type="text"  name="cvv"  /></td></tr>
                    <tr><td>Card Description:</td><td><input type="text"   name="card-detail" /></td></tr>
                    <tr><td colspan="2"><span class="checkbox-holder"><input type="checkbox" name="agreement"> Set as Default</span><input type="submit" class="btn credits-btn" value="Save" /></td></tr>
                </tbody>
            </table>
            </form>
            
            <br />
        </div>
        <div class="col-sm-6">
           <table id="card-lists" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Card Description</th>
        <th>Last 4 Di</th>
        <th>Expiry</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Personal card</td>
        <td>4560</td>
        <td>12/18</td>
          <td><a href="#" class="btn edit-btn"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="#" class="btn delete-btn"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
      </tr>
     <tr>
        <td>John Personal card</td>
        <td>4560</td>
        <td>12/18</td>
          <td><a href="#" class="btn edit-btn"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="#" class="btn delete-btn"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
      </tr>
      <tr>
        <td>John Personal card</td>
        <td>4560</td>
        <td>12/18</td>
          <td><a href="#" class="btn edit-btn"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="#" class="btn delete-btn"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
      </tr>
    </tbody>
  </table>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="manage-credits" class="tab-pane fade">
        <div class="col-sm-5">
      <h5><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Title </h5>
        <form class="manage-credits-form">
            <table class="ml-30">
                <tr><td class="text-right" width="50px">Account#</td><td><input type="text" name="account" class="" ></td></tr>
                <tr><td class="text-right">PIN#</td><td><input type="text" name="pin" class="" ></td></tr>
                <tr><td class="text-right">Amount#</td><td><input type="text" name="Amount" class="" ></td></tr>
                <tr><td colspan="2"><input type="submit" class="btn green-btn" value="Initiate Transfer" /> <span class="checkbox-holder"> <input type="checkbox" name="agreement"> Add Account to my Card</span></td></tr>
            </table>
        
        </form>
            
        <br />
        </div>
        <div class="col-sm-6 col-sm-offset-1">
      <h5><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Load from Credit Card </h5>
        <form class="manage-credits-form">
            <table>
                <tr><td class="text-right"  width="100px">Select Credit Card:</td><td><select name="" >
                    <option value="">John Doe</option>
                    </select></td></tr>
                <tr><td class="text-right">Password:</td><td><input type="text" name="pin" class="" ></td></tr>
                <tr><td class="text-right">Amount:</td><td><input type="text" name="Amount" class="" ></td></tr>
                <tr><td></td><td><input type="submit" class="btn green-btn" value="Submit payment" /></td></tr>
            </table>
        
        </form>
            
        <br />
        </div>
        <div class="col-sm-5">
      <h5><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Transfer from PayPal </h5>
        <form class="manage-credits-form">
            <table class="ml-30">
                <tr><td class="text-right" width="50px">Account Email:</td><td><input type="text" name="account" class="" ></td></tr>
                <tr><td class="text-right">Password:</td><td><input type="text" name="pin" class="" ></td></tr>
                <tr><td class="text-right">Amount:</td><td><input type="text" name="Amount" class="" ></td></tr>
                <tr><td colspan="2"><input type="submit" class="btn green-btn" value="Initiate Transfer" /> <span class="checkbox-holder"> <input type="checkbox" name="agreement"> Add Account to my Card</span></td></tr>
            </table>
        
        </form>
            
        <br />
        </div>
        <div class="col-sm-6 col-sm-offset-1">
      <h5><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Load from Dabit Card </h5>
        <form class="manage-credits-form">
            <table>
                <tr><td class="text-right"  width="100px">Select Bank:</td><td><select name="" >
                    <option value="">State bank</option>
                    </select></td></tr>
                <tr><td class="text-right">Online Bankingg Card:</td><td><input type="text" name="pin" class="" ></td></tr>
                <tr><td class="text-right">Password:</td><td><input type="text" name="pin" class="" ></td></tr>
                <tr><td class="text-right">Amount:</td><td><input type="text" name="Amount" class="" ></td></tr>
                <tr><td></td><td><input type="submit" class="btn green-btn" value="Submit payment" /></td></tr>
            </table>
        
        </form>
            
        <br />
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="history" class="tab-pane fade">
      <div class="col-xs-12">
        <form class="filter-form"><span><input type="text" placeholder="   /   /  " /> <i class="fa fa-calendar" aria-hidden="true"></i></span> <span class="f-12">To &nbsp;&nbsp;</span><span><input type="text" placeholder="   /   /  " /> <i class="fa fa-calendar" aria-hidden="true"></i></span>&nbsp;&nbsp;<span><select><option value="">Card Descreption</option></select></span><span><input type="submit" class="apply-filter" value="Apply Filter"></span></form>
          <div class="table-responsive">
        <table id="card-history" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>DATE</th>
        <th>CARD (LAST 4 DIGITS)</th>
        <th>DISCRIPTION</th>
        <th>AMOUNT</th>
        <th>REFERENCE #</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1/16/18</td>
        <td>4747</td>
        <td>John's Personal</td>
        <td>$200</td>
        <td>0123456789</td>
          
      </tr>
      <tr>
        <td>1/16/18</td>
        <td>4747</td>
        <td>John's Personal</td>
        <td>$200</td>
        <td>0123456789</td>
          
      </tr>
      <tr>
        <td>1/16/18</td>
        <td>4747</td>
        <td>John's Personal</td>
        <td>$200</td>
        <td>0123456789</td>
          
      </tr>
    </tbody>
  </table>
          </div>
        </div>
        <div class="clearfix"></div>
    </div>
  </div>
                    
                    
                </div>
                
                
            	
            </div>
            
        </div>
    </div>
    <footer>
    	<div class="container">
        	<a class="flyrocket" href=""><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
        	<div class="accountloy">
            	<div class="inner">
                    <a href=""><i class="fa fa-university" aria-hidden="true"></i><br/>Accounts</a>
                </div>
                <div class="inner">
                    <a href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i><br/>Loyalty</a>
                </div>    
            </div>
            <div class="transhop">
                <div class="inner">
                    <a href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i><br/>Transaction</a>
                </div>
                <div class="inner">
                    <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i><br/>Shop</a>
                </div> 
            </div>
        </div>
    </footer>

@stop

@section('footer')
<script>
 $(document).ready(function(){
    $('.edit-default-card').on('click', function(){
        $(this).closest('form').find('.card-text').removeClass('not-editable');
    })
})
</script>
@stop