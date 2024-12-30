@foreach ($kabs as $kab)
    <option class="hasil-kab" value="{{ encrypt($kab->id) }}"> {{ $kab->nama }} </option>
@endforeach