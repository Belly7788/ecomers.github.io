@extends('Master-Layout')

@section('site-title', 'Add-Product')

@section('page-main-title', 'Product => Add Products')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
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
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="regular_price" class="form-label">Regular Price</label>
                                    <input class="form-control" type="number" name="regular_price" value="{{ old('regular_price') }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input class="form-control" type="number" name="discount" value="{{ old('discount') }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $catVal)
                                            <option value="{{ $catVal->id }}" {{ old('category_id') == $catVal->id ? 'selected' : '' }}>{{ $catVal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="thumbnail" class="form-label text-danger">Thumbnail (Recommended size: 800x800 pixels)</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="color_id" class="form-label">Colors</label>
                                    <select name="color_id[]" class="form-control" multiple>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" {{ in_array($color->id, old('color_id', [])) ? 'selected' : '' }}>{{ $color->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="size_id" class="form-label">Sizes</label>
                                    <select name="size_id[]" class="form-control" multiple>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}" {{ in_array($size->id, old('size_id', [])) ? 'selected' : '' }}>{{ $size->name_size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input class="form-control" type="number" name="stock" value="{{ old('stock') }}" min="0" />
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Product">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
