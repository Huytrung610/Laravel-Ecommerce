{{-- @if(session('success'))
    <div class="alert alert-success alert-dismissable fade show text-center">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('success')}}
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger alert-dismissable fade show text-center">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('error')}}
    </div>
@endif --}}

@if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissable fade show text-center">
        {{-- <button class="close" data-dismiss="alert" aria-label="Close">×</button> --}}
        {{session('success')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
