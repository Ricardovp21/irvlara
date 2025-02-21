@extends('layouts.app')

@section('content')
<h1>Productos</h1>
@foreach ($products as $product)
    <div class="product">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">
        <h3>{{ $product->name }}</h3>
        <p>${{ $product->price }}</p>
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>
@endforeach
@endsection
