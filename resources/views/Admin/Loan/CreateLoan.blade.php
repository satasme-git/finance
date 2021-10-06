@extends('Layouts.app')
@section('content')

<!-- Page header -->
<div class="page-header">

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Loan</span> - create loan</h4>
        </div>

        <!-- <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div> -->
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_loan">Loan</a></li>
            <li class="active">Create loan</li>
        </ul>

        <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear position-left"></i>
                    Settings
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- 2 columns form -->
    @if(Session::has('msg'))
    {!! Session::get('msg') !!} 
    @endif

    <?php
    ?> 
    <form action="{{url('/admin/addloan')}}"  method="POST">
        {{csrf_field()}}
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i> Creditor details</legend>

                            <div class="form-group {{ $errors->has('creditor_nic') ? ' has-error' : '' }}">
                                <label>Creditor NIC Number:</label>
                                <input type="hidden" class="form-control"  id="cre_id" name="cre_id"/>
                                <input type="text" style="font-weight:bold" class="form-control"  placeholder="Enter NIC Number" id="search" name="creditor_nic"
                                       @if($errors->any())
                                       value="{{old('creditor_nic')}}""
                                       @elseif(!empty($records->creditor_nic))
                                       value="{{$records->creditor_nic}}"
                                       @endif />
                                       @if ($errors->has('creditor_nic'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('creditor_nic') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_first_Name') ? ' has-error' : '' }}">
                                <label>First name:</label>
                                <input type="text" class="form-control" readonly placeholder="First Name" id="cre_first_Name" name="cre_first_name"
                                       @if($errors->any())
                                       value="{{old('user_fname')}}""
                                       @elseif(!empty($records->user_first_Name))
                                       value="{{$records->user_first_Name}}"
                                       @endif />
                                       @if ($errors->has('user_first_Name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_first_Name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_last_Name') ? ' has-error' : '' }}">
                                <label>Last name:</label>
                                <input type="text" class="form-control" readonly placeholder="Last Name" id="last_name" name="cre_last_Name"	@if($errors->any())
                                       value="{{old('user_last_Name')}}""
                                       @elseif(!empty($records->user_last_Name))
                                       value="{{$records->user_last_Name}}"
                                       @endif />
                                       @if ($errors->has('user_last_Name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_last_Name') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('user_nic_number') ? ' has-error' : '' }}">
                                <label>Phone Number:</label>
                                <input type="text" class="form-control" readonly placeholder="Phone Number" id="cre_phone_number" name="cre_phone_number"	@if($errors->any())
                                       value="{{old('user_nic_number')}}""
                                       @elseif(!empty($records->user_nic_number))
                                       value="{{$records->user_nic_number}}"
                                       @endif />
                                       @if ($errors->has('user_nic_number'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_nic_number') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('cre_address') ? ' has-error' : '' }}">
                                <label>Address:</label>
                                <textarea rows="5" cols="5" class="form-control" readonly placeholder="Address" id="cre_address" name="cre_address">@if($errors->any()){{old('cre_address')}}@elseif(!empty($records->cre_address)){{$records->cre_address}}@endif</textarea>
                                @if ($errors->has('cre_address'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('cre_address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('loan_term') ? ' has-error' : '' }}">
                                <label>Loan Term:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text" class="form-control" placeholder="Enter Loan Term" id="loan_term" name="loan_term"	@if($errors->any())
                                       value="{{old('loan_term')}}""
                                       @elseif(!empty($records->loan_term))
                                       value="{{$records->loan_term}}"
                                       @endif />
                                       @if ($errors->has('loan_term'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_term') }}</strong>
                                </span>
                                @endif
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy"></i> Loan details</legend>
                            <div class="form-group {{ $errors->has('loan_amount') ? ' has-error' : '' }}">
                                <label>Loan Amount:</label>
                                <input type="text" style=" font-weight: bold" placeholder="Enter Loan Amount" class="form-control" id="loan_amount" name="loan_amount" onkeyup ="loanCalculations();"	@if($errors->any())
                                       value="{{old('loan_amount')}}""
                                       @elseif(!empty($records->loan_amount))
                                       value="{{$records->loan_amount}}"
                                       @endif />
                                       @if ($errors->has('loan_amount'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_amount') }}</strong>
                                </span>
                                @endif
                            </div>	
                            <div class="form-group {{ $errors->has('loan_rental') ? ' has-error' : '' }}">
                                <label>Rental Frequance:</label>
                                <select data-placeholder="Select Rental" class="form-control select"  id="loan_rental" name="loan_rental" >
                                    <option></option>

                                    <option  value="Monthly">Monthly</option>
                                    <option  value="Weekly">Weekly</option>
                                    <option  value="Daily">Daily</option>

                                </select>
                                @if ($errors->has('loan_rental'))
                                <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_rental') }}</strong>
                                </span>
                                @endif
                            </div>
							<div class="form-group {{ $errors->has('loan_with_interest') ? ' has-error' : '' }}">
                                <label>Loan With Interest:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text" readonly style=" font-weight: bold" class="form-control" placeholder="Enter Loan With Interest" id="loan_with_interest" name="loan_with_interest"	@if($errors->any())
                                       value="{{old('loan_with_interest')}}""
                                       @elseif(!empty($records->loan_with_int))
                                       value="{{$records->loan_with_int}}"
                                       @endif />
                                       @if ($errors->has('loan_with_interest'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_with_interest') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('loan_period') ? ' has-error' : '' }}">
                                <label>Periods:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text" class="form-control" placeholder="Enter Loan Period" id="loan_period" name="loan_period" onkeyup ="loanPerioud();"	@if($errors->any())
                                       value="{{old('loan_period')}}""
                                       @elseif(!empty($records->loan_period))
                                       value="{{$records->loan_period}}"
                                       @endif />
                                       @if ($errors->has('loan_period'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_period') }}</strong>
                                </span>
                                @endif
                            </div>

                           
                            <div class="form-group {{ $errors->has('loan_installement') ? ' has-error' : '' }}">
                                <label>installment Amount:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text" readonly style=" font-weight: bold" class="form-control" placeholder="Enter Installement" id="loan_installement" name="loan_installement"	@if($errors->any())
                                       value="{{old('loan_installement')}}""
                                       @elseif(!empty($records->loan_installement))
                                       value="{{$records->loan_installement}}"
                                       @endif />
                                       @if ($errors->has('loan_installement'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_installement') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('loan_start_date') ? ' has-error' : '' }}">
                                <label>Loan Starting Date:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="date" class="form-control" placeholder="Enter Loan Term" id="loan_start_date" name="loan_start_date"	@if($errors->any())
                                       value="{{old('loan_start_date')}}""
                                       @elseif(!empty($records->loan_start_date))
                                       value="{{$records->loan_start_date}}"
                                       @endif />
                                       @if ($errors->has('loan_start_date'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('loan_start_date') }}</strong>
                                </span>
                                @endif
                            </div>



                        </fieldset>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        var response = '{{ Session::get('msg');}}';
        if (response == "insert") {
            swal({
                title: "Good job!",
                text: "Successfuly inserted record!",
                icon: "success",
                button: "Ok!",
            });
        }
        // $('.alert-msg').fadeIn().delay(1000).fadeOut();



        $("#uname").keyup(function () {

            var uname = $('#uname').val();

            console.log(uname);


            $.ajax({

                type: 'POST',
                url: '/check_uname',
                data: {
                    "_token": "{{ csrf_token() }}",
                    username: uname},
                success: function (data) {
                    //alert(data);
                    if (data == 0) {
                        //    $('#msg_nic').text('Available username!');
                        //    $("#msg_nic").css("background-color", "green");
                    } else {
                        $('#msg_nic').text('The username already exists!');
                        $("#msg_nic").css("background-color", "red");
                    }
                }
            });

        });
	

    });
	function loanPerioud(){
		var aplication_lamountWithInt = document.getElementById('loan_with_interest').value;
                var aplication_lperiod = document.getElementById('loan_period').value;

                var weeklyDue = aplication_lamountWithInt / aplication_lperiod;
                document.getElementById('loan_installement').value = parseFloat(weeklyDue);
		}
		function loanCalculations() {
                var loan_amount = document.getElementById('loan_amount').value;
                var loan_perioud = document.getElementById('loan_period').value;

                // var aplication_irate = document.getElementById('aplication_irate').value;
				var aplication_irate =10;
                // var aplication_months = document.getElementById('aplication_months').value;

                var loantWithInterest = (loan_amount * aplication_irate ) / 100;
                document.getElementById('loan_with_interest').value = parseFloat(loantWithInterest) + parseFloat(loan_amount);
            }
</script>
<script type="text/javascript">


    $('#search').autocomplete({

        source: "{{URL::to('autocomplete2-searchCreditor')}}",
        select: function (key, value) {

            console.log(value);
            $('#cre_gender').val(value.item.cre_gender);
            $('#cre_first_Name').val(value.item.cre_first_Name);
            $('#last_name').val(value.item.last_Name);
            $('#cre_phone_number').val(value.item.cre_phone_number);
            $('#cre_address').val(value.item.cre_address);
            $('#cre_id').val(value.item.id);
            
loanTerm(value.item.id);

        }
    })
    function loanTerm(id){
        $.ajax({
                    type: 'POST',
                    url: '/loan_term',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cre_id: id},
                }).done(function (data) {
                    var pro = JSON.parse(data);
                 
                    // for (var i in pro) {
                    //     num_comments = pro[i].num_comments;
                        document.getElementById('loan_term').value = data;

                    // }
                });
    }
</script>

@endsection