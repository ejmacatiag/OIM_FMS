@extends('layouts.app')

@section('content')
<div class="container">

    @php
        $currentOffice = request()->query('unit');
    @endphp

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload();
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if($currentOffice)
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span><strong>Showing files for:</strong> {{ strtoupper($currentOffice) }} Unit</span>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">Clear Filter</a>
        </div>
    @endif

    <div class="upload-container mb-3">
        <button type="button" class="upload-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Upload File
        </button>
    </div>

    <table id="filesTable" class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>Date Received</th>
                <th>Title/Communication</th>
                <th>Office</th>
                <th>Remarks</th>
                <th>Box</th>
                <th>View File</th>
                <th>Uploader</th>
                <th>Actions</th>
            </tr>
            <tr class="text-center">
                <th><input type="text" class="form-control column-search" placeholder="Search Date"></th>
                <th><input type="text" class="form-control column-search" placeholder="Search Title"></th>
                <th><input type="text" class="form-control column-search" placeholder="Search Office"></th>
                <th><input type="text" class="form-control column-search" placeholder="Search Remarks"></th>
                <th><input type="text" class="form-control column-search" placeholder="Search Box"></th>
                <th><input type="text" class="form-control column-search" placeholder="Search File Name"></th>
                <th><input type="text" class="form-control column-search" placeholder="Search Uploader"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                @if(!$currentOffice || strtoupper($file->office) === strtoupper($currentOffice))
                    <tr class="text-center">
                        <td>{{ $file->date_received ? $file->date_received->format('d-m-Y') : 'N/A' }}</td>
                        <td>{{ strtoupper($file->title_communication) }}</td>
                        <td>{{ strtoupper($file->office) }}</td>
                        <td>{{ strtoupper($file->remarks) }}</td>
                        <td>BOX A</td>
                        <td>
                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-primary">
                                {{ strtoupper($file->name) }}
                            </a>
                        </td>
                        <td>{{ strtoupper($file->user->name) }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-primary btn-sm edit-btn"
                                    data-id="{{ $file->id }}"
                                    data-title="{{ $file->title_communication }}"
                                    data-office="{{ $file->office }}"
                                    data-remarks="{{ $file->remarks }}"
                                    data-date_received="{{ $file->date_received ? $file->date_received->format('Y-m-d') : '' }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('files.download', $file->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <form action="{{ route('files.delete', $file->id) }}" method="POST" id="deleteForm{{ $file->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $file->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    {{-- Upload Modal --}}
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('files.upload') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date_received" class="form-label">Date Received</label>
                        <input type="date" name="date_received" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="title_communication" class="form-label">Title/Communication</label>
                        <input type="text" name="title_communication" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="office" class="form-label">Office</label>
                        <input list="officeOptions" name="office" class="form-control" required>
                        <datalist id="officeOptions">
                            <option value="Admin Unit">
                            <option value="Cashiering Unit">
                            <option value="Finance Unit">
                            <option value="Property Unit">
                            <option value="Planning Unit">
                            <option value="Design Unit">
                            <option value="Construction Unit">
                            <option value="Institutional Development Unit">
                            <option value="Equipment Unit">
                            <option value="Survey Team">
                            <option value="SRIP">
                            <option value="ASRIS">
                            <option value="SFDRIS">
                            <option value="LARIS">
                            <option value="ADRIS">
                            <option value="Regional Office">
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <input type="text" name="remarks" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Select File (PDF only)</label>
                        <input type="file" name="file" class="form-control" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" name="file_id" id="editFileId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Date Received</label>
                        <input type="date" name="date_received" id="edit_date_received" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title/Communication</label>
                        <input type="text" name="title_communication" id="edit_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Office</label>
                        <input type="text" name="office" id="edit_office" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <input type="text" name="remarks" id="edit_remarks" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            var table = $('#filesTable').DataTable({
                //  "dom": "lrtip" // Removes search box
                orderCellsTop: true,
                fixedHeader: true,
                ordering: false,
                pageLength: 5,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });

            $('#filesTable thead .column-search').on('keyup change', function () {
                let columnIndex = $(this).parent().index();
                table.column(columnIndex).search(this.value).draw();
            });

            $('.edit-btn').click(function () {
                $('#editFileId').val($(this).data('id'));
                $('#edit_title').val($(this).data('title'));
                $('#edit_office').val($(this).data('office'));
                $('#edit_remarks').val($(this).data('remarks'));
                $('#edit_date_received').val($(this).data('date_received'));
                $('#editModal').modal('show');
            });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#editForm').submit(function (e) {
                e.preventDefault();
                var fileId = $('#editFileId').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: `/files/update/${fileId}`,
                    type: 'PUT',
                    data: formData,
                    success: function () {
                        Swal.fire('Updated!', 'File details updated successfully.', 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to update file details.', 'error');
                    }
                });
            });
        });

        function confirmDelete(fileId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + fileId).submit();
                }
            });
        }
    </script>
@endsection
