<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use DataTables;
use App\Imports\ImportProduct;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTemplateProduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;



class ProductController extends Controller
{
    function index()
    {
        // $list_batch = Unicharmproduk::getBatch();
        $products = Product::all();
        return view('livewire/product/index', compact('products'));
    }

    public function ajax(Request $request)
    {
        $data_produk = Product::select('id', 'name', 'created_at');
        if(!empty($request->name)) {
            $data_produk->where('name', $request->name);
        }


        if (!empty($request->created_at)) {
            $data_produk->where('created_at', $request->created_at);
        }

        $data_produk->orderBy('id', 'ASC');

        $datatables = Product::datatables($data_produk);

        return $datatables;
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|max:22000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file');

        $import = new ImportProduct;
        Excel::import($import, $path);


        return redirect('/data-produk')->with('success', 'The file has been excel imported to database rows');
    }

    public function export(Request $request)
    {
        // $data = $request->all();
        // return Excel::download(new ExportDataSales($data), 'data-sales ' . now() . '.xlsx');
    }


    public function DownloadTemplate()
    {
        $filename    = 'template-product.xlsx';
        $file_path     = public_path() . "/download/" . $filename;

        if (file_exists($file_path)) {

            return Response::download($file_path, $filename);
        } else {

            return back()->with('error', 'Template Not ready!');
        }
    }



}
