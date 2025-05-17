@extends('Master-Layout')

@section('site-title', 'List-Product')

@section('page-main-title', 'Product => List Products')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                @if (session('message'))
                    <p class="text-success text-center">{{ session('message') }}</p>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Regular Price</th>
                                <th>Discount</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Author</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Avatar" class="rounded-circle" style="width: 50px; object-fit: cover; border-radius: 0px !important;">
                                        </ul>
                                    </td>
                                    <td><strong>{{ $product->name }}</strong></td>
                                    <td>${{ number_format($product->regular_price, 2) }}</td>
                                    <td>${{ number_format($product->discount, 2) }}</td>
                                    <td><span class="badge bg-label-success me-1">{{ $product->category ? $product->category->name : 'N/A' }}</span></td>
                                    <td><span class="badge bg-label-info me-1">{{ $product->brand ? $product->brand->name : 'N/A' }}</span></td>
                                    <td><span class="badge bg-label-warning me-1">{{ $product->user ? $product->user->name : 'N/A' }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('product.edit', $product->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal" onclick="setDeleteId({{ $product->id }})">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <form action="" method="post" id="deleteForm">
                    @csrf
                    <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this product?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="remove-val" name="remove-id">
                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <hr class="my-5" />
        </div>
    </div>

    <script>
        function setDeleteId(id) {
            document.getElementById('remove-val').value = id;
            document.getElementById('deleteForm').action = '{{ url("/product/delete") }}/' + id;
        }
    </script>
@endsection
