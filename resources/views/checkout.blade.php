@extends('layouts.app')

@section('content')
<form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="hidden" name="amount" value="{{ session('cart_total', 0) }}">
    <button type="submit">Pagar</button>
</form>
@endsection
