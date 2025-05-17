@extends('Master-Layout')

@section('site-title', 'List-Brands')

@section('page-main-title', 'Brand => List Brands')

@section('content')
    <style>
        /* Ensure the content wrapper takes full viewport height */
        .content-wrapper {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Make the table container take available space */
        .table-container {
            flex: 1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Style the table */
        .table-responsive {
            flex: 1;
            overflow: hidden;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        /* Fixed thead */
        .table thead {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 1;
        }

        /* Scrollable tbody */
        .table tbody {
            display: block;
            overflow-y: auto;
            height: 600px;
            max-height: calc(100vh - 200px); /* Adjust based on header/pagination height */
        }

        /* Ensure table rows and cells behave correctly */
        .table tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .table thead, .table tbody tr {
            display: table;
            width: 100%;
        }

        /* Pagination styling */
        .pagination-container {
            padding: 1rem;
            background: #fff;
        }
    </style>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card table-container">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Brands</th>
                                <th>Company Name</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($brands as $key => $brand)
                                <tr>
                                    <td>{{ $brands->firstItem() + $key }}</td>
                                    <td><strong>{{ $brand->name }}</strong></td>
                                    <td><span class="badge bg-label-primary me-1">{{ $brand->company }}</span></td>
                                    <td>{{ $brand->user ? $brand->user->name : '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('brands.edit', $brand->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item delete-brand" href="javascript:void(0);" data-id="{{ $brand->id }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No brands found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    <div class="d-flex justify-content-center">
                        {{ $brands->links('pagination::custom') }}
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

            document.querySelectorAll('.delete-brand').forEach(button => {
                button.addEventListener('click', function () {
                    const brandId = this.getAttribute('data-id');
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
                            fetch('{{ url('brands/delete') }}/' + brandId, {
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
                                    data.message || 'Brand has been deleted.',
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
