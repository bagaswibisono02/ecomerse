@extends('layouts.sidebar')
@section('content')
<form action="/import-afiliate" method="post" class="m-5 col-5" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Platform</span>
        <select class="form-control" name="platform_id" id="">
            <option >=Pilih Platform=</option>
            @foreach ($platforms as $item)
             <option value="{{ $item->id }}"> {{ $item->name }}</option>   
            @endforeach
        </select>
    
      </div>
      <div class="input-group mb-3">
        <input type="file" name="fileImport" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
      </div>
      <button type="submit">Submit</button>
      
      
</form>
@endsection
