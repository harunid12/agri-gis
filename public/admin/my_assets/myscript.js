$('.edit-dusun').click(function () {
  const idDusun = $(this).attr('data-id');
  const nama = $(this).attr('data-nama');

  $('.idDusun').val(idDusun);
  $('.nama_dusun').val(nama);

  $('#editDusunModal').modal('show');
});

$('.hapus-dusun').click( function(){
  var nama = $(this).attr('data-nama');
  var delete_url = $(this).attr('data-delete-url');
  Swal.fire({
    title: 'Yakin ?',
    text: "Ingin menghapus Dusun "+nama +" ? ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      setTimeout(function() {
        window.location = delete_url;
      }, 1000);
      Swal.fire(
        'Deleted!',
        'Dusun Berhasil Dihapus.',
        'success'
      )
    }
  })
});

$('.edit-komoditas').click(function () {
  const idKomoditas = $(this).attr('data-id');
  const nama = $(this).attr('data-nama');
  const warna = $(this).attr('data-warna');

  $('.idKomoditas').val(idKomoditas);
  $('.nama_tanaman').val(nama);
  $('.kode_warna').val(warna);

  $('#editKomoditasModal').modal('show');
});

$('.hapus-komoditas').click( function(){
  var nama = $(this).attr('data-nama');
  var delete_url = $(this).attr('data-delete-url');
  Swal.fire({
    title: 'Yakin ?',
    text: "Ingin menghapus Komoditas "+nama +" ? ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      setTimeout(function() {
        window.location = delete_url;
      }, 1000);
      Swal.fire(
        'Deleted!',
        'Komoditas Berhasil Dihapus.',
        'success'
      )
    }
  })
});

$('.edit-lahan').click(function () {
  const idLahan = $(this).attr('data-id');
  const dusun = $(this).attr('data-dusun');
  const komoditas = $(this).attr('data-komoditas');
  const koordinat = $(this).attr('data-koordinat');
  const alamat = $(this).attr('data-alamat');
  const luas = $(this).attr('data-luas');

  $('.idLahan').val(idLahan);
  $('.idDusun').val(dusun);
  $('.idKomoditas').val(komoditas);
  $('.koordinat').val(koordinat);
  $('.alamat').val(alamat);
  $('.luas').val(luas);

  $('#editLahanModal').modal('show');
});

$('.hapus-lahan').click( function(){
  var delete_url = $(this).attr('data-delete-url');
  Swal.fire({
    title: 'Yakin ?',
    text: "Ingin menghapus Lahan ini ? ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      setTimeout(function() {
        window.location = delete_url;
      }, 1000);
      Swal.fire(
        'Deleted!',
        'Lahan Berhasil Dihapus.',
        'success'
      )
    }
  })
});

$('.show-map').click(function () {
  const rawKoordinat = $(this).attr('data-koordinat'); // Ambil data-koordinat
  const mapElement = $('#map');

  // Hapus instance map sebelumnya jika ada
  if (mapElement.data('mapInstance')) {
    const oldMap = mapElement.data('mapInstance');
    oldMap.remove(); // Hapus peta dengan Leaflet
    mapElement.removeData('mapInstance'); // Hapus data instance
  }

  // Parsing koordinat dari format raw dan ubah urutan menjadi [lat, lng]
  const coords = rawKoordinat
    .split("\n") // Pisahkan koordinat per baris
    .map(coord => {
      const [lng, lat] = coord.split(" "); // Pisahkan longitude dan latitude
      return [parseFloat(lat), parseFloat(lng)]; // Ubah urutan menjadi [lat, lng]
    });

  // Inisialisasi peta
  const map = L.map('map').setView(coords[0], 15); // Fokus ke titik pertama
  mapElement.data('mapInstance', map); // Simpan instance untuk reset nanti

  // Tambahkan tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
  }).addTo(map);

  // Tambahkan poligon
  const polygon = L.polygon(coords, {
    color: 'blue',
    fillColor: '#3388ff',
    fillOpacity: 0.5,
  }).addTo(map);

  // Menambahkan garis pembatas koordinat
  const polyline = L.polyline(coords, {
    color: 'red',
    weight: 2, // Tebal garis
    opacity: 1
  }).addTo(map);

  // Sesuaikan tampilan dengan poligon
  map.fitBounds(polygon.getBounds());
  map.fitBounds(polyline.getBounds());

  // Panggil invalidateSize setelah modal tampil
  $('#mapModal').on('shown.bs.modal', function () {
    map.invalidateSize();
    map.fitBounds(polygon.getBounds());
  });

  // Tampilkan modal
  $('#mapModal').modal('show');
});





