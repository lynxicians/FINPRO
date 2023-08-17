@php
$extension = pathinfo(auth()->user()->picture, PATHINFO_EXTENSION);
$mimeTypes = [
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    // Add more MIME types and extensions as needed
];
$mime = $mimeTypes[$extension] ?? 'image/png'; // Default to PNG if extension is not recognized
@endphp
<div class="sidebarGlobal-admin">
    <div class="sideLeft">
        <img src="data:{{ $mime }};base64,{{ auth()->user()->picture }}" class="photoProfile" data-bs-toggle="modal" data-bs-target="#exampleModal">  
        <div class="sidebar">
            <ul class="menu-nav">
                <li class="">
                    <a href="{{ route('homepage') }}">Dashboard</a>
                </li>
                <li class="">
                    <a href="{{ route('notification') }}">Notification</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route("UserUpdate") }}" enctype="multipart/form-data">
          @csrf <!-- Add CSRF token for security -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">Name</label>
              <input type="text" id="disabledTextInput" class="form-control" name="nickname" value="{{ auth()->user()->name }}">
            </div>
            <div class="mb-3">
              <label for="disabledSelect" class="form-label">Profile Picture</label> <br>
              <input type="file" id="front_image" name="images" accept="image/*">
            </div>
            <div class="mb-3">
              <img src="data:{{ $mime }};base64,{{ auth()->user()->picture }}" class="img-fluid" alt="Suggestion Image">          
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>