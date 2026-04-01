@extends('layouts.app.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-4"><i class="bi bi-inboxes-fill"></i> Ürünler</h2>
        <button class="btn btn-outline-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-circle"></i> Yeni Ürün Ekle </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>Ürün Adı</th>
                        <th>SKU/Barkod</th>
                        <th>Birim Fiyat</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>₺{{ number_format($product->price, 2) }}</td>
                        <td class="text-start">
                            <button class="btn btn-sm min-w-25" style="background-color:#A3D78A">Düzenle</button>
                            <button class="btn btn-sm min-w-25" style="background-color:#FF937E;">Sil</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Henüz ürün eklenmemiş.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-4"> <h4 class="fw-bold">Yeni Ürün</h4>
            
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <input type="text" name="name" class="form-control mb-2" placeholder="Ürün Adı" required>
                <input type="text" name="sku" class="form-control mb-2" placeholder="SKU / Barkod" required|unique:products>
                <input type="number" name="price" class="form-control mb-3" placeholder="Fiyat" required|numeric>
                
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