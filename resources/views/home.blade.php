<x-layouts.app :title="$title">
    <div class="container justify-content-center align-content-center" style="height: 70vh">
        <div class="list-group">
            <a href="{{route('exibir')}}" class="list-group-item list-group-item-action text-center">Exibir estoque</a>
            <a href="{{route('editar')}}" class="list-group-item list-group-item-action text-center">Editar estoques</a>
        </div>
    </div>
</x-layouts.app>