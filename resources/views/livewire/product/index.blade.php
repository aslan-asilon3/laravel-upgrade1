@extends('adminlte::page')

@section('title', 'Data Produk')

@section('content_header')
    <h3>
        Data Produk
    </h3>
@stop

@section('content')
<style>


    /*left right modal*/
.modal.left_modal, .modal.right_modal{
  position: fixed;
  z-index: 99999;
}
.modal.left_modal .modal-dialog,
.modal.right_modal .modal-dialog {
  position: fixed;
  margin: auto;
  width: 22%;
  height: 100%;
  -webkit-transform: translate3d(0%, 0, 0);
      -ms-transform: translate3d(0%, 0, 0);
       -o-transform: translate3d(0%, 0, 0);
          transform: translate3d(0%, 0, 0);
}

.modal-dialog {
    /* max-width: 100%; */
    margin: 1.75rem auto;
}
@media (min-width: 576px)
{
.left_modal .modal-dialog {
    max-width: 100%;
}

.right_modal .modal-dialog {
    max-width: 100%;
}
}
.modal.left_modal .modal-content,
.modal.right_modal .modal-content {
  /*overflow-y: auto;
    overflow-x: hidden;*/
    height: 100vh !important;
}

.modal.left_modal .modal-body,
.modal.right_modal .modal-body {
  padding: 15px 15px 30px;
}

/*.modal.left_modal  {
    pointer-events: none;
    background: transparent;
}*/

.modal-backdrop {
    display: none;
}


/*Right*/
.modal.right_modal.fade .modal-dialog {
  right: -50%;
  -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
     -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
       -o-transition: opacity 0.3s linear, right 0.3s ease-out;
          transition: opacity 0.3s linear, right 0.3s ease-out;
}



.modal.right_modal.fade.show .modal-dialog {
  right: 0;
  box-shadow: 0px 0px 19px rgba(0,0,0,.5);
}

/* ----- MODAL STYLE ----- */
.modal-content {
  border-radius: 0;
  border: none;
}



.modal-header.left_modal, .modal-header.right_modal {

  padding: 10px 15px;
  border-bottom-color: #EEEEEE;
  background-color: #FAFAFA;
}

.modal_outer .modal-body {
    /*height:90%;*/
    overflow-y: auto;
    overflow-x: hidden;
    height: 91vh;
}
</style>


<!-- FILTER -->
<div class="card card-outline card-danger collapsed-card" >
    <div class="card-header">
        <h3 class="card-title">Filter <br></h3>
        <div class="card-tools">
            <!-- Collapsß Button -->
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            
        </div>
        <p style="color:red;display:none;" class="info-limit" > <br> Limit digunakan untuk membatasi jumlah baris data yang akan di export maksimal 20.000 data </p>
    </div>

    <div class="card-body" >
        <form action="{{route('product-export')}}" method="POST"  id="search-form">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">

                    <label for="recipient">Nama Produk</label>
                    <input type="text" name="nam" id="nam" class="form-control mb-2" />

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
                    </select>
                </div>
            </div>
            <span id="data_reference_download"></span>
            <input id="reference_download" type="hidden" name="reference_download" value="">
        {{-- </form> --}}
    </div>

    <div class="card-footer">
        <div class="float-right">
            <a type="button" class="btn btn-flat bg-primary" id="search"><i class="fas fa-search"></i> Filter</a>
            <a type="button" class="btn btn-flat bg-fuchsia" ><i class="fas fa-csv"></i> Export CSV</a>
            <a type="button" class="btn btn-flat bg-red" ><i class="fas fa-pdf"></i> Export PDF</a>
            <button type="submit" class="btn btn-flat bg-green" id="download"><i class="fas fa-excel"></i> Export Excel</button>
            <a type="button" id="reset" class="btn btn-flat bg-secondary  btn-reset"><i class="fas fa-undo-alt"></i> Reset</a>
        </div>
    </div>
</div>


    <div class="card">
        <div class="card-body">
            <div class="row pl-2" >
                    @csrf  
                    
                    {{-- import right side --}}
                    <button class="btn  btn-success mt-3 btn-import-sales" type="button" id="btn-import" data-toggle="modal" data-target="#information_modal"><i class="fas fa-upload"></i> Import Data Produk</button>
                        <div class="progress" id="progressBar" style="text-align: center;height:20px; display:none" >
                            <div class="bar" style="text-align: center;height:20px;"></div >
                            <div class="percent" style="text-align: center; height:20px; padding-top:10px;margin:none;">0%</div >
                        </div>
                    </div>
                </form>
            </div>
            

            
            @if(count($errors) > 0)
            <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif

            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
            <a type="button" class="close" data-dismiss="alert">×</a>
                    <strong>{{ $message }}</strong>
            </div>
            @endif

            <div class="row p-3">
                <div class="col-md-12">
                            <div class="table-responsive" id="">
                                <table class="table table-bordered center" id="" style="width:100%;">
                                    <thead class="thead-light text-primary">
                                        <tr>
                                            {{-- <th class="text-center">No</th> --}}
                                            <th class="text-center">Product ID</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">created At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                        <tr>
                                            @foreach ($products as $product)
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($product->created_at)->format('j F Y')}}
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-info" href=""> <i class="fas fa-eye"></i> </a>
                                                    <a type="button" class="btn btn-danger" href=""> <i class="fas fa-trash"></i> </a>
                                                    <a type="button" class="btn btn-success" href=""> <i class="fas fa-edit"></i> </a>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
        </div>
    </div>





    <!-- left modal -->
    <div class="modal modal_outer right_modal fade" id="information_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" >
            <div class="modal-dialog" role="document">
                <form method="post" action="" id="produk-import" enctype="multipart/form-data">
                    <div class="modal-content ">
                        <!-- <input type="hidden" name="email_e" value="admin@filmscafe.in"> -->
                        <div class="modal-header">
                        <h2 class="modal-title">Input Data Produk:</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body get_quote_view_modal_body">
                                    @csrf

                                    @if (session('error'))
                                        <div class="alert alert-success">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">File (.xls, .xlsx)</label>
                                        <input type="file" class="form-control file" name="file">
                                        <p class="text-danger">{{ $errors->first('file') }}</p>

                                        <a href="" class="btn btn-info" ><i class="fas fa-download"></i>Download Template Excel</a>
                                    </div>

                                    <div class="">
                                        <p style="font-size:17px;font-weight:bold">Langkah-langkah import data Produk</p>

                                        <ol>
                                        <li>Klik tombol <b> Browse</b> dan pilih file excel yang akan di import, <br> perhatikan limit pada saat import data excel maksimal 20.000 baris data </li>
                                        <br>
                                        <li>Klik tombol <b> Download Template Excel </b>untuk mendownload template excel,<br> template ini digunakan untuk menginput data Produk secara manual </li>
                                        <br>
                                        {{-- <li>Milk</li> --}}
                                        </ol> 
                                    </div>
                
                                    <span id="data_reference_import"></span>
                                    <input id="reference_import" type="hidden" name="reference_import" value="">
                                    <input id="type_input" type="hidden" name="type_input" value="import">
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-secondary btn-flat" data-dismiss="modal"><i class="fas fa-times"></i> Close</a>
                                    <button id="" type="submit" class="btn bg-lime btn-flat"><i class="fas fa-upload"></i> Import</button>
                                </div>
                    </div><!-- modal-content -->
                </form>
            </div><!-- modal-dialog -->
    </div><!-- modal -->






@stop
@section('custom_js')
<script type="text/javascript" src="{{ asset('vendor/datatables/FixedHeader-3.2.1/js/dataTables.fixedHeader.js') }}"></script>

