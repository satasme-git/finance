@extends('Layouts.app')
@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
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
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped  table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>E-Mail</th>                       
                            <th>NIC Number</th>                       
                            <th>Phone Number</th>   
                            <th>Role Name</th>   
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $path = 'images/user/'; ?>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                @if(!empty($user->user_image))
                                <img src="{{asset($path.$user->user_image)}}" style="width:52px">
                                @else
                                <img src="{{asset('/')}}images/avatar.jpg" style="width:52px">
                                @endif
                            </td>
                            <td>{{$user->user_first_Name}} {{$user->user_last_Name}}</td>
                            <td>{{$user->user_email}}</td>
                            <td>{{$user->user_nic_number}}</td>
                            <td>{{$user->user_phone_number}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>
                                <button id="viewbtn" onclick="abc({{$user->id}});" type="button" class="  btn btn-default btn-sm " >
                                    <i class="fa fa-file"></i> </button>
                                        <!-- <a href="{{url('admin/addcustomers/'.$user->id)}}" class="btn btn-default"><i class="fa fa-file"></i></a> -->
                                <a href="{{url('/admin/update_user/'.$user->id)}}" class="btn btn-info">   <i class="fa fa-edit"></i></a>
                                <button onclick="deleteconfirm({{$user->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- 2 columns form -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content" style="border-radius: 4px;" >
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Member details</h4>
                <button  style="margin-top:-15px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 10px">
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-5" style="">
                        <img id="myimg" style="margin-top:-20px" class="img-thumbnail" src="{{ asset('AdminLTE2/dist/img/avatar.jpg')}}" width="200px">

                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">User Name:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="cus_fname">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Date Of Birth:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="dob">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Username:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="uname">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Status:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="status">
                        </div>


                    </div>
                    <div class="col-md-7">
                        <div style="width:auto;background-color:#f78a2c;margin-top:-20px;margin-bottom:10px">
                            <label for="email" style="color:white;padding:1px;padding-left:10px">Basic informations</label>
                        </div>

                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold"> User NIC number :</label>

                            <input type="text" style="border:none;margin:-10px" class="form-control"id="cus_nic">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Joined date:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="cus_jdate">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Role name:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="role_name">
                        </div>
                        <div style="width:auto;background-color:#f78a2c;margin-top:0px;margin-bottom:10px">
                            <label for="email" style="color:white;padding:1px;padding-left:10px">Cintact informations</label>
                        </div>

                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Contact number:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="cus_contact">
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Email address:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="cus_email">
                        </div>
                        <!-- <div class="form-group">
                            <label for="email">Role:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="cus_role">
                        </div> -->
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Address:</label>
                            <textarea class="form-control"style="border:none;margin:-10px"  id="product_dis" rows="2"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $('.dataTables-example').DataTable({
    });
    });
</script>
<script>
    $(document).ready(function(){

    var response = '{{ Session::get('msg');}}';
    if (response == "insert"){
    swal({
    title: "Good job!",
            text: "Successfuly inserted record!",
            icon: "success",
            button: "Ok!",
    });
    }

    if (response == "update"){
    swal({
    title: "Good job!",
            text: "Successfuly updated record!",
            icon: "success",
            button: "Ok!",
    });
    }

    });
    
</script>
<script>
    function abc(id) {
    $.ajax({
    url: "{{url('get_user_by_id')}}" + "/" + id, //this is your uri
            type: 'get', //this is your method
            success: function (data) {
            $('#exampleModal').modal("show");
            $("#cus_fname").val(data[0].user_first_Name + " " + data[0].user_last_Name);
            $("#cus_jdate").val(data[0].created_at);
            $("#cus_nic").val(data[0].user_nic_number);
            $("#cus_contact").val(data[0].user_phone_number);
            $("#cus_email").val(data[0].user_email);
            $("#product_dis").val(data[0].user_address);
            $("#dob").val(data[0].user_DOB);
            $("#uname").val(data[0].user_username);
            if (data[0].status == 1){
            $("#status").val("Active user");
            } else{
            $("#status").val("inactive user");
            }

            $("#role_name").val(data[0].role_name);
            if (data[0].user_image == ""){
            $("#myimg").attr('src', "{{asset('images/avatar.jpg')}}");
            } else{
            $("#myimg").attr('src', "{{asset('images/user/')}}/" + data[0].user_image);
            }

            }
    });
    }

    function deleteconfirm(id){
        swal({
                title: "Are you sure?",
                text: "Are you sure want to delete this user",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
         
                   
                    swal("Poof! this user has been deleted!", {
                    icon: "success",
                 
                    }
                   
                    ).then((value) => {
                        window.location.href="{{url('admin/deleteuser')}}"+ "/" + id;
                         });
                    ;
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
		}
</script>
@endsection