@extends('layout')
@section('main_content')

    <div class="justify-content-around ">
        @if($totalCost !== 0.0)
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
                        <div class="text-uppercase">Total Cost</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong>$ {{ $totalCost }}</strong></td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a href="/buy" class="btn btn-primary btn-sm">
                                <i class="fa fa-shopping-cart"></i>BUY
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        @endif
        <div class="row grid">
            @foreach($cart as $order)
                <div class="col col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="text-uppercase">Product</div>
                                    </th>
                                    <th>
                                        <div class="text-uppercase">Cost</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>{{ $order->product->name }}</strong></td>
                                    <td><strong>$ {{ $order->product->cost }}</strong></td>
                                </tr>
                                </tbody>
                                @if($order->services !== [])
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>
                                                <div class="text-uppercase">Service</div>
                                            </th>
                                            <th>
                                                <div class="text-uppercase">Cost</div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->services as $service)
                                            <tr>
                                                <td><strong>{{ $service->type }}</strong></td>
                                                <td><strong>$ {{ $service->cost }}</strong></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(empty($cart))
                <h2 class="fw-normal text-lg-center">There is nothing to buy.</h2>
            @endif
        </div>
    </div>

@endsection
