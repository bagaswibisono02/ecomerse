// document.addEventListener("contextmenu", function(event) {
//   event.preventDefault();  // Mencegah menu konteks muncul
 
// });
function previewFiles() {
  const filePreview = document.getElementById('filePreview');
  const files = document.getElementById('fileInput').files;

  filePreview.innerHTML = ""; // Clear previous previews

  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const reader = new FileReader();

    reader.onload = function (e) {
      const container = document.createElement('div');
      container.classList.add('media-container');

      if (file.type.startsWith('image/')) {
        const img = document.createElement('img');
        img.src = e.target.result;
        container.appendChild(img);
      } else if (file.type.startsWith('video/')) {
        const video = document.createElement('video');
        video.src = e.target.result;
        video.controls = true;
        container.appendChild(video);
      }

      filePreview.appendChild(container);
    };

    reader.readAsDataURL(file);
  }
  document.getElementById('tombol').classList.remove('d-none');
}

function scrollLeftBtn() {
  const filePreviewContainer = document.getElementById('filePreviewContainer');
  filePreviewContainer.scrollBy({ left: -370, behavior: 'smooth' });
}

function scrollRightBtn() {
  const filePreviewContainer = document.getElementById('filePreviewContainer');
  filePreviewContainer.scrollBy({ left: 370, behavior: 'smooth' });
}

function total(harga) {
  document.getElementById('hargaDiskon').value = harga;
}

function minimal(hargaBeli) {
  let ongkir = document.getElementById('setting-ongkir').textContent;
  let admin = document.getElementById('setting-admin').textContent;
  let berat = document.getElementById('berat').value;
  let akhir = document.getElementById('hargaDiskon').value;

  let minimal = parseInt(hargaBeli) + (parseInt(ongkir) * parseInt(berat)) + parseInt(admin);


  document.getElementById('jual').value = minimal;
  document.getElementById('hargaDiskon').value = minimal;

  let untung = parseInt(akhir) - parseInt(minimal);
  document.getElementById('untung').textContent = parseInt(akhir)

}

function untung() {
  let hargaBeli = document.getElementById('hargaAsli').value;
  let ongkir = document.getElementById('setting-ongkir').textContent;
  let admin = document.getElementById('setting-admin').textContent;
  let berat = document.getElementById('berat').value;
  let akhir = document.getElementById('hargaDiskon').value;


  let minimal = parseInt(hargaBeli) + parseInt(ongkir) * parseInt(berat) + parseInt(admin);

  let untung = parseInt(akhir) - parseInt(minimal);
  document.getElementById('untung').textContent = untung
}

function tambahLink() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];

  // Buat baris baru
  var newRow = table.insertRow();

  // Buat sel untuk input URL
  var cell1 = newRow.insertCell(0);
  var linkInput = document.createElement("input");
  linkInput.type = "url";
  linkInput.name = "link[]";
  linkInput.placeholder = "Link Supplier"
  linkInput.classList = "form-control";
  cell1.appendChild(linkInput);

  // Buat sel untuk input Harga (number)
  var cell2 = newRow.insertCell(1);
  var hargaInput = document.createElement("input");
  hargaInput.type = "number";
  hargaInput.placeholder = "Harga"
  hargaInput.classList = "form-control";
  hargaInput.name = "hargaAsli[]";
  cell2.appendChild(hargaInput);
}

function map() {



  // Inisialisasi peta
  var map = L.map('map').setView([-6.1751, 106.8650], 13); // Pusatkan peta di Jakarta

  // Tambahkan tile dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Tambahkan marker untuk titik pengiriman
  var marker = L.marker([-6.1751, 106.8650]).addTo(map)
    .bindPopup("Lokasi Pengiriman")
    .openPopup();

  // Event untuk memilih titik lokasi
  map.on('click', function (e) {
    var latitude = e.latlng.lat;
    var longitude = e.latlng.lng;

    // Tambahkan atau perbarui marker pada titik yang dipilih
    if (marker) {
      marker.setLatLng([latitude, longitude]).update();
    } else {
      marker = L.marker([latitude, longitude]).addTo(map);
    }

    // Simpan latitude dan longitude di input hidden (jika ingin disimpan di database)
    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value = longitude;
  });
}

function tampilForm() {
  document.getElementById('list-penerima').style.display = "none";
  document.getElementById('btn-tambah-baru').style.display = "none";
  document.getElementById('tambah-penerima').style.display = "block";
  document.getElementById('kembali').style.display = "block";
  document.getElementById('konfirmasi').style.display = "none";


}

function list() {
  document.getElementById('list-penerima').style.display = "block";
  document.getElementById('btn-tambah-baru').style.display = "block";
  document.getElementById('tambah-penerima').style.display = "none";
  document.getElementById('kembali').style.display = "none";
  document.getElementById('konfirmasi').style.display = "block";

}



// ajax tempat

