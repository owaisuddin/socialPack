@extends('layouts.app')
<style>
.img-responsive{
    margin:5%;
}
</style>
@section('content')
    <div class="container">
        <h3 style="color: rgb(96, 89, 27); font-weight: bold">{{$type}}:</h3>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-sm-4">
                    <img src="{{ url('/public/'.$image_folder. '/'.$image->getFilename()) }}" width="100%" class="img-responsive">
                </div>
            @endforeach
        </div>
    </div>
@endsection
