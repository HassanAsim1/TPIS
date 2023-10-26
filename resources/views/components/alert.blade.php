@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible mt-2" role="alert">
        {{session()->get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible mt-2" role="alert">
        {{session()->get('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif