@extends('layout.layout')

@section('content')
<div class="suggestionManagement-cover">
    <div class="sidebarGlobal">
        <div class="sideLeft">
            <div class="photoProfile"></div>
            <div class="sidebar">
                <ul class="menu-nav">
                    <li class="">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="">
                        <a href="#">Profile</a>
                    </li>
                    <li class="">
                        <a href="#">Notification</a>
                    </li>
                    <li class="">
                        <a href="#">Suggestion</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="userManagementWrapper w-100 h-100">
        <table class="table" id="suggestionTable">
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
    </div>
</div>
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

@endpush
