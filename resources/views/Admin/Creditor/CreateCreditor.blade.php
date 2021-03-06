@extends('Layouts.app')
@section('content')

<!-- Page header -->
<div class="page-header">

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Creditor</span> - create creditor</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="/dashboard"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="/admin/view_creditor">Creditor</a></li>
            <li class="active">Create creditor</li>
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
    <form action="{{url('/admin/addcreditor')}}" enctype="multipart/form-data" method="POST">
        {{csrf_field()}}
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i> Basics details</legend>

                            <div class="form-group {{ $errors->has('first_Name') ? ' has-error' : '' }}">
                                <label>Firsts name:</label>
                                <input type="text" class="form-control" placeholder="Enter First Name" id="cre_first_Name" name="cre_first_Name"
                                       @if($errors->any())
                                       value="{{old('first_Name')}}""
                                       @elseif(!empty($records->cre_first_Name))
                                       value="{{$records->cre_first_Name}}"
                                       @endif />
                                       @if ($errors->has('first_Name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('first_Name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('last_Name') ? ' has-error' : '' }}">
                                <label>Last name:</label>
                                <input type="text" class="form-control" placeholder="Enter Last Name" id="cre_last_Name" name="cre_last_Name"	@if($errors->any())
                                       value="{{old('last_Name')}}""
                                       @elseif(!empty($records->cre_last_Name))
                                       value="{{$records->cre_last_Name}}"
                                       @endif />
                                       @if ($errors->has('last_Name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('last_Name') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('nic_number') ? ' has-error' : '' }}">
                                <label>NIC Number:</label>
                                <span class="pull-right badge badge-success" id="msg_nic"></span>
                                <input type="text" class="form-control" placeholder="Enter NIC Number" id="cre_nic_number" name="cre_nic_number"	@if($errors->any())
                                       value="{{old('nic_number')}}""
                                       @elseif(!empty($records->cre_nic_number))
                                       value="{{$records->cre_nic_number}}"
                                       @endif />
                                       @if ($errors->has('nic_number'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('nic_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_image') ? ' has-error' : '' }}">

                                <label>Gender:</label>
                                <div class="row" style="">
                                    <div class="col-md-3">
                                        <label class="form-check-label" for="radio1">
                                            <input type="radio" class="form-check-input" id="cre_gender" name="cre_gender" value="Male" checked> Male 
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-check-label" for="radio2">
                                            <input type="radio" class="form-check-input" id="cre_gender" name="cre_gender" value="Female"> Female 
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('DOB') ? ' has-error' : '' }}">
                                <label>Date Of Birth:</label>
                                <input type="date" class="form-control" placeholder="Enter Date Of Birth" id="cre_DOB" name="cre_DOB"	@if($errors->any())
                                       value="{{old('DOB')}}""
                                       @elseif(!empty($records->cre_DOB))
                                       value="{{$records->cre_DOB}}"
                                       @endif />
                                       @if ($errors->has('DOB'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('DOB') }}</strong>
                                </span>
                                @endif
                            </div>

                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy"></i> Other details</legend>
                            <div class="form-group {{ $errors->has('cre_image') ? ' has-error' : '' }}">
                                <label>Attach NIC Copy:</label>
                                <input type="file" class="file-styled" id="cre_image" name="cre_image"   autocomplete="off"   accept="image/*"  	@if($errors->any())
                                       value="{{old('cre_image')}}""
                                       @elseif(!empty($records->cre_image))
                                       value="{{$records->cre_image}}"
                                       @endif />
                                       @if ($errors->has('cre_image'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('cre_image') }}</strong>
                                </span>
                                @endif
                            </div>	
                            <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label>Phone Number:</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" id="cre_phone_number" name="cre_phone_number"	@if($errors->any())
                                       value="{{old('phone_number')}}""
                                       @elseif(!empty($records->cre_phone_number))
                                       value="{{$records->cre_phone_number}}"
                                       @endif />
                                       @if ($errors->has('phone_number'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label>Address:</label>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here" id="cre_address" name="cre_address">@if($errors->any()){{old('address')}}@elseif(!empty($records->cre_address)){{$records->cre_address}}@endif</textarea>



                                @if ($errors->has('address'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- <div class="form-group {{ $errors->has('collector') ? ' has-error' : '' }}">
                                    <label>Collector:</label>
                                            <input type="text" class="form-control" placeholder="Enter Phone Number" id="search" name="user_id"	@if($errors->any())
value="{{old('collector')}}""
@elseif(!empty($records->user_id))
value="{{$records->user_id}}"
                                                                            @endif />
                                            @if ($errors->has('collector'))
                                            <span class="help-block">
                                                    <strong style="color: #ff0000">{{ $errors->first('collector') }}</strong>
                                            </span>
                                            @endif
                                    </div> -->
                            <div class="form-group {{ $errors->has('collector') ? ' has-error' : '' }}">
                                <label>Assign collector:</label>
                                <select data-placeholder="Select Collector" class="form-control select"  id="user_id" name="user_id" >
                                    <option></option>
                                    @foreach($users as $user)
                                    <option  value="{{$user->id}}">{{$user->user_first_Name}} {{$user->user_last_Name}} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('collector'))
                                <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('collector') }}</strong>
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
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->

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






        $("#cre_nic_number").keyup(function () {

            var nic = $('#cre_nic_number').val();

            console.log(nic);


            $.ajax({

                type: 'POST',
                url: '/check_nic',
                data: {
                    "_token": "{{ csrf_token() }}",
                    nic_number: nic},
                success: function (data) {
                    // alert(data);
                    if (data == 0) {
                        //    $('#msg_nic').text('Available username!');
                        //    $("#msg_nic").css("background-color", "green");
                    } else {
                        $('#msg_nic').text('NIC Number already exists!');
                        $("#msg_nic").css("background-color", "red");
                    }
                }
            });

        });

    });
</script>

<script type="text/javascript">


    $('#search').autocomplete({

        source: "{{URL::to('autocomplete2-searchcom')}}",
        select: function (key, value) {

            console.log(value);

            // $('#memberid').val(value.item.id);

        }
    })
</script>


@endsection