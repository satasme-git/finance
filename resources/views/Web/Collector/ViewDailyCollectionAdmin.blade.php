@extends('Layouts.app')
@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<!-- Page header -->
<div class="page-header">

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Loan</span> - View loans</h4>
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
							<li><a href="/admin/view_loan">Loan</a></li>
            <li class="active">View loans</li>
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
<div class="content" style="margin-bottom:-40px">
<div class="col-md-12" style="background-color: #e0e0e0;padding-top:5px">


            
<form action="/serch_by_collector_id" method="POST">
  {{csrf_field()}}
  <div class="col-md-4">
      <div class="form-group {{ $errors->has('search') ? ' has-error' : '' }}">
          <label for="email">Collector name:</label>
          <input type="hidden" class="form-control" id="collector_id" name="collector_id" placeholder="Enter collector name">
          <input type="text" class="form-control" id="search" name="search" placeholder="Enter collector name">
      </div>
      @if ($errors->has('search'))
      <span class="help-block">
          <strong style="color: #ff0000">{{ $errors->first('search') }}</strong>
      </span>
      @endif
  </div>
  <div  class="col-md-3">
      <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
          <label for="email">Start Date:</label>
          <input type="date" class="form-control" placeholder="Enter email" name="start_date" id="start_date">
      </div>
      @if ($errors->has('start_date'))
      <span class="help-block">
          <strong style="color: #ff0000">{{ $errors->first('start_date') }}</strong>
      </span>
      @endif
  </div>
  <div  class="col-md-3">
      <div class="form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
          <label for="email">End Date:</label>
          <input type="date" class="form-control" placeholder="Enter email" name="end_date" id="end_date">
      </div>
      @if ($errors->has('end_date'))
      <span class="help-block">
          <strong style="color: #ff0000">{{ $errors->first('end_date') }}</strong>
      </span>
      @endif
  </div>

  <div  class="col-md-2">
      <div class="form-group " style="padding-top:25px">
          <!-- <label for="email">.</label>  -->
          <input type="submit" class="btn btn-success btn-sm" placeholder="Enter email"  value="Search">
        

      </div>

  </div>
  <input type="hidden" id="memberid" name="memberid"/>
</form>
</div>
</div>
<div class="content">

    <div class="panel panel-flat">
        <div class="panel-body">
            
            <div class="table-responsive">
                <table class="table table-striped  table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>Loan Number</th>
                            <th>Amount</th>
                            <th>Rental frequancy</th>                       
                            <th>Loan Period</th>                       
                        
                            <th style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $path = 'images/user/'; ?>
                        @foreach($collections as $collection)
                        <tr>
                            <td>{{$collection->installement_date}}</td>
                            <td>{{$collection->loan_number}}</td>
                            <td>{{$collection->pay_amount}}</td>
                            <td>{{$collection->cre_nic_number}}</td>
                         

                            <td>
                                <button id="viewbtn" onclick="abc({{$collection->id}});" type="button" class="  btn btn-default btn-sm " >
                                    <i class="fa fa-file"></i> </button>
                                     
                                <a href="{{url('/admin/update_loan/'.$collection->id)}}" class="btn btn-info">   <i class="fa fa-edit"></i></a>
                                <button onclick="deleteconfirm({{$collection->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
    <div class="modal-dialog" role="document" style="width: 65%">
        <div class="modal-content" style="border-radius: 4px;" >
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Creditor details</h4>
                <button  style="margin-top:-15px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 10px">
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-6" style="">
                    <div style="width:auto;background-color:#f78a2c;margin-top:-20px;margin-bottom:5px">
                            <label for="email" style="color:white;padding:1px;padding-left:10px;padding-top:2px;padding-bottom:-10px">Creditor informations</label>
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Creditor Name:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="cre_name">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">NIC Number:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="cre_nic">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Phone Number:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="cre_phone">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Address:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="cre_address">
                        </div>
                        <div style="width:auto;background-color:#f78a2c;margin-top:-20px;margin-bottom:10px">
                            <label for="email" style="color:white;padding:1px;padding-left:10px">Other informations</label>
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Start date:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="start_date">
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Status:</label>
                            <div>
                            <span class="badge badge-success" id="loan_status"></span>
                            </div>
                        
                            <!-- <input type="text" style="border:none;margin:-10px" class="form-control" id="loan_status"> -->
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Issuer name:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="issuer">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div style="width:auto;background-color:#f78a2c;margin-top:-20px;margin-bottom:10px">
                            <label for="email" style="color:white;padding:1px;padding-left:10px">Loan informations</label>
                        </div>

                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold"> Loan Number :</label>

                            <input type="text" style="border:none;margin:-10px" class="form-control"id="loan_number">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Loan Amount:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="loan_amount">
                        </div>
                        <div class="form-group" style="margin-top:10px">
                            <label for="email" style="font-weight:bold">Issued Date:</label>
                            <input type="text" style="border:none;margin:-10px"class="form-control"id="loan_issue_date">
                        </div>

                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Rental Frequancy:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="loan_rental">
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Periods:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="loan_period">
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Loan with interest:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="loan_with_int">
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight:bold">Installemet amount:</label>
                            <input type="text" style="border:none;margin:-10px" class="form-control" id="loan_inst">
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
    url: "{{url('get_loan_by_id')}}" + "/" + id, //this is your uri
            type: 'get', //this is your method
            success: function (data) {
            $('#exampleModal').modal("show");
            $("#cre_name").val(data[0].cre_first_Name+" "+data[0].cre_last_Name);
            $("#cre_nic").val(data[0].cre_nic_number);
            $("#cre_phone").val(data[0].cre_phone_number);
            $("#cre_address").val(data[0].cre_address);
            $("#start_date").val(data[0].loan_start_date);
            $("#loan_status").val(data[0].status);
            $("#issuer").val(data[0].user_first_Name+" "+data[0].user_last_Name);
            $("#loan_number").val(data[0].loan_number);
            $("#loan_amount").val(data[0].loan_amount);
            $("#loan_issue_date").val(data[0].created_at  );
            $("#loan_rental").val(data[0].loan_rental_freq);
            $("#loan_period").val(data[0].loan_period);
            $("#loan_with_int").val(data[0].loan_with_int);
            $("#loan_inst").val(data[0].loan_installement);

            if (data[0].status == 1){
                document.getElementById("loan_status").innerHTML="Pending loan";
           $("#loan_status").css("background-color", "green");
            } else{
                document.getElementById("loan_status").innerHTML="Close loan";
                // $('#loan_status').text('The username already exists!');
			   $("#loan_status").css("background-color", "red");
            }

            // $("#role_name").val(data[0].role_name);
           

            }
    });
    }

    function deleteconfirm(id){
        swal({
                title: "Are you sure?",
                text: "Are you sure want to delete this loan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
         
                   
                    swal("Poof! this loan has been deleted!", {
                    icon: "success",
                 
                    }
                   
                    ).then((value) => {
                        window.location.href="{{url('admin/deleteloan')}}"+ "/" + id;
                         });
                    ;
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
		}

        $('#search').autocomplete({

        source: "{{URL::to('autocomplete2-searchCollector')}}",
        select: function (key, value) {

            console.log(value);
            $('#collector_id').val(value.item.id);
            // $('#cre_first_Name').val(value.item.cre_first_Name);
            // $('#last_name').val(value.item.last_Name);
            // $('#cre_phone_number').val(value.item.cre_phone_number);
            // $('#cre_address').val(value.item.cre_address);
            // $('#cre_id').val(value.item.id);
            
       

        }
})
</script>
@endsection