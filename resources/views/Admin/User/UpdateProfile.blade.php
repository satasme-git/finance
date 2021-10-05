@extends('Layouts.app')
@section('content')

<!-- Page header -->
<div class="page-header">

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"></span>User Profile </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>
    </div>

   
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- 2 columns form -->
    @if(Session::has('msg'))
    {!! Session::get('msg') !!} 
    @endif
    <form action="/admin/edit_user/{{$users->id}}" enctype="multipart/form-data" method="POST">
        {{csrf_field()}}
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i> Basics details</legend>

                          
                            <div class="form-group {{ $errors->has('user_first_Name') ? ' has-error' : '' }}">
                                <label>Firsts name:</label>
                                <input type="text" class="form-control" placeholder="Enter First Name" value="{{$users->user_first_Name}}" id="fname" name="fname"
                                       @if($errors->any())
                                       value="{{old('user_fname')}}""
                                       @elseif(!empty($users->user_first_Name))
                                       value="{{$users->user_first_Name}}"
                                       @endif />
                                       @if ($errors->has('user_first_Name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_first_Name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_last_Name') ? ' has-error' : '' }}">
                                <label>Last name:</label>
                                <input type="text" class="form-control" placeholder="Enter Last Name" value="{{$users->user_last_Name}}" id="lname" name="lname"	@if($errors->any())
                                       value="{{old('user_last_Name')}}""
                                       @elseif(!empty($users->user_last_Name))
                                       value="{{$users->user_last_Name}}"
                                       @endif />
                                       @if ($errors->has('user_last_Name'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_last_Name') }}</strong>
                                </span>
                                @endif
                            </div>

                           
                            <div class="form-group {{ $errors->has('user_nic_number') ? ' has-error' : '' }}">
                                <label>NIC Number:</label>
                                <input type="text" class="form-control" placeholder="Enter NIC Number" value="{{$users->user_nic_number}}" id="nic" name="nic"	@if($errors->any())
                                       value="{{old('user_nic_number')}}""
                                       @elseif(!empty($users->user_nic_number))
                                       value="{{$users->user_nic_number}}"
                                       @endif />
                                       @if ($errors->has('user_nic_number'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_nic_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_DOB') ? ' has-error' : '' }}">
                                <label>Date Of Birth:</label>
                                <input type="date" class="form-control" placeholder="Enter Date Of Birth" value="{{$users->user_DOB}}" id="dob" name="dob"	@if($errors->any())
                                       value="{{old('user_DOB')}}""
                                       @elseif(!empty($users->user_DOB))
                                       value="{{$users->user_DOB}}"
                                       @endif />
                                       @if ($errors->has('user_DOB'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_DOB') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_image') ? ' has-error' : '' }}">
                                <div>
                                    <?php $path = 'images/user/'; ?>
                                    @if(empty($users->user_image))
                                    <img id="user-photo" width="150px" class="bevel-black" src="{{asset('/')}}images/avatar.png"/>
                                    @else
                                    <img id="user-photo" width="150px" class="bevel-black" src="{{asset('/')}}images/user/{{$users->user_image}}"/>
                                    @endif
                                </div>
                                <label>Attach Image:</label>
                                <input type="hidden"  user_image id="user_image1" name="user_image1"  value="{{$users->user_image}}"/>
                                <input type="file" class="file-styled" id="user_image" name="user_image"   autocomplete="off" onchange="PreviewImage();"   accept="image/*"  	@if($errors->any())
                                       value="{{old('user_image')}}""
                                       @elseif(!empty($users->user_image))
                                       value="{{$users->user_image}}"
                                       @endif />
                                       @if ($errors->has('user_image'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_image') }}</strong>
                                </span>
                                @endif
                            </div>	
                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-copy"></i> Other details</legend>
                            <div class="form-group {{ $errors->has('user_email') ? ' has-error' : '' }}">
                                <label>Email:</label>
                                <input type="text" placeholder="Enter Email Address" class="form-control" value="{{$users->user_email}}" id="email" name="email"	@if($errors->any())
                                       value="{{old('user_email')}}""
                                       @elseif(!empty($users->user_email))
                                       value="{{$users->user_email}}"
                                       @endif />
                                       @if ($errors->has('user_email'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_address') ? ' has-error' : '' }}">
                                <label>Phone Number:</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" value="{{$users->user_phone_number}}" id="mobile" name="mobile"	@if($errors->any())
                                       value="{{old('user_phone_number')}}""
                                       @elseif(!empty($users->user_phone_number))
                                       value="{{$users->user_phone_number}}"
                                       @endif />
                                       @if ($errors->has('user_phone_number'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_username') ? ' has-error' : '' }}">
                                <label>Usrname:</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" value="{{$users->user_username}}" id="uname" name="uname"	@if($errors->any())
                                       value="{{old('user_username')}}""
                                       @elseif(!empty($users->user_username))
                                       value="{{$users->user_username}}"
                                       @endif />
                                       @if ($errors->has('user_username'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_password') ? ' has-error' : '' }}">
                                <label>Password:</label>
                                <input type="text" class="form-control" placeholder="Enter Phone Number" value="{{$users->user_password}}" id="user_password" name="user_password"	@if($errors->any())
                                       value="{{old('user_password')}}""
                                       @elseif(!empty($users->user_password))
                                       value="{{$users->user_password}}"
                                       @endif />
                                       @if ($errors->has('user_password'))
                                       <span class="help-block">
                                    <strong style="color: #ff0000">{{ $errors->first('user_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_address') ? ' has-error' : '' }}">
                                <label>Address:</label>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Enter address here"  id="address" name="user_address">@if($errors->any()){{old('user_address')}}@elseif(!empty($records->user_address)){{$records->user_address}}@endif {{$users->user_address}}</textarea>



                                @if ($errors->has('user_address'))
                                <span class="help-block m-b-none">
                                    <strong>{{ $errors->first('user_address') }}</strong>
                                </span>
                                @endif
                            </div>
                         
                        </fieldset>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-warning">Update form <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        var response = '{{ Session::get('msg');}}';
        if (response == "update") {
            swal({
                title: "Good job!",
                text: "Successfuly update record!",
                icon: "success",
                button: "Ok!",
            });
        }
    });


	function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("user_image").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("user-photo").src = oFREvent.target.result;
        };
    };


</script>

@endsection