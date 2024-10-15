<div class="pt-4">
  <div class="row mb-2 justify-content-center">
    <svg style="max-width: 35px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-basket col-1 align-self-center p-0 m-0" viewBox="0 0 16 16">
      <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5" />
    </svg>
    <div class="col-10 align-self-center ps-0">
      <select wire:model.live="estoque_id" class="form-select form-select bg-dark-subtle shadow-none border-dark-subtle rounded">
        <option selected>Selecione o estoque</option>
        @foreach($estoques as $estoque)
        <option value="{{ $estoque->id }}">{{ $estoque->creation_date->format('d/m/Y') }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row mb-4 justify-content-center">
    <svg style="max-width: 35px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark col-1 align-self-center p-0 m-0" viewBox="0 0 16 16">
      <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
    </svg>
    <div class="col-10 align-self-center ps-0 ">
      <select wire:model.live="categoria_id" class="form-select form-select bg-dark-subtle shadow-none border-dark-subtle rounded">
        <option value="0">Todas as categorias</option>
        @foreach($categorias as $categoria)
        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <p wire:loading class="mb-4 position-absolute start-50 translate-middle bg-secondary text-dark p-2 rounded fs-2">Carregando...</p>
  <div class="row p-2 mb-4 mx-1 justify-content-between border border-dark-subtle rounded">
    <p class="col-6 m-0"><span class="text-primary">{{ $produtos->count() }}</span> Produtos</p>
    <p class="col-6 m-0 text-success text-end">R$
      {{ number_format($produtos->sum(fn($produto) => $produto->price * $produto->amount), 2, ',', '.') }}
    </p>
  </div>
  <table class="table text-center table-striped">
    <thead>
      <tr class="border border-dark-subtle">
        <th class="col-3 text-secondary-emphasis border border-dark-subtle" scope="col">Nome</th>
        <th wire:click="ordenarAmount()" class="col-3 text-secondary-emphasis border border-dark-subtle texto-hover" scope="col">Uni <span class="fw-normal">{{$orderDirectionAmount}}</span></th>
        <th wire:click="ordenarPrice()" class="col-3 text-secondary-emphasis border border-dark-subtle texto-hover" scope="col">Valor <span class="fw-normal">{{$orderDirectionPrice}}</span></th>
        <th class="col-3 text-secondary-emphasis border border-dark-subtle" scope="col">Gastos</th>
      </tr>
    </thead>
    <tbody>
      @if (count($produtos) > 0)
      @foreach($produtos as $key => $produto)
      <tr class="border border-dark-subtle">
        <td class="col-3 align-content-center">{{ $produto->name }}</td>
        <td class="col-3 align-content-center">{{ $produto->amount }}</td>
        <td class="col-3 align-content-center">{{ number_format($produto->price, 2, ',', '.') }}</td>
        <td class="col-3 align-content-center">{{ number_format($produto->price * $produto->amount, 2, ',', '.') }}</td>
      </tr>
      @endforeach
      @else
      <tr class="border border-dark-subtle">
        <td colspan="4" class="col-12 text-center">Nenhum produto encontrado</td>
      </tr>
      @endif
    </tbody>
  </table>
</div>
