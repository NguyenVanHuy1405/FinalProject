@if (Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <strong>{{ session('success') }}</strong>
</div>
@endif
@if (Session::has('message'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ session('message') }}</strong>
</div>
@endif
