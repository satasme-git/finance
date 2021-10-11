@extends('Layouts.app_web')
@section('content')
<link href="{{ asset('css/plugins/dataTables/datatables.css')}}">
<!-- Page header -->
<div class="page-header">

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Creditor</span> - View creditor loans</h4>
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
            <li><a href="/admin/view_creditor">Creditor</a></li>
            <li class="active">View creditor loans</li>
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

<div class="content" style="margin-bottom:-40px">
    <div class="col-md-12" style="background-color: #e0e0e0;padding-top:5px;padding-bottom:5px">



        <form action="/serch_by_creditor_nic" method="POST">
            {{csrf_field()}}
            <div class="col-sm-10">
                <div class="form-group {{ $errors->has('search') ? ' has-error' : '' }}">
                    <label for="email">Creditor NIC:</label>
                    <input type="hidden" class="form-control" id="creditor_id" name="creditor_id" placeholder="Enter creditor nic">
                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{Session::get('user_info.id')}}">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Enter creditor nic">
                </div>
                @if ($errors->has('search'))
                <span class="help-block">
                    <strong style="color: #ff0000">{{ $errors->first('search') }}</strong>
                </span>
                @endif
            </div>


            <div  class="col-sm-2">
                <div class="form-group ">
                    <!-- <label for="email">.</label>  -->
                    <input type="submit" class="btn btn-success btn-sm" placeholder="Enter email"  value="Search">


                </div>

            </div>
            <input type="hidden" id="memberid" name="memberid"/>
        </form>
    </div>
</div>
<!-- Content area -->
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped  table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <!-- <th>Image</th> -->
                                       
                            <th>Loan Number</th>  
                            <th>Amount</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                    @if (empty($loans))

                    @else
                        @foreach($loans as $loan)
                        <tr>
                            <td>{{$loan->loan_number}}</td>
                            <td>{{$loan->loan_amount}}</td>
                           
                         

                            <td>
                                
                                     
                                <a href="{{url('/admin/dailycollectionbyloan_id/'.$loan->id)}}" class="btn btn-success">   View</a>
                               
                            </td>

                        </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- 2 columns form -->


<script>
    // $(document).ready(function(){
    // $('.dataTables-example').DataTable({
    // });
    // });
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
    

    $('#search').autocomplete({

        

        source: "{{URL::to('autocomplete2-searchloanbycreditor')}}",

                select: function (key, value) {

                    console.log(value);
                    $('#creditor_id').val(value.item.id);
        
                    
                    


                }
})




</script>
<script>


    function deleteconfirm(id){
    swal({
    title: "Are you sure?",
            text: "Are you sure want to delete this creditor",
            icon: "warning",
            buttons: true,
            dangerMode: true,
    })
            .then((willDelete) => {
            if (willDelete) {


            swal("Poof! this Creditor has been deleted!", {
            icon: "success",
            }

            ).then((value) => {
            window.location.href = "{{url('admin/deletecreditor')}}" + "/" + id;
            });
            ;
            } else {
            swal("Your imaginary file is safe!");
            }
            });
    }
</script>
@endsection