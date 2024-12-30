@foreach ($kecamatan as $kec)
    <option class="hasil-kec" value="{{ encrypt($kec->id) }}">{{ $kec->nama }}</option>
@endforeach