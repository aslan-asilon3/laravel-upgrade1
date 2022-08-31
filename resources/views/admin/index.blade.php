@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
    <h3>
        Data User
    </h3>
@stop

@section('content')

    <!-- FILTER -->
    <div class="card card-outline card-danger collapsed-card w-100 h-3">
        <div class="card-header">
            <h5 class="card-title">Filter</h5>
            <div class="card-tools">
                <!-- Collapse Button -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
        </div>


        <div class="card-body">
            <form action="" method="GET" id="formFilter">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_name">Name</label>
                            <input type="text" class="form-control" id="" placeholder="ID Member" name="" value="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Email</label>
                            <input type="number" class="form-control" id="name" placeholder="No HP" name="name" value="" maxlength="50">
                        </div>


                    </div>
                    <div class="col-md-6">
                        <label >Limit</label><br/>
                        <select name="limit" class="form-control" id="limit" required>
                            <option value="">Select Limit</option>
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="5000">5000</option>
                            <option value="10000">10,000</option>
                            <option value="20000">20,000</option>
                            <option value="25000">25,000</option>
                        </select>
                    </div>
                </div>
                <span id="data_reference"></span>


                <div class="card-footer">
                    <div class="float-right">
                        <a type="button" class="btn btn-flat bg-purple" id="search"><i class="fas fa-search"></i> Filter</a>
                        <button type="submit" class="btn btn-flat bg-fuchsia" ><i class="fas fa-download"></i> Export Data member</button>
                        <a type="button" id="reset" class="btn btn-flat bg-secondary  btn-reset"><i class="fas fa-undo-alt"></i> Reset</a>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <div class="card card-outline card-danger collapsed-card w-100 h-3">
    <div class="mb-3"></div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                {{-- <h2>Users Management</h2> --}}
            </div>

            <div class="pull-right m-2">
                {{-- <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a> --}}
                <a class="btn btn-success" href=""> Create New User</a>
            </div>

        </div>
    </div>

        <table class="table table-bordered">
         <tr>
           <th>No</th>
           <th>Name</th>
           <th>Email</th>
           <th>Roles</th>
           <th width="280px">Action</th>
         </tr>
         {{-- @foreach ($data as $key => $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                   <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </td>
            <td>
               <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
               <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                <a class="btn btn-success" href="{{ route('users.destroy',$user->id) }}"> Delete</a>
            </td>
          </tr>
         @endforeach --}}
        </table>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-filter">
        <div class="modal-dialog modal-lg">
            <form id="search-form" role="form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="msisdn">No</label>
                                <input type="number" name="" id="" class="form-control mb-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="msisdn">Name</label>
                                <input type="tel" name="name" id="name" class="form-control mb-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="msisdn">Email</label>
                                <input type="tel" name="email" id="email" class="form-control mb-2" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit-filter" class="btn btn-primary btn-flat">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@stop

@section('custom_js')
<script type="text/javascript" src="{{ asset('vendor/datatables/FixedHeader-3.2.1/js/dataTables.fixedHeader.js') }}"></script>
{{-- <script type="text/javascript">
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tabel = $('#user_table').DataTable({
        processing: true,
        ordering: true,
        serverSide: true,
        // searching: false,
        ajax: {
            url: "{{ route('ajax-user') }}",
            type: 'POST',
            data: function (d) {
                d.name     = $('#name').val();
                d.email     = $('#email').val();
                d.created_at        = $('#created_at').val();
            }
        },
        deferRender: true,
        columns: [
            { "data": "id", "name": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name", "name": "name" },
            { "data": "email", "name": "email" },
            { "data": "created_at", "name" : "created_at" },
        ],
        pageLength: 50,
        lengthMenu: [
            [ 10, 50, 100, 300, 400 ],
            [ '10 rows', '50 rows', '100 rows', '300 rows', '400 rows']
        ]
    });

    $('#search').click(function(){
            tabel.draw();
        })

    $('#submit-filter').on('click',function (e) {
        console.log($('#id').val());
        $('#modal-filter').modal('hide');
        tabel.draw();
        e.preventDefault();
        $('.btn-reset').show();
    });

    $("#filter-show").on('click',function (e) {
        $('#modal-filter').modal('show');
    });


    $('#reset').click(function(e) {
            $("#search-form").trigger("reset");
            tabel.draw();
            e.preventDefault();
            $('.btn-reset').show();
        });



    $('#search').click(function(){
            tabel.draw();
        });


    $(".btn-export").on('click',function (e) {

            document.getElementById('produk-export').submit();
            $("#progressBar").show();
        // }
    });

});
</script>
@stop --}}

