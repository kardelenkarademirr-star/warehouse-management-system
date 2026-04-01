@extends('layouts.app.app')

@section('content')

<div class="container mt-5 dash">
    <div class="d-flex flex-direction-row justify-content-between">
        <div class="col-md-3 m-4">
            <div class="card shadow box py-3">
                <div class="card-body">
                    <h5><i class="bi bi-cash-coin"></i> Toplam Kazanç</h5>
                    <h3>{{ number_format($totalEarnings, 2) }} TL</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 m-4">
            <div class="card shadow box py-3">
                <div class="card-body">
                    <h5><i class="bi bi-clock-history"></i> Bekleyen Sipariş</h5>
                    <h3>{{ $pendingOrders }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 m-4">
            <div class="card shadow box py-3">
                <div class="card-body">
                    <h5><i class="bi bi-box2-heart-fill"></i> Paketlenen</h5>
                    <h3>{{ $packedOrders }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body bg-light p-3">
        <table class="table table-striped align-middle">
            <h5>Son Siparişler</h5>
            <thead class="table-primary">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>
                        <span class="badge {{ $order->status == 'pending' ? 'bg-success' : 'bg-primary' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection