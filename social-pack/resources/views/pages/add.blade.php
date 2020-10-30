@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="alert-heading">Add Page:</h3>
        <hr/>
        <div class="row">
            <div class="col-sm-12">
                <form class="form-group" method="post" action="page_save">
                    @csrf
                    <label>Page Name</label>
                    <input class="form-control" type="text" name="page_name" placeholder="page name" required>
                    <br/>
                    <label>Page Id</label>
                    <input class="form-control" type="number" name="page_id" placeholder="page id" required>
                    <br/>
                    <label>Access Token</label>
                    <input class="form-control" type="text" name="access_token" placeholder="page access token" required>
                    <br/>
                    <button class="btn btn-default float-right">Save Page</button>
                </form>
            </div>
        </div>
    </div>
@endsection
