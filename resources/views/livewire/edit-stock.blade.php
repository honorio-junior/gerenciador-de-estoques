<div class="container-sm mt-4">
   <p class="text-center fs-1">Editar estoques</p>
   <div class="row mb-3">

      <div class="col-12">
         <form wire:submit='criar_produto' x-data='{openNewCategory : false, openNewProduct : false }'>

            <div class="mb-4" @click.outside="openNewProduct = false">
               <label for="" class="form-label" x-show="!openNewProduct">Estoque</label>
               <div class="input-group flex-nowrap" x-show="!openNewProduct">
                  <select wire:model.live="produto.stock_id" name="" id="" class="form-select" required>
                     <option value="">Selecione um estoque</option>
                     @foreach($estoques as $estoque)
                     @if($produto['stock_id'] == $estoque->id && $produto['stock_id'] > 0)
                     <option value="{{ $estoque->id }}" selected>{{ $estoque->creation_date->format('d/m/Y') }}</option>
                     @continue
                     @endif
                     <option value="{{ $estoque->id }}">{{ $estoque->creation_date->format('d/m/Y') }}</option>
                     @endforeach
                  </select>
                  @if($produto["stock_id"])
                  <a wire:click="excluir_estoque({{ $produto['stock_id'] }})" type="button" class="input-group-text text-decoration-none" id="addon-wrapping">-</a>
                  @endif
                  <a type="button" class="input-group-text text-decoration-none" id="addon-wrapping" @click="openNewProduct = !openNewProduct"
                     x-text="openNewProduct ? '-' : '+'">+
                  </a>
               </div>
               <div class="" x-show="openNewProduct">
                  <div class="mb-1">
                     <label for="" class="form-label">Novo estoque</label>
                     <input wire:model="data_estoque" type="date" class="form-control border-primary">
                  </div>
                  <button wire:click='criar_estoque' type="button" class="btn btn-primary col-12" @click="openNewProduct = !openNewProduct">Cadastrar</button>
               </div>
               @error('data_estoque')
               <p class="text-danger">* A {{ $message }}</p>
               @enderror
               @error('excluirEstoque')
               <p class="text-danger">* {{ $message }}</p>
               @enderror
            </div>

            <div class="row mb-2" @click.outside="openNewCategory = false">
               <label for="" class="form-label" x-show="!openNewCategory">Categoria</label>
               <div class="input-group flex-nowrap" x-show="!openNewCategory">
                  <select wire:model.live="produto.category_id" name="" id="" class="form-select" required>
                     <option value="">Selecione uma categoria</option>
                     @foreach($categorias as $categoria)
                     @if($produto['category_id'] == $categoria->id && $produto['category_id'] > 0)
                     <option value="{{ $categoria->id }}" selected>{{ $categoria->name }}</option>
                     @continue
                     @endif
                     <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                     @endforeach
                  </select>
                  @if($produto["category_id"])
                  <a wire:click="excluir_categoria({{ $produto['category_id'] }})" type="button" class="input-group-text text-decoration-none" id="addon-wrapping">-</a>
                  @endif
                  <a type="button" class="input-group-text text-decoration-none" id="addon-wrapping" @click="openNewCategory = !openNewCategory"
                     x-text="openNewCategory ? '-' : '+'">+
                  </a>
               </div>
               <div class="mb-2" x-show="openNewCategory">
                  <div class="mb-1">
                     <label for="" class="form-label">Nova categoria</label>
                     <input wire:model="nome_categoria" type="text" class="form-control col-8 border-primary" placeholder="Nome da nova categoria">
                  </div>
                  <button wire:click='criar_categoria' type="button" class="btn btn-primary col-12" @click="openNewCategory = !openNewCategory">Cadastrar</button>
               </div>
               @error('nome_categoria')
               <p class="text-danger">* O {{ $message }}</p>
               @enderror
               @error('excluirCategoria')
               <p class="text-danger">* {{ $message }}</p>
               @enderror
            </div>

            <div class="row mb-2">
               <div class="">
                  <label class="form-label">Produto</label>
                  <input wire:model="produto.name" type="text" class="form-control" placeholder="Nome do produto" required value="">
               </div>
               @error('produto.name')
               <p class="text-danger">* O {{ $message }}</p>
               @enderror
            </div>

            <div class="row mb-2">
               <div class="">
                  <label class="form-label">Quantidade</label>
                  <input wire:model="produto.amount" type="number" class="form-control" placeholder="Quantidade de produtos" required value="">
               </div>
               @error('produto.amount')
               <p class="text-danger">* A {{ $message }}</p>
               @enderror
            </div>

            <div class="row mb-4">
               <div class="">
                  <label class="form-label">Preço</label>
                  <div class="input-group">
                     <span class="input-group-text">R$</span>
                     <input wire:model="produto.price" class="form-control" placeholder="Preço do produto" required value="">
                  </div>
               </div>
               @error('produto.price')
               <p class="text-danger">* O {{ $message }}</p>
               @enderror
            </div>

            <button type="submit" class="btn btn-primary col-12" x-show="!openNewCategory && !openNewProduct">Cadastrar produto</button>

         </form>
      </div>

   </div>

   <div class="row p-3" x-data="{exibir : false}">
      <button wire:click="exibir_produtos()" type="button" class="btn btn-secondary mb-3 col-6 mx-auto" @click="exibir = !exibir">Mostrar produtos</button>
      <table class="table table-striped align-middle text-center" x-show="exibir">
         <thead>
            <tr>
               <th class="border">Nome</th>
               <th class="border">Cat.</th>
               <th class="border">Uni</th>
               <th class="border">R$</th>
               <th class="border">Ação</th>
            </tr>
         </thead>
         <tbody>
            @if (count($produtos) > 0)
            @foreach($produtos as $produto)
            <tr>
               <td class="border">{{ $produto->name }}</td>
               <td class="border">{{ $produto->category->name }}</td>
               <td class="border">{{ $produto->amount }}</td>
               <td class="border">{{ number_format($produto->price, 2, ',', '.') }}</td>
               <td class="border-end border-start"><button wire:click="excluir_produto({{ $produto->id }})" wire:confirm="Deletar produto? ({{$produto->name}})" type="button" class="btn btn-danger btn-sm">Excluir</button></td>
            </tr>
            @endforeach
            @else
            <tr>
               <td class="border" colspan="5">Nenhum produto encontrado</td>
            </tr>
            @endif
         </tbody>
      </table>

   </div>

</div>