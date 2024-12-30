<table class="table">
    @foreach (Auth::User()->penerima as $item)
    <tr onclick="select('{{ $item->id }}')" class="col-12" id="{{ encrypt($item->id) }}">
        <td>
            {{ $item->nama }}
            <br>
            <small>{{ $item->alamat . ', ' . $item->kelurahan->nama . ', ' . $item->kelurahan->kecamatan->nama . ', ' . $item->kelurahan->kecamatan->kab_kota->nama . ', ' . $item->kelurahan->kecamatan->kab_kota->provinsi->nama }}</small>
        </td>
        <td> <input type="radio" x="{{ encrypt($item->id) }}" id="{{ $item->id }}" for="{{ $item->id }}"
                name="penerima"
                value="{{ $item->alamat . ', ' . $item->kelurahan->nama . ', ' . $item->kelurahan->kecamatan->nama . ', ' . $item->kelurahan->kecamatan->kab_kota->nama . ', ' . $item->kelurahan->kecamatan->kab_kota->provinsi->nama }}">
        </td>
    </tr>
@endforeach

</table>

