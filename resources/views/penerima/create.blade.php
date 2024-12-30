@extends('layouts.navUser')
@section('body')
    <div class="container d-flex justify-content-center">
        <div class="col-6 bg-white ms-2">
            <form action="/penerima" class="p-4" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nama Penerima</span>
                    <input type="text" name="penerima" class="form-control" placeholder="Nama Penerima" aria-label="Nama Penerima" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Contact Penerima</span>
                    <input name="contact" type="number" class="form-control" placeholder="Contact Penerima" aria-label="Contact Penerima" aria-describedby="basic-addon1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alamat</label>
                   <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
                  </div>
                  <input type="hidden" name="url" value="{{ url()->previous() }}">
                  <button class="btn btn-danger" type="submit">Tambah</button>
                             
            </form>
        </div>
    @endsection
