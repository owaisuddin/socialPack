@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="alert-heading">Pages</h3>
        <table class="table table-bordered table-default table-responsive">
            <thead>
            <tr>
                <th scope="col" >#</th>
                <th scope="col" >Page Name</th>
                <th scope="col" >Page Id</th>
                <th scope="col" rowspan="2">Page Access Token</th>
                <th ></th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $key=>$page)
            <tr>
                <th scope="row">{{(int) $key + 1}}</th>
                <td>{{$page->page_name}}</td>
                <td>{{$page->page_id}}</td>
                <td >{{substr($page->access_token,0,80)}}</td>
                <td>
                    <a href="page_post/{{$page->page_id}}">
                    <button class="btn btn-default">Page View</button>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
