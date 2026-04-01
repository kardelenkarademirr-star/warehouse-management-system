@extends('layouts.app.app')
@section('content')
    <div class="container mt-5">
        <h3>Paketleme İstasyonu: Sipariş #{{ $package->id }}</h3>
        <p>Müşteri: {{ $package->customer_name }}</p>
        
        <table class="table">
            @foreach($package->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }} Adet</td>
                    <td><input type="checkbox" class="check"> Toplandı</td>
                </tr>
            @endforeach
        </table>

        <form action="{{ route('package.pack', $package->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Paketlemeyi Bitir</button>
        </form>
    </div>
@endsection