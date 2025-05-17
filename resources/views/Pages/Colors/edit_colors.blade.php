@extends('Master-Layout')

@section('site-title', 'Edit-Colors')

@section('page-main-title', 'Color => Edit Colors')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{ route('colors.update', $color->id) }}" method="post" enctype="multipart/form-data">
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
                                    <label for="color_name" class="form-label">Color Name</label>
                                    <input class="form-control" type="text" name="color_name" id="color_name" value="{{ old('color_name', $color->color_name) }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="hex_color" class="form-label">Hex Color</label>
                                    <input class="form-control" type="text" name="hex_color" id="hex_color" value="{{ old('hex_color', $color->hex_color) }}" />
                                </div>
                                {{-- <div class="mb-3 col-6">
                                    <label for="user_id" class="form-label">Created By</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        <option value="">Select User</option>
                                        @foreach (\App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $color->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3 col-12">
                                    <label for="remark" class="form-label text-danger">Remark</label>
                                    <textarea name="remark" id="remark" class="form-control" cols="30" rows="10">{{ old('remark', $color->remark) }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Color</button>
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
