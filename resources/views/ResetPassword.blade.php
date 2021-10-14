<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Finance -Web App Login</title>

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
                <a class="navbar-brand" href="index.html"><img src="{{ asset('LTR/assets/images/logo_light1.png')}}" alt=""></a>

                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <!-- <ul class="nav navbar-nav navbar-right">
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
                </ul> -->
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

                        <!-- Simple login form -->
             
                        <form action="{{url('/password_reset')}}" method="post">
                            {{csrf_field()}}
                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                    <h5 class="content-group">Reset Password <small class="display-block"></small></h5>
                                </div>
                                @if(Session::has('msg'))
                            {!! Session::get('msg') !!} 
             @endif
                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" readonly class="form-control" placeholder="Email Address"  value="{{Session::get('reset_email')}}"	name="email_address" id="email_address"	
                                           @if($errors->any())
                                           value="{{old('email_address')}}""
                                           @elseif(!empty($records->email_address))
                                           value="{{$records->email_address}}"
                                           @endif />
                                           @if ($errors->has('email_address'))
                                           <span class="help-block">
                                        <strong style="color: #ff0000">{{ $errors->first('email_address') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password"
                                           @if($errors->any())
                                           value="{{old('new_password')}}""
                                           @elseif(!empty($records->new_password))
                                           value="{{$records->new_password}}"
                                           @endif />
                                           @if ($errors->has('new_password'))
                                           <span class="help-block">
                                        <strong style="color: #ff0000">{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>
    
                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password"
                                           @if($errors->any())
                                           value="{{old('confirm_password')}}""
                                           @elseif(!empty($records->confirm_password))
                                           value="{{$records->confirm_password}}"
                                           @endif />
                                           @if ($errors->has('confirm_password'))
                                           <span class="help-block">
                                        <strong style="color: #ff0000">{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                    @endif
                                    @if(Session::has('msg1'))
                            {!! Session::get('msg1') !!} 
             @endif
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Reset Password <i class="icon-circle-right2 position-right"></i></button>
                                </div>

                               
                            </div>
                        </form>
                        <!-- /simple login form -->


                        <!-- Footer -->
                        <div class="footer text-muted">
                            &copy; 2021. <a href="#">SATASME Web App </a>  <a href="" target="_blank"></a>
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
    <script>
    $(document).ready(function(){
             $('#alert-msg').fadeIn().delay(3000).fadeOut();
     
		
    });
</script>
</html>
