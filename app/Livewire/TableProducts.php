<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Category;

class TableProducts extends Component
{
    public $estoque_id = 0;
    public $categoria_id = 0;
    public $produtos;
    public $orderDirectionPrice = 'v';
    public $orderDirectionAmount = 'v';

    public function mount()
    {
        $this->produtos = collect();
    }

    public function updatedEstoqueId()
    {
        $this->carregarProdutos();
    }

    public function updatedCategoriaId()
    {
        $this->carregarProdutos();
    }

    public function ordenarPrice()
    {
        $this->orderDirectionPrice = $this->orderDirectionPrice === 'v' ? '^' : 'v';
        if ($this->orderDirectionPrice === 'v') {
            $this->produtos = $this->produtos->sortBy('price');
        }
        else {
            $this->produtos = $this->produtos->sortByDesc('price');
        }
    }

    public function ordenarAmount()
    {
        $this->orderDirectionAmount = $this->orderDirectionAmount === 'v' ? '^' : 'v';
        if ($this->orderDirectionAmount === 'v') {
            $this->produtos = $this->produtos->sortBy('amount');
        }
        else {
            $this->produtos = $this->produtos->sortByDesc('amount');
        }
    }

    public function carregarProdutos()
    {
        if($this->categoria_id == 0){
            $this->produtos = Product::with('category')->where('stock_id', $this->estoque_id)
            ->orderBy('price')
            ->get();
        } else{
            $this->produtos = Product::with('category')->where('stock_id', $this->estoque_id)
            ->where('category_id', $this->categoria_id)
            ->orderBy('price')
            ->get();
        }
    }

    public function render()
    { 
        return view('livewire.table-products',
            [
                'estoques' => Stock::all(),
                'categorias' => Category::all(),
                'produtos' => $this->produtos,
            ]
        );
    }
}
