@extends('layouts.app')

@section('content')

<h2>Nueva Venta</h2>

<form method="POST" action="{{ route('sales.store') }}">
@csrf


<!-- Cliente -->
<div class="mb-3">
    <label>Cliente</label>

    <select name="client_id" class="form-control" required>

        <option value="">Seleccione</option>

        @foreach($clients as $c)
            <option value="{{ $c->id }}">
                {{ $c->name }}
            </option>
        @endforeach

    </select>
</div>


<!-- Productos -->
<h5>Productos</h5>

@foreach($products as $p)

<div class="row mb-2">

    <div class="col-4">
        {{ $p->name }}
    </div>

    <div class="col-2">
        ${{ $p->price }}
    </div>

    <div class="col-3">

        <input type="number"
               name="products[{{ $loop->index }}][quantity]"
               class="form-control"
               min="0">

    </div>

    <input type="hidden"
           name="products[{{ $loop->index }}][id]"
           value="{{ $p->id }}">

    <input type="hidden"
           name="products[{{ $loop->index }}][price]"
           value="{{ $p->price }}">

</div>

@endforeach


<button class="btn btn-primary mt-3">
    Guardar Venta
</button>

</form>

@endsection
