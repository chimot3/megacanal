@extends('layout.main')

@section('container')
    <h3 class="mt-3 mb-4">Create New Order</h3>
    <div class="col-lg-8">
        <form action="/orders/{{ $order->id }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="page" value="{{ $order->page }}">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="order_number" class="form-label">Order Number</label>
                <input type="number" class="form-control @error('order_number') is-invalid @enderror" id="order_number"
                    name="order_number" required value="{{ old('order_number', $order->order_number) }}" min="1"
                    max="99999999999999999999" autofocus>
                @error('order_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                    required value="{{ old('date', date('Y-m-d', strtotime($order->date))) }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="supplier_name" class="form-label">Supplier Name</label>
                <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" id="supplier_name"
                    name="supplier_name" required value="{{ old('supplier_name', $order->supplier_name) }}" maxlength="50">
                @error('supplier_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                    name="product_name" required value="{{ old('product_name', $order->product_name) }}" maxlength="50">
                @error('product_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control @error('total') is-invalid @enderror" id="total"
                    name="total" required value="{{ old('total', $order->total) }}" min="1" max="99999999">
                @error('total')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <a href="/orders/?page={{ $order->page }}" class="btn btn-danger mb-5">Cancel</a>
            <button type="submit" class="btn btn-primary mb-5">Update Order</button>
        </form>
    </div>
    <script>
        let date = document.getElementById('date');
        date.addEventListener('change', (e) => {
            let dateVal = e.target.value
            document.getElementById('date').value = dateVal
        })
    </script>
@endsection
