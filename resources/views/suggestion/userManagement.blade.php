@extends('layout.layout')

@section('content')
<div class="suggestionManagement-cover">
   @include('partial.sidebar')
    <div class="userManagementWrapper w-100 h-100">
        <div class="border-bottom border-dark">
            <h1>Welcome, Username</h1>
        </div>
        <div class="card-body rounded shadow mt-4">
            <table class="table pt-3" id="suggestionTable">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th> <!-- Update to "Description" column -->
                        <th scope="col">Action</th> <!-- Keep the "Action" column -->
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> 
            <div class="row pt-4">
                <div class="col-11"></div>
                <a class="btn button-post col-auto" href="{{ route('suggestion-post') }}" role="button">Post</a>
            </div>             
        </div>
    </div>
</div>
@if (Session::has('success'))
<!-- Output the success message as a data attribute -->
<div data-success="{{ Session::get('success') }}"></div>
@endif
@endsection

@push('scripts')
<script>
    $(function() {
        $('#suggestionTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('suggestion.data') }}',
            columns: [
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            pageLength: 10
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the success message is present in the DOM
        const successMessage = document.querySelector('[data-success]');
        if (successMessage) {
            // Retrieve the success message from the data attribute
            const message = successMessage.dataset.success;

            // Show the SweetAlert2 success popup
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                showConfirmButton: false,
                timer: 3000 // Popup will close after 3 seconds
            });
        }
    });
</script>
@endpush
