@extends('Layouts.app')
@section('content')
<script type="text/javascript" src="{{ asset('LTR/assets/js/pages/dashboard.js')}}"></script>


<!-- Content area -->
<div class="content">

    <!-- Main charts -->
    <div class="row">
        <div class="col-lg-12">

            <!-- Traffic sources -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Traffic sources</h6>
                    <div class="heading-elements">
                        <form class="heading-form" action="#">
                            <div class="form-group">
                                <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                    <input type="checkbox" class="switch" checked="checked">
                                    Live update:
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">Daily issued loans</div>
                                    <div class="text-muted" id="issuedloans"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-visitors"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">Daily Colections</div>
                                    <div class="text-muted" id="dailyCollection"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold">Total Active creditors</div>
                                    <div class="text-muted" id="tota_Creditors"><span class="status-mark border-success position-left"></span> </div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="total-online"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-relative" style="padding-right:5px">

                    <figure class="highcharts-figure">
                        <div id="container"></div>

                    </figure>
                </div>
            </div>
            <!-- /traffic sources -->

        </div>

        <!-- <div class="col-lg-5">

  
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Sales statistics</h6>
                    <div class="heading-elements">
                        <form class="heading-form" action="#">
                            <div class="form-group">
                                <select class="change-date select-sm" id="select_date">
                                    <optgroup label="<i class='icon-watch pull-right'></i> Time period">
                                        <option value="val1">June, 29 - July, 5</option>
                                        <option value="val2">June, 22 - June 28</option>
                                        <option value="val3" selected="selected">June, 15 - June, 21</option>
                                        <option value="val4">June, 8 - June, 14</option>
                                    </optgroup>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> 5,689</h5>
                                <span class="text-muted text-size-small">orders weekly</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> 32,568</h5>
                                <span class="text-muted text-size-small">orders monthly</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-group">
                                <h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> $23,464</h5>
                                <span class="text-muted text-size-small">average revenue</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-group-sm" id="app_sales"></div>
                <div id="monthly-sales-stats"></div>
            </div>


        </div> -->
    </div>
    <!-- /main charts -->




</div>
<div id="messages-stats"></div>

<script>

$.ajax({
    url: "{{url('/admin/monthlyCollection')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
       var loanWithInt = [];
        var payAmount = [];
        var month = [];
        for (var i = 0; i < data.length; i++) {
        
            loanWithInt.push(parseFloat(data[i].sums));
               payAmount.push(parseFloat(data[i].pay_amount));


            month.push(data[i].months);

        }

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Average'
            },
//            subtitle: {
//            text: 'Source: WorldClimate.com'
//            },
            xAxis: {
                categories: month,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rs'
                }
            },
          
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'sums',
                    data: loanWithInt

                }
                , {
                    name: 'pay_amount',
                    data: payAmount

                }
            ]
        });

    }

});


$.ajax({
    url: "{{url('/admin/issuedLoanDaily')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var issuedloans=0;
        for (var i = 0; i < data.length; i++) {
            issuedloans=parseFloat(data[i].loanamount);
        }
        if(isNaN(issuedloans)){
            document.getElementById('issuedloans').innerHTML = "Rs "+0;
        }else{
            document.getElementById('issuedloans').innerHTML = "Rs "+issuedloans;
        }
       
    }
});
$.ajax({
    url: "{{url('/admin/todayDailyCollection')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var dailyCollection=0;
        for (var i = 0; i < data.length; i++) {
            dailyCollection=parseFloat(data[i].pay_amount);
        }
       console.log(dailyCollection);
        if(isNaN(dailyCollection)){
            document.getElementById('dailyCollection').innerHTML = "Rs "+0;
           
        }else{
            document.getElementById('dailyCollection').innerHTML = "Rs "+dailyCollection;
           
        }
       
    }
});$.ajax({
    url: "{{url('/admin/todayActiveCreditors')}}", //this is your uri
    type: 'get', //this is your method
    success: function (data) {
        var tota_Creditors=0;
        for (var i = 0; i < data.length; i++) {
            tota_Creditors=parseFloat(data[i].tota_Creditors);
        }

        if(isNaN(tota_Creditors)){
            document.getElementById('tota_Creditors').innerHTML = "Rs "+0;
           
        }else{
            document.getElementById('tota_Creditors').innerHTML = ""+tota_Creditors;
           
        }
       
    }
});
</script>






@endsection