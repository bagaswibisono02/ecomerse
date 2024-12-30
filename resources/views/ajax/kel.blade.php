@foreach ($kels as $kel)
    <option class="hasil-kel" value="{{ encrypt($kel->id) }}">{{ $kel->nama }}</option>
@endforeach