function kabupaten(str) {
  console.log(str)

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list-kab").insertAdjacentHTML('beforeend', this.responseText);
    }
  };
  xmlhttp.open("GET", "/kab?q=" + str, true);
  xmlhttp.send();
  document.getElementById('default-kab').textContent = "= Pilih Kabupaten =";

  //hapus kabupaten
  var options = document.querySelectorAll("#list-kab option.hasil-kab");
  if (options.length > 0) {
    options.forEach(function (option) {
      option.remove();
    });
  }

  // hapus kecamatan 
  var kec = document.querySelectorAll("#list-kec option.hasil-kec");
  if (kec.length > 0) {
    kec.forEach(function (kec) {
      kec.remove();
    });
  }
  document.getElementById('default-kec').textContent = "= Pilih Kabupaten Terlebih Dahulu ="

  // hapus kelurahan  
  var kel = document.querySelectorAll("#list-kel option.hasil-kel");
  if (kel.length > 0) {
    kel.forEach(function (kel) {
      kel.remove();
    });
  }
  document.getElementById('default-kel').textContent = "= Pilih Kecamatan Terlebih Dahulu ="


}


function kecamatan(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list-kec").insertAdjacentHTML('beforeend', this.responseText);
    }
  };
  xmlhttp.open("GET", "/kec?q=" + str, true);
  xmlhttp.send();

  document.getElementById('default-kec').textContent = "= Pilih Kecamatan =";

  var options = document.querySelectorAll("#list-kec option.hasil-kec");
  if (options.length > 0) {
    options.forEach(function (option) {
      option.remove();
    });
  }

  // hapus kelurahan  
  var kel = document.querySelectorAll("#list-kel option.hasil-kel");
  if (kel.length > 0) {
    kel.forEach(function (kel) {
      kel.remove();
    });
  }
  document.getElementById('default-kel').textContent = "= Pilih Kecamatan Terlebih Dahulu ="
}



function kelurahan(str) {
  console.log(str)
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list-kel").insertAdjacentHTML('beforeend', this.responseText);
      console.log(this.responseText)
    }
  };
  xmlhttp.open("GET", "/kel?q=" + str, true);
  xmlhttp.send();

  document.getElementById('default-kel').textContent = "= Pilih Kelurahan =";

  var options = document.querySelectorAll("#list-kel option.hasil-kel");
  if (options.length > 0) {
    options.forEach(function (option) {
      option.remove();
    });
  }
}

function konfirmasi() {
  const selectedRadio = document.querySelector('input[type="radio"]:checked');
  document.getElementById('alamatfix').textContent = selectedRadio.value;
  // document.getElementById('input_alamat').value = selectedRadio.value;
  document.getElementById('tutup').click()

  // Nilai yang ingin dicari
  const targetValue = selectedRadio.value;

  // Mencari semua elemen input
  const inputs = document.querySelectorAll('input[type="radio"]');

  // Loop melalui setiap input
  inputs.forEach(input => {
    if (input.value === targetValue) {
      // Jika value sesuai, ambil id
      document.getElementById('input_alamat_id').value = input.getAttribute('x')
    }
  });
}

// inuque id 
var inputCounter = 1;
function masukanVarian() {
  //get inputan
  let inisiasiVarian = document.getElementById('input-varian');
  //get unique id 
  let unique_id = inputCounter++;

  //masukan ke inputan 
  // Buat elemen <div> dengan kelas input-group
  let div = document.createElement("div");
  div.classList.add("input-group", "mb-3", "col-4");
  div.id = "uniqueInput_" + unique_id

  // Buat elemen <input> dengan kelas tertentu dan atribut lainnya
  let input = document.createElement("input");
  input.type = "text";
  input.name = "datavarian[]";
  input.classList.add("w-auto", "btn", "d-inline", "bordered", "border-3", "border-light");
  input.value = inisiasiVarian.value;

  // Buat elemen <button> untuk menghapus varian
  let button = document.createElement("button");
  button.type = "button";
  button.classList.add("btn");
  button.textContent = "X";
  button.id = unique_id; // Tetapkan id untuk button jika diperlukan
  button.onclick = function () { hapusVarian(unique_id); }; // Pasang event onclick

  // Tambahkan <input> dan <button> ke dalam <div>
  div.appendChild(input);
  div.appendChild(button);

  // Tambahkan elemen <div> ke dalam container di halaman
  document.getElementById("container-varian").appendChild(div);
  inisiasiVarian.value = ""

}

function hapusVarian(id) {
  let element = document.getElementById(id);
  if (element && element.parentNode) {
    element.parentNode.remove();
  }
}

function selectVarian(id) {
  //hapus ui varian 

    // Jika ada, ambil semua elemen dengan kelas "list-varian"
    let buttons = document.querySelectorAll(".active-varian");

    // Loop melalui setiap elemen dan hapus kelas "bg-success" jika ada
    buttons.forEach(button => {
      button.classList.remove("bg-success");
      button.classList.remove("text-white");
    });
  

  //get ui varian
  let element = document.getElementById(id);

  console.log(element)
  element.classList.add("bg-success","text-white", "active-varian");

  //masukan ke input 
  document.getElementById("input_varian").value = id;
  

}

function tampilUpdateResi($id){
  let view =  document.getElementById($id)
let form =  document.getElementById('form-'+$id)

//aksi
view.classList.add('d-none');
form.classList.remove('d-none')
}






