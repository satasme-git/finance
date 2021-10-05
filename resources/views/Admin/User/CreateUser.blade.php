@extends('Layouts.app')
@section('content')

    		<!-- Page header -->
            <div class="page-header">
                   
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User</span> - create user</h4>
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
							<li><a href="/admin/view_user">User</a></li>
							<li class="active">Create user</li>
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
            <form action="{{url('/admin/create_user')}}" enctype="multipart/form-data" method="POST">
			{{csrf_field()}}
						<div class="panel panel-flat">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold"><i class="icon-reading position-left"></i> Basics details</legend>

<div class="form-group {{ $errors->has('user_emp_number') ? ' has-error' : '' }}">
												<label>Employee Number:</label>
												<input type="text" class="form-control" readonly placeholder="Enter First Name" id="user_emp_number" value="{{$emp_number}}" name="user_emp_number"
												@if($errors->any())
                                               value="{{old('user_emp_number')}}""
                                               @elseif(!empty($records->user_emp_number))
                                               value="{{$records->user_emp_number}}"
																	@endif />
													@if ($errors->has('user_emp_number'))
													<span class="help-block">
														<strong style="color: #ff0000">{{ $errors->first('user_first_Name') }}</strong>
													</span>
													@endif
											</div>
											<div class="form-group {{ $errors->has('user_first_Name') ? ' has-error' : '' }}">
												<label>Firsts name:</label>
												<input type="text" class="form-control" placeholder="Enter First Name" id="fname" name="fname"
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
												<input type="text" class="form-control" placeholder="Enter Last Name" id="lname" name="lname"	@if($errors->any())
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
												<label>NIC Number:</label>
												<input type="text" class="form-control" placeholder="Enter NIC Number" id="nic" name="nic"	@if($errors->any())
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
											<div class="form-group {{ $errors->has('user_DOB') ? ' has-error' : '' }}">
												<label>Date Of Birth:</label>
												<input type="date" class="form-control" placeholder="Enter Date Of Birth" id="dob" name="dob"	@if($errors->any())
                                               value="{{old('user_DOB')}}""
                                               @elseif(!empty($records->user_DOB))
                                               value="{{$records->user_DOB}}"
																	@endif />
													@if ($errors->has('user_DOB'))
													<span class="help-block">
														<strong style="color: #ff0000">{{ $errors->first('user_DOB') }}</strong>
													</span>
													@endif
											</div>
											<div class="form-group {{ $errors->has('user_image') ? ' has-error' : '' }}">
												<label>Attach Image:</label>
												<input type="file" class="file-styled" id="user_image" name="user_image"   autocomplete="off"   accept="image/*"  	@if($errors->any())
                                               value="{{old('user_image')}}""
                                               @elseif(!empty($records->user_image))
                                               value="{{$records->user_image}}"
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
												<input type="text" placeholder="Enter Email Address" class="form-control" id="email" name="email"	@if($errors->any())
                                               value="{{old('user_email')}}""
                                               @elseif(!empty($records->user_email))
                                               value="{{$records->user_email}}"
																	@endif />
													@if ($errors->has('user_email'))
													<span class="help-block">
														<strong style="color: #ff0000">{{ $errors->first('user_email') }}</strong>
													</span>
													@endif
											</div>	
											<div class="form-group {{ $errors->has('user_address') ? ' has-error' : '' }}">
													<label>Phone Number:</label>
													<input type="text" class="form-control" placeholder="Enter Phone Number" id="mobile" name="mobile"	@if($errors->any())
                                               value="{{old('user_phone_number')}}""
                                               @elseif(!empty($records->user_phone_number))
                                               value="{{$records->user_phone_number}}"
																	@endif />
													@if ($errors->has('user_phone_number'))
													<span class="help-block">
														<strong style="color: #ff0000">{{ $errors->first('user_phone_number') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group {{ $errors->has('user_address') ? ' has-error' : '' }}">
													<label>Usrname:</label>
													<span class="pull-right badge badge-success" id="msg_nic"></span>
													<input type="text" class="form-control" placeholder="Enter Phone Number" id="uname" name="uname"	@if($errors->any())
                                               value="{{old('user_username')}}""
                                               @elseif(!empty($records->user_username))
                                               value="{{$records->user_username}}"
																	@endif />
													@if ($errors->has('user_username'))
													<span class="help-block">
														<strong style="color: #ff0000">{{ $errors->first('user_username') }}</strong>
													</span>
													@endif
												</div>

											<div class="form-group {{ $errors->has('user_address') ? ' has-error' : '' }}">
												<label>Address:</label>
												<textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here" id="address" name="user_address">@if($errors->any()){{old('user_address')}}@elseif(!empty($records->user_address)){{$records->user_address}}@endif</textarea>
												
											

												@if ($errors->has('user_address'))
												<span class="help-block m-b-none">
													<strong>{{ $errors->first('user_address') }}</strong>
												</span>
												@endif
											</div>
											<div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
												<label>Select role:</label>
												<select data-placeholder="Select Role" class="form-control select"  id="role_id" name="role_id" >
													<option></option>
														@foreach($roles as $role)
                                     						<option  value="{{$role->id}}">{{$role->role_name}} </option>
                                    					@endforeach
												</select>
                                                @if ($errors->has('role_id'))
                                                <span class="help-block">
                                                    <strong style="color: #ff0000">{{ $errors->first('role_id') }}</strong>
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
    $(document).ready(function(){
        var response = '{{ Session::get('msg');}}';
            if(response=="insert"){
                swal({
                title: "Good job!",
                text: "Successfuly inserted record!",
                icon: "success",
                button: "Ok!",
                });
            }
        // $('.alert-msg').fadeIn().delay(1000).fadeOut();



		$("#uname").keyup(function(){

var uname= $('#uname').val();

console.log(uname);


$.ajax({

		type: 'POST',
		url: '/check_uname',
		data: {
			"_token": "{{ csrf_token() }}",
			username: uname},
		success: function(data){
			//alert(data);
		   if(data == 0){
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
</script>
  
@endsection