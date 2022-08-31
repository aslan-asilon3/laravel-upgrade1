<?php

namespace App\Http\Livewire\Produk;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{

    public $produks;

    public function render()
    {
        $produks = 'produks';

        $this->produks = Product::select('name')->get();
        return view('livewire.product.index');
    }
}
