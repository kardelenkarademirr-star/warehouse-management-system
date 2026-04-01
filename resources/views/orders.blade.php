@extends('layouts.app.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4"><i class="bi bi-box-seam-fill"></i> Siparişler</h2>
        
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Sipariş ID</th>
                            <th>Müşteri</th>
                            <th>Durum</th>
                            <th>Toplam</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td class="text-secondary">{{ $order->customer ?? 'Bilinmeyen Müşteri' }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">Beklemede</span>
                                @else
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                @endif
                            </td>

                            <td>₺{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-view" style="border-radius:12px;">Detay</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection