@extends('Master-Layout')

@section('site-title', 'Edit-Product')

@section('page-main-title', 'Product => Edit Product')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if (session('message'))
                            <p class="text-success text-center">{{ session('message') }}</p>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name', $product->name) }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="regular_price" class="form-label">Regular Price</label>
                                    <input class="form-control" type="number" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input class="form-control" type="number" name="discount" value="{{ old('discount', $product->discount) }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" class="form-control">
                                        @foreach ($categories as $catVal)
                                            <option value="{{ $catVal->id }}" {{ old('category', $product->category) == $catVal->id ? 'selected' : '' }}>{{ $catVal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="thumbnail" class="form-label text-danger">Thumbnail (Recommended size: 800x800 pixels)</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                    @if ($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" style="width: 100px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Product">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
