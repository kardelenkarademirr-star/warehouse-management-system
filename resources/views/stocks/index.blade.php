@extends('layouts.app.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-4"><i class="bi bi-database"></i> Depo Stok Durumu</h2>
        <button class="btn btn-outline-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addStockModal">
            <i class="bi bi-plus-circle"></i> Stok Girişi Yap
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th class="ps-4">Ürün</th>
                        <th>Konum (Raf/Depo)</th>
                        <th>Mevcut Stok</th>
                        <th>Son Güncelleme</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $stock->product->name }}</div>
                            <small class="text-muted">{{ $stock->product->sku }}</small>
                        </td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $stock->location->name ?? 'Konum Belirtilmedi' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-bold {{ $stock->quantity < 10 ? 'text-danger' : 'text-dark' }}">
                                {{ $stock->quantity }} Adet
                            </span>
                        </td>
                        <td class="text-muted">{{ $stock->updated_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addStockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-4"> <h4 class="fw-bold">Stok Girişi</h2>

        <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ürün Seçin</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">-- Ürün Seçiniz --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Depo Konumu (Raf)</label>
                        <select name="warehouse_location_id" class="form-select" required>
                            <option value="">-- Raf/Bölüm Seçiniz --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Miktar (Adet)</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Başarılı!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Tamam',
            timer: 3000 // 3 saniye sonra otomatik kapanır
        });
    </script>
    @endif
@endsection