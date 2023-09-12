@extends('layout.main')

@section('container')
    <h3 class="mt-3">Order List</h3>
    <div class="text-end">
        <a href="/orders/create" type="button" class="btn btn-primary"><i class="bi bi-plus-square"></i> New Order</a>
    </div>
    <div class="table-responsive" style="padding-bottom: 10px">
        @if (session()->has('success'))
            <div class="alert alert-success mt-2" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped mb-10">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>{{ $orders->firstItem() + $key }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ $order->supplier_name }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td class="text-end">{{ number_format($order->total) }}</td>
                        <td>
                            <a href="/orders/{{ $order->id }}/edit?page={{ $orders->currentPage() }}"
                                class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="/orders/{{ $order->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                        class="bi bi-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <caption>
                {{ 'Showing ' . $orders->perPage() * $orders->currentPage() - ($orders->perPage() - 1) . ' to ' . $orders->perPage() * $orders->currentPage() . ' of ' . $orders->total() . ' results' }}
            </caption>

        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
@endsection
