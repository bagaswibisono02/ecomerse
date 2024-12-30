@extends('layouts.sidebar')
@section('content')
<div class="container col-6 m-3">
    <form action="/platform-afiliate/{{ encrypt($platform->id) }}/update" class="card" method="post">
        @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Platform</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Platform</label>
                <input type="text" value="{{ $platform->name }}" required name="namaPlatform" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                @error('namaPlatform')
                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Link Platform</label>
                <input type="url" value="{{ $platform->link }}" required name="linkPlatform" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                @error('linkPlatform')
                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                @enderror

            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Logo Platform</label>
                <input type="url" value="{{ $platform->logo }}" required name="logoPlatform" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                @error('logoPlatform')
                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                @enderror

            </div>

        </div>

    

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
