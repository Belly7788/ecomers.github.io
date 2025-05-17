@extends('Master-Layout')

@section('site-title', 'Edit-Brands')

@section('page-main-title', 'Brand => Edit Brands')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{ route('brands.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if (session('success'))
                            <p class="text-success text-center">{{ session('success') }}</p>
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
                                    <label for="formFile" class="form-label">Name Brands</label>
                                    <input class="form-control" type="text" name="brands" value="{{ old('brands', $brand->name) }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Name Company</label>
                                    <input class="form-control" type="text" name="company" value="{{ old('company', $brand->company) }}" />
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Remark</label>
                                    <textarea name="remark" class="form-control" cols="30" rows="10">{{ old('remark', $brand->remark) }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
