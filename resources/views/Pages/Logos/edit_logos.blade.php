@extends('Master-Layout')

@section('site-title', 'Edit-Logos')

@section('page-main-title', 'Logo => Edit Logos')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{ route('logos.update', $logo->id) }}" method="post" enctype="multipart/form-data">
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
                                <div class="mb-3 col-12">
                                    <label for="image" class="form-label">Current Logo</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $logo->image) }}" alt="Current Logo" style="max-width: 200px; height: auto;">
                                    </div>
                                    <label for="image" class="form-label">Upload New Logo (Optional)</label>
                                    <input class="form-control" type="file" name="image" id="image" accept="image/*" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Logo</button>
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
