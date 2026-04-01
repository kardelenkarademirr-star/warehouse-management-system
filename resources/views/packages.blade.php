@extends('layouts.app.app') 

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-4"><i class="bi bi-boxes"></i> Bekleyen Paketler</h2>
        <button onclick="generateFakeOrder()" class="btn btn-warning shadow-sm min-w-15">
        <i class="bi bi-lightning-charge"></i>Fake Sipariş</button>
    </div>

    <script>
    function generateFakeOrder() {
        const customers = ["Ahmet Yılmaz", "Ayşe Demir", "Mehmet Can", "Zeynep Kaya"];
        const randomCustomer = customers[Math.floor(Math.random() * customers.length)];

        const productId = [1,2,3,4];
        const randomProduct = productId[Math.floor(Math.random() * productId.length)];
        const randomQuantity = Math.floor(Math.random() * 20) +1;

        
        const orderData = {
            customer: randomCustomer,
            items: [
                { product_id: randomProduct, quantity: randomQuantity }
            ]
        };

    
        fetch('/api/v1/new-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            alert(`Yeni Sipariş: #${data.order_id}\nMüşteri: ${randomCustomer}\nToplam Tutar: ${data.total} TL`);
            location.reload(); 
        })
        .catch(error => console.error('Hata:', error));
    }
    </script>
    </div>

    <div class="row">
        @forelse($packages as $package)
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">#{{ $package->id }}</h5>
                        <span class="badge bg-warning text-dark">Hazırlanıyor</span>
                    </div>
                    <p class="text-muted mb-1"><i class="bi bi-person"></i> {{ $package->customer_name }}</p>
                    <p class="small text-secondary"><i class="bi bi-calendar"></i> {{ $package->created_at->format('d.m.Y H:i') }}</p>
                    <hr>
                    <a href="{{ route('package.show', $package->id) }}" class="btn btn-outline-primary w-100">
                        Süreci Başlat <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-check2-circle display-1 text-success"></i>
            <h4 class="mt-3">Tüm paketler gönderildi!</h4>
        </div>
        @endforelse
    </div>
</div>
@endsection