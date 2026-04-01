@extends('layouts.app.app')

@section('content')

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="fw-bold mb-4">Sipariş Detayı #{{ $order->id }}</h3>
        <hr>
        <p><strong>Müşteri:</strong> {{ $order->customer }}</p>
        <p><strong>Durum:</strong> {{ $order->status }}</p>
        <p><strong>Toplam Tutar:</strong> ₺{{ number_format($order->total_amount, 2) }}</p>

        <table class="table table-striped align-middle table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Ürün Adı</th>
                    <th>Adet</th>
                    <th>Birim Fiyat</th>
                    <th>Toplam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->items as $item)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $item->product->name }}</div>
                        <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                    </td>
                    <td>{{ $item->quantity }} Adet</td>
                    <td>₺{{ number_format($item->price, 2)}}</td>
                    <td>₺{{ number_format($item->quantity * $item->price, 2)}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text center text-muted py-3">Bu siparişe ait ürün bulunamadı.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($order->status == 'pending')
            <form id="packForm" action="{{ route('order.pack', $order->id) }}" method="POST" class="mt-4">
                @csrf
                <button type="button" onclick="startLoading()" class="btn btn-success px-5 py-2 fw-bold">
                    📦 Paketlemeyi Onayla & Etiket Üret
                </button>
            </form>
        @else
            <div class="alert alert-secondary mt-4">Bu sipariş zaten paketlenmiş.</div>
        @endif

        <a href="{{ route('orders') }}" class="btn btn-link mt-2 text-secondary">Geri Dön</a>
    </div>
</div>

<script>
function startLoading() {
    let timerInterval;
    
    Swal.fire({
        title: 'Paketleniyor...',
        html: 'Ürünler doğrulanıyor, stoklar güncelleniyor. <br> <b></b> ms kaldı.',
        timer: 3000, 
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b');
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            document.getElementById('packForm').submit();
        }
    });
}
</script>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Başarılı!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Tamam',
            timer: 2000 // 3 saniye sonra otomatik kapanır
        });
    </script>
    @endif
@endsection