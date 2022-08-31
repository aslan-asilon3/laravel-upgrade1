<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DataTables;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];

    protected $fillable = [
        'nama_produk',
        'created_at'
    ];

    public static function datatables($data_produk)
    {
        $datatables = Datatables::of($data_produk)
            ->editColumn('created_at', function(Product $data_produk) {
                if (!empty($data_produk->created_at)) {
                    $result = date("d M Y", strtotime($data_produk->created_at));
                } else {
                    $result = NULL;
                }
                return $result;
            })
            ->rawColumns([''])
            ->make(true);

        return $datatables;
    }
}
