<?php

namespace App\Livewire;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;

class EditStock extends Component
{
    public $data_estoque;
    public $nome_categoria;
    public $carregarProdutos = false;
    public $produto = ["stock_id" => '', "category_id" => '', "name" => '', "amount" => '', "price" => ''];

    public function criar_estoque()
    {
        $this->data_estoque = \Carbon\Carbon::parse($this->data_estoque)->startOfDay();
        $this->validate([
            'data_estoque' => 'required|date|unique:stocks,creation_date'
        ]);
        $stock = Stock::create(['creation_date' => $this->data_estoque]);
        $this->produto['stock_id'] = $stock->id;
        
    }

    public function criar_categoria()
    {
        $this->nome_categoria = ucwords(trim($this->nome_categoria));
        $this->validate([
            'nome_categoria' => 'required|string|unique:categories,name'
        ]);
        $category = Category::create(['name' => $this->nome_categoria]);
        $this->produto['category_id'] = $category->id;
        
    }

    public function criar_produto()
    {
        $this->produto['price'] = str_replace(',', '.', $this->produto['price']);
        $this->produto['price'] = floatval($this->produto['price']);
        $this->produto['name'] = ucwords(trim($this->produto['name']));
        $this->validate([
            'produto.stock_id' => 'required|integer|exists:stocks,id',
            'produto.category_id' => 'required|integer|exists:categories,id',
            'produto.name' => 'required|string|max:255',
            'produto.amount' => 'required|integer',
            'produto.price' => 'required|numeric',
        ]);

        Product::create($this->produto);
        $this->produto['name'] = '';
        $this->produto['amount'] = '';
        $this->produto['price'] = '';
    }

    public function excluir_produto($id)
    {
        $produto = Product::find($id);
        if ($produto) {
            $produto->delete();
            $this->produto['name'] = '';
            $this->produto['amount'] = '';
            $this->produto['price'] = '';
        }
    }

    public function excluir_categoria($categoryId)
    {
        $produtos = Product::where('category_id', $categoryId)->get();

        if ($produtos->isNotEmpty()) {
            $this->addError('excluirCategoria', 'Existem produtos com esta categoria!');
            return;
        }
        $category = Category::query()->find($categoryId);
        if ($category) {
            $category->delete();
            $this->produto['category_id'] = '';
            return;
        }
    }

    public function excluir_estoque($stockId)
    {
        $produtos = Product::where('stock_id', $stockId)->get();

        if ($produtos->isNotEmpty()) {
            $this->addError('excluirEstoque', 'Existem produtos neste estoque!');
            return;
        }
        $stock = stock::query()->find($stockId);
        if ($stock) {
            $stock->delete();
            $this->produto['stock_id'] = '';
            return;
        }
    }

    public function produtos()
    {
        if ($this->carregarProdutos) {
            $produtos = Product::with('category')
                ->where('stock_id', $this->produto['stock_id'])
                ->get();
            return $produtos;
        }
        return [];
    }

    public function exibir_produtos()
    {
        $this->carregarProdutos = !$this->carregarProdutos;
    }

    public function render()
    {
        $produtos = $this->produtos();
        $this->data_estoque = '';
        $this->nome_categoria = '';

        return view(
            'livewire.edit-stock',
            [
                'estoques' => Stock::all(),
                'categorias' => Category::all(),
                'produtos' => $produtos,
            ]
        );
    }
}
