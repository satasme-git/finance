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
							<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="form_layout_vertical.html">User</a></li>
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
            <form action="{{url('admin/user')}}" method="POST">
			{{csrf_field()}}
						<div class="panel panel-flat">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold"><i class="icon-reading position-left"></i> Basic details</legend>

											<div class="form-group">
												<label>First name:</label>
												<input type="text" class="form-control" placeholder="Enter First Name" id="fname" name="fname">
											</div>
											<div class="form-group">
												<label>Last name:</label>
												<input type="text" class="form-control" placeholder="Enter Last Name" id="lname" name="lname">
											</div>

											<div class="form-group">
												<label>Email:</label>
												<input type="text" placeholder="Enter Email Address" class="form-control" id="email" name="email">
											</div>
											<div class="form-group">
												<label>NIC Number:</label>
												<input type="text" class="form-control" placeholder="Enter NIC Number" id="nic" name="nic">
											</div>
											<div class="form-group">
												<label>Date Of Birth:</label>
												<input type="date" class="form-control" placeholder="Enter Date Of Birth" id="dob" name="dob">
											</div>
											<div class="form-group">
												<label>Attach Image:</label>
												<input type="file" class="file-styled" id="uimage" name="uimage">
											</div>	
										</fieldset>
									</div>

									<div class="col-md-6">
										<fieldset>
						                	<legend class="text-semibold"><i class="icon-copy"></i> Other details</legend>
												<div class="form-group">
													<label>Phone Number:</label>
													<input type="text" class="form-control" placeholder="Enter Phone Number" id="mobile" name="mobile">
												</div>
												<div class="form-group">
													<label>Usrname:</label>
													<input type="text" class="form-control" placeholder="Enter Phone Number" id="uname" name="uname">
												</div>
												<div class="form-group">
													<label>Password:</label>
													<input type="password" class="form-control" placeholder="Enter strong password" id="passwd" name="passwd">
												</div>
											<div class="form-group">
												<label>Address:</label>
												<textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here" id="address" name="address"></textarea>
											</div>
											<div class="form-group">
												<label>Select your state:</label>
												<select data-placeholder="Select your state" class="form-control select"  id="role_id" name="role_id">
													<option></option>
														@foreach($roles as $role)
                                     						<option  value="{{$role->id}}">{{$role->role_name}} </option>
                                    					@endforeach
												</select>
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
@endsection