<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Finance - fogot password</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('LTR/assets/js/core/app.js')}}"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="{{ asset('LTR/assets/images/logo_light.png')}}" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				<li>
					<a href="#">
						<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right"> Options</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Password recovery -->
					<form action="/send-email" method="post">
                    {{csrf_field()}}
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
								<h5 class="content-group">Fogot Password <small class="display-block">We'll send you instructions in email</small></h5>
							</div>
                            @if(Session::has('msg'))
                            {!! Session::get('msg') !!} 
             @endif
							<div class="form-group has-feedback">
								<input type="email" class="form-control" placeholder="Your email" name="email" id="email"
                                
                                @if($errors->any())
                                           value="{{old('email')}}""
                                           @elseif(!empty($records->email))
                                           value="{{$records->email}}"
                                           @endif />
                                           @if ($errors->has('email'))
                                           <span class="help-block">
                                        <strong style="color: #ff0000">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
								<div class="form-control-feedback">
									<i class="icon-mail5 text-muted"></i>
								</div>
							</div>

							<button type="submit" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</form>
					<!-- /password recovery -->


					<!-- Footer -->
				
                    <div class="footer text-muted">
                    Copyright   &copy; 2021. <a href="#">SATASME Web App </a>  <a href="" target="_blank"></a>
                        </div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
