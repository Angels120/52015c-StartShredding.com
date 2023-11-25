<div class=" container-fluid  container-fixed-lg footer">
    <div class="copyright sm-text-center">
        <p class="small no-margin pull-left sm-pull-reset">
            &copy;2019 uBe</span><span class="hint-text"> All Rights Reserved</span>
        </p>
        <div class="clearfix"></div>
    </div>
</div>

<!-- BEGIN VENDOR JS -->
<script src="{{ URL::asset('new_assets/assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/modernizr.custom.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/popper/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery/jquery-easy.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-ios-list/jquery.ioslist.min.js')}}" type="text/javascript">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-actual/jquery.actual.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/select2/js/select2.full.min.js')}}" type="text/javascript" src="">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/classie/classie.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/switchery/js/switchery.min.js')}}" type="text/javascript">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/lib/d3.v3.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/nv.d3.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/utils.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/tooltip.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/interactiveLayer.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/axis.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/line.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/lineWithFocusChart.js')}}" type="text/javascript">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/hammer.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/jquery.mousewheel.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/mapplic.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-metrojs/MetroJs.min.js')}}" type="text/javascript">
</script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/skycons/skycons.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}"
    type="text/javascript"></script>
<script
    src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')}}"
    type="text/javascript"></script>
<script
    src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/datatables-responsive/js/datatables.responsive.js')}}"
    type="text/javascript"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ URL::asset('new_assets/pages/js/pages.js')}}"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ URL::asset('new_assets/assets/js/scripts.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<!-- <script src="assets/js/dashboard.js" type="text/javascript"></script> -->
<script src="{{ URL::asset('new_assets/assets/js/scripts.js')}}" type="text/javascript"></script>
<script>
        $(document).ready(function(){
            $(document).click(function() {
                $('#here').hide();
            });

            $('#search').keyup(function(e){
                //$("#here").remove();
                e.preventDefault();
                $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('#p').attr('content')}
             });
                $('#here').show();
                var x=$(this).val();
                //console.log(x);
                //var x1=$('#p').attr('content');
                
                $.ajax({
                    type:'POST',
                    url:'{{route("user.search-data")}}',
                    //processData:false,
                    //cache:false,
                    dataType: "JSON",
                    data:{
                        data :x,
                    },
                    success:function(data){
                        //console.log(data);
                        if(data['orders']!=null){
                            $("#here1").html("");
                            $("#here1").append("<li style='list-style: none; padding-bottom: 10px;'>ORDERS</li>");
                            jQuery.each( data['orders'], function( i, val ) {
                                $("#here1").append("<li style='list-style: none; padding-bottom: 5px;'><a href='user/order-details/"+val['id']+ "'>"+val['order_number']+"</a></li>");
                            });
                        }else{
                            $("#here1").html("");
                            //$("#here1").hide();
                        }

                        if(data['product']!=null){
                            $("#here2").html("");
                            $("#here2").append("<li style='list-style: none; padding-bottom: 10px;'>PRODUCTS</li>");
                            jQuery.each( data['product'], function( i, val ) {
                                $("#here2").append("<li style='list-style: none; padding-bottom: 5px;'><a href='product/"+val['id']+"/"+val['title'] +"'>"+val['title']+"</a></li>");
                            });
                        }else{
                            $("#here2").html("");
                            //$("#here2").hide();
                        }
                    },
                    error: function(XMLHttpRequest, status, err) {
               
                        console.error(XMLHttpRequest);
            }
                });
            });
        });
    </script>