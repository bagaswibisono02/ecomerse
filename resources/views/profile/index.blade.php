@extends('layouts.navUser')
@section('body')
    <div class="col-12">
        <form action="/profile" method="post" class="m-5">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Name</span>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ Auth::User()->name }}" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email</span>
                <input type="text" class="form-control" name="email" value="{{ Auth::User()->email }}" placeholder="Email" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Contact</span>
                <input type="text" class="form-control" name="contact" value="{{ Auth::User()->contact }}" placeholder="Contact" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <div class="d-flex justify-content-center m-4">
                <button class=" btn btn-primary" onclick="return confirm('Update ?')">Update</button>
            </div>

        </form>

        <div class="d-flex justify-content-center m-4">
            <a href="/logout" class="btn btn-danger">Log Out</a>
        </div>

    </div>
@endsection
