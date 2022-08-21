<div class="modal fade" id="productViewModal{{ $product->id }}" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add" method="post">
                @csrf
                <div class="modal-body p-5">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row m-4">
                        <div>
                            <h1>{{ $product->name }}</h1>
                            <div>
                                <span class="fw-bold text-dark">${{ $product->cost }}</span>
                            </div>
                            <hr class="my-6">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>Release Date:</td>
                                    <td>{{ $product->release_date }}</td>
                                </tr>
                                <tr>
                                    <td>Manufacturer:</td>
                                    <td>{{ $product->manufacturer }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="card-body p-6">
                                <div class="row m-1">
                                    <h5 class="m-3 mt-1"><span class="fw-bold text-dark">Choose Services You Need</span>
                                    </h5>
                                    @foreach($services as $service)
                                        <div class="form-check col-5">
                                            <input class="form-check-input" id="{{ $service->id }}"
                                                   type="checkbox" name="servicesID[]" value="{{ $service->id }}"
                                                   checked="">
                                            <label class="form-check-label" for="{{ $service->id }}">
                                                {{ $service->type }}
                                            </label>
                                            <p>$ {{ $service->cost }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-start">
                                <div class="ms-2 col-5 d-grid">
                                    <label for="{{ $product->id }}"></label>
                                    <input id="{{ $product->id }}" name="productID"
                                           value="{{ $product->id }}" type="number" hidden>
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
