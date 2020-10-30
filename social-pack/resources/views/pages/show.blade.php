@extends('layouts.app')


@section('content')
    <div class="container">
        <h3 class="alert-heading">
            {{$page_config['page_name']}}
        </h3>
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="/store_post" >
                @csrf
                <input type="hidden" value="{{$page_config['page_id']}}" name="page_id">
                <label>Post Message</label>
                <textarea class="form-control" name='content' placeholder="What's in your mind ??????"></textarea>
                <br/>
                <label>Link</label>
                <input type="text" class="form-control" name='link' placeholder="add link">
                <br/>
                <label>Photo</label>
                <input type="file" multiple class="form-control" name="photos[]">
                <br/>
                <label>Video</label>
                <input type="file" multiple class="form-control" name="videos[]">
                <br/>
                <label>Schedule Post</label>
                <hr/>
                <div class='col-sm-6'>
                    <label>Select Date</label>
                    <input type='date' class="form-control" name="date"/>
                </div>
                <div class='col-sm-6'>
                    <label>Select Time</label>
                    <input type='time' class="form-control" name="time" />
                </div>
                <br/><br/><br/><br/>
                <a href="">
                    <button class="btn btn-default float-right"> POST</button>
                </a>
                </form>
            </div>
        </div>
        <hr/>
        @foreach($content['data'] as $cont)
            <h4>Past Posts Of Page</h4>
            <div class="card">
                <?php date_default_timezone_set('Asia/Karachi'); ?>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">{{!empty($cont['message']) ? $cont['message'] : ''}}</p>
                    <span>Created Date : {{date('d M Y H:i:s Z',strtotime($cont['created_time']))}}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection

