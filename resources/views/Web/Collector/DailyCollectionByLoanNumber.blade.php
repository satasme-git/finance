@extends('Layouts.app_web')
@section('content')

<!-- Page header -->
<div class="page-header">

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Loan</span> - daily collection</h4>
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
            <li class="active">Daily collection</li>
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
    <form action="{{url('/admin/daily_collection')}}"  method="POST">
        {{csrf_field()}}
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i> Creditor details</legend>

                           
                                <input type="hidden" class="form-control"  id="cre_id" name="cre_id" value="{{$collections->cre_id}}"/>
                                <input type="hidden" class="form-control"  id="loan_id" name="loan_id" value="{{$collections->id}}"/>
                                <input type="hidden" style="font-weight:bold" class="form-control"  placeholder="Enter Loan Number"  value="{{$collections->loan_number}}" id="search"  name="loan_number"
                                       @if($errors->any())
                                       value="{{old('loan_number')}}""
                                       @elseif(!empty($records->loan_number))
                                       value="{{$records->loan_number}}"
                                       @endif />
                      
                            <div class="form-group {{ $errors->has('user_first_Name') ? ' has-error' : '' }}">
                                <label>First name:</label>
                                <input type="text" class="form-control" readonly placeholder="First Name" value="{{$collections->cre_first_Name}}" id="cre_first_Name" name="cre_first_name"
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
                                <input type="text" class="form-control" readonly placeholder="Last Name" value="{{$collections->cre_last_Name}}" id="last_name" name="cre_last_Name"	@if($errors->any())
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
                                <input type="text" class="form-control" readonly placeholder="Phone Number" value="{{$collections->cre_phone_number}}" id="cre_phone_number" name="cre_phone_number"	@if($errors->any())
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
                                <textarea rows="5" cols="5" class="form-control" readonly placeholder="Address" id="cre_address" name="cre_address">@if($errors->any()){{old('cre_address')}}@elseif(!empty($records->cre_address)){{$records->cre_address}}@endif {{$collections->cre_address}}</textarea>
                                @if ($errors->has('cre_address'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('cre_address') }}</strong>
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
                                <input type="text" readonly style=" font-weight: bold" placeholder="Enter Loan Amount" class="form-control" value="{{$collections->loan_amount}}" id="loan_amount" name="loan_amount" onkeyup ="loanCalculations();"	@if($errors->any())
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
                                <input type="text" readonly style=" font-weight: bold" placeholder="Rental" class="form-control" value="{{$collections->loan_rental_freq}}" id="loan_rental_freq" name="loan_rental_freq"  />
                    
                            </div>
							<div class="form-group {{ $errors->has('loan_with_interest') ? ' has-error' : '' }}">
                                <label>Loan With Interest:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text" readonly style=" font-weight: bold" class="form-control" placeholder="Enter Loan With Interest" value="{{$collections->loan_with_int}}" id="loan_with_interest" name="loan_with_interest"	@if($errors->any())
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
                                <input type="text" class="form-control" readonly placeholder="Enter Loan Period" value="{{$collections->loan_period}}" id="loan_period" name="loan_period" onkeyup ="loanPerioud();"	@if($errors->any())
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
                                <input type="text" readonly style=" font-weight: bold" class="form-control" placeholder="Enter Installement" value="{{$collections->loan_installement}}" id="loan_installement" name="loan_installement"	@if($errors->any())
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
                            <div class="form-group {{ $errors->has('pay_amount') ? ' has-error' : '' }}">
                                <?php
                                $outstanding=$collections->loan_with_int-$balance
                                ?>
                                <label>Loan Outstanding amount:</label>
      
                                <input type="text" readonly style=" font-weight: bold" class="form-control" placeholder="Enter Loan Term" value="{{$outstanding}}" id="outstanding" name="outstanding"	/>
                 
                            </div>
                            <div class="form-group {{ $errors->has('pay_amount') ? ' has-error' : '' }}">
                                <label>Pay amount:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text"  class="form-control" placeholder="Enter Loan Term" id="pay_amount" name="pay_amount"	@if($errors->any())
                                       value="{{old('pay_amount')}}""
                                       @elseif(!empty($records->pay_amount))
                                       value="{{$records->pay_amount}}"
                                       @endif />
                                       @if ($errors->has('pay_amount'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('pay_amount') }}</strong>
                                </span>
                                @endif

                                @if(Session::has('msg1'))
                                {!! Session::get('msg1') !!} 
                                @endif
                            </div>
                          



                        </fieldset>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success">Pay  <i class="icon-arrow-right14 position-right"></i></button>
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



    });

</script>
<script type="text/javascript">


    $('#search').autocomplete({

        source: "{{URL::to('autocomplete2-searchLoan')}}",
        select: function (key, value) {

            console.log(value);
            $('#cre_first_Name').val(value.item.cre_first_Name);
            $('#last_name').val(value.item.last_Name);
            $('#cre_phone_number').val(value.item.cre_phone_number);
            $('#cre_address').val(value.item.cre_address);
            $('#cre_id').val(value.item.cre_id);

            $('#loan_id').val(value.item.id);
            $('#loan_amount').val(value.item.loan_amount);
            $('#loan_rental_freq').val(value.item.loan_rental_freq);
            $('#loan_with_interest').val(value.item.loan_with_int);
            $('#loan_period').val(value.item.loan_period);
            $('#loan_installement').val(value.item.loan_installement);
            
loanOutstanding(value.item.id);

        }
    })

    function loanOutstanding(id){
        $.ajax({
                    type: 'POST',
                    url: '/loan_outstanding',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        loan_id: id},
                }).done(function (data) {
                    var pro = JSON.parse(data);
                  
                    var loan_amount = document.getElementById('loan_amount').value;
                    var outsanding=loan_amount-data
                if(data==""){
                    document.getElementById('outstanding').value = 0;
                }else{
                    document.getElementById('outstanding').value = outsanding;
                }
                       
                });
    }
 
</script>

@endsection