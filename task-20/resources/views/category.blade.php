@extends('layout')
@section('main_content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($products as $product)
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2>
                            {{ $product->name }}
                        </h2>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-dark">${{ $product->cost }}</span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#productViewModal{{ $product->id }}">
                                    View
                                </button>
                                @include('product', ['product' => $product, 'services' => $services])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
