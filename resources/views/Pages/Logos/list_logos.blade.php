@extends('Master-Layout')

@section('site-title', 'List-Logos')

@section('page-main-title', 'Logo => List Logos')

@section('content')
    <style>
        .content-wrapper {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .table-container {
            flex: 1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .table-responsive {
            flex: 1;
            overflow: hidden;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table thead {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 1;
        }

        .table tbody {
            display: block;
            overflow-y: auto;
            height: 600px;
            max-height: calc(100vh - 200px);
        }

        .table tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .table thead, .table tbody tr {
            display: table;
            width: 100%;
        }

        .pagination-container {
            padding: 1rem;
            background: #fff;
        }

        .thumbnail-img {
            max-width: 100px;
            height: auto;
        }
    </style>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card table-container">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($logos as $key => $logo)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo" class="thumbnail-img">
                                    </td>
                                    <td>{{ $logo->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('logos.edit', $logo->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item delete-logo" href="javascript:void(0);" data-id="{{ $logo->id }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No logos found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    <div class="d-flex justify-content-center">
                        {{ $logos->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif

            document.querySelectorAll('.delete-logo').forEach(button => {
                button.addEventListener('click', function () {
                    const logoId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('{{ url('logos/delete') }}/' + logoId, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                },
                            }).then(response => {
                                console.log('Response Status:', response.status);
                                if (!response.ok) {
                                    throw new Error('Network response was not ok: ' + response.statusText);
                                }
                                return response.json();
                            }).then(data => {
                                Swal.fire(
                                    'Deleted!',
                                    data.message || 'Logo has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            }).catch(error => {
                                console.error('Error:', error);
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong. Check the console for details.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
