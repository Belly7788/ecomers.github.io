@extends('Master-Layout')

@section('site-title', 'Edit-Sizes')

@section('page-main-title', 'Size => Edit Sizes')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{ route('sizes.update', $size->id) }}" method="post" enctype="multipart/form-data">
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
                                    <label for="formFile" class="form-label">Size Name</label>
                                    <input class="form-control" type="text" name="name_size" value="{{ old('name_size', $size->name_size) }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Size Number</label>
                                    <input class="form-control" type="number" name="number_zise" value="{{ old('number_zise', $size->number_zise) }}" />
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Remark</label>
                                    <textarea name="remark" class="form-control" cols="30" rows="10">{{ old('remark', $size->remark) }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Size</button>
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
