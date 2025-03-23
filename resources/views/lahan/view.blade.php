@extends('layouts.main')

@section('title', 'Lahan')
    
@section('content')

<link rel="stylesheet" href="{{asset('admin/sweetalert2/dist/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/leaflet/leaflet.css')}}">

<div class="row">
<div class="d-flex justify-content-between align-items-center bd-highlight">
    <button class="btn tambah-komoditi ms-auto p-2 bd-highlight position mb-2" data-bs-toggle="modal"
    data-bs-target="#lahanModal">
        <i class="menu-icon tf-icons bx bx-plus"></i> Tambahkan Lahan
    </button>
</div> 
<div class="col-xl-12">
    <div class="card mb-4">
      <h5 class="card-header">Lahan</h5>
      <div class="table-responsive text-nowrap">
        <table id="myTable">
          <thead>
            <tr>
              <th width="20">No</th>
              <th>Dusun</th>
              <th>Komoditas</th>
              <th>alamat</th>
              <th>luas lahan</th>
              <th>Peta Lahan</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($lahan as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_dusun }}</td>
              <td>{{ $item->nama_tanaman }}</td>
              <td>{{ $item->alamat_lahan }}</td>
              <td>{{ $item->luas_lahan }}</td>
              <td class="text-center"><a href="#" class="show-map" data-koordinat="{{ $item->koordinat_poligon }}"><i class="bx bx-map me-1"></i> </a></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item edit-lahan" data-id="{{ $item->id_lahan }}" data-koordinat="{{ $item->koordinat_poligon }}" data-dusun="{{ $item->id_dusun }}" data-komoditas="{{ $item->id_komoditas }}" data-alamat="{{ $item->alamat_lahan }}" data-luas="{{ $item->luas_lahan }}" href="#"
                      ><i class="bx bx-edit-alt me-1"></i> Edit Lahan</a
                    >
                    <a class="dropdown-item hapus-lahan" data-delete-url="{{ route('hapusLahan', ['idLahan' => $item->id_lahan]) }}" href="#"
                      ><i class="bx bx-trash me-1"></i> Hapus Lahan</a
                    >
                  </div>
                </div>
              </td>
            </tr>
                
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Small table -->
  </div>

</div>

{{-- modal --}}
<div class="modal fade" id="lahanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('simpanLahan') }}" method="POST">
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Lahan</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label" for="koordinat_poligon">Koordinat Poligon*</label>
              <textarea id="koordinat_poligon" class="form-control" rows="5" name="koordinat_poligon" placeholder="contoh input: 
              -6.9147,107.6098 
              -6.9145,107.6103 
              -6.9150,107.6106 
              -6.9147,107.6098"
              ></textarea>
          </div>
          </div>
          <div class="row">
            <div class="col mb-3 mt-2>
              <label for="defaultSelect" class="form-label">Dusun</label>
              <select name="id_dusun" id="defaultSelect" class="form-select">
                <option value="">=== Pilih ===</option>
                  @foreach ($dusun as $item)
                      <option value="{{ $item->id_dusun }}">{{ $item->nama_dusun }}</option>
                  @endforeach
              </select>
          </div>
          </div>
          <div class="row">
            <div class="col mb-3 mt-2>
              <label for="defaultSelect" class="form-label">Komoditas</label>
              <select name="id_komoditas" id="defaultSelect" class="form-select">
                <option value="">=== Pilih ===</option>
                  @foreach ($komoditas as $item)
                      <option value="{{ $item->id_komoditas }}">{{ $item->nama_tanaman}}</option>
                  @endforeach
              </select>
          </div>
          </div>
          <div class="row">
            <div class="col mb-3 mt-2">
              <label for="alamat_lahan" class="form-label">Alamat Lahan*</label>
              <input type="text" id="alamat_lahan" name="alamat_lahan" class="form-control" placeholder="alamat lengkap" />
            </div>
          </div>
          <div class="row">
            <div class="col mb-3 mt-2">
              <label for="luas_lahan" class="form-label">Luas Lahan*</label>
              <input type="text" id="luas_lahan" name="luas_lahan" class="form-control" placeholder="ex: 2000 Ha/m2" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editLahanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('updateLahan') }}" method="POST" >
          @csrf
          @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Edit Komoditas</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idLahan" class="idLahan">
          <div class="row">
            <div class="col mb-3">
              <label for="koordinat_poligon" class="form-label">Koordinat Poligon*</label>
              <textarea id="koordinat_poligon" class="form-control koordinat" rows="5" name="koordinat_poligon"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="dusun" class="form-label">Dusun</label>
              <select name="id_dusun" id="dusun" class="form-select idDusun">
                @foreach ($dusun as $item)
                  <option value="{{ $item->id_dusun }}">{{ $item->nama_dusun }}</option>
                @endforeach
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="komoditas" class="form-label">Komoditas</label>
              <select name="id_komoditas" id="komoditas" class="form-select idKomoditas">
                @foreach ($komoditas as $item)
                  <option value="{{ $item->id_komoditas }}">{{ $item->nama_tanaman }}</option>
                @endforeach
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="alamat_lahan" class="form-label">Alamat Lahan*</label>
              <input type="text" id="alamat_lahan" name="alamat_lahan" class="form-control alamat" />
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="luas_lahan" class="form-label">Luas Lahan*</label>
              <input type="text" id="luas_lahan" name="luas_lahan" class="form-control luas" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  {{-- poligon map --}}
  <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mapModalLabel">Peta Lahan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="map" style="height: 500px;"></div>
        </div>
      </div>
    </div>
  </div>
  

  
  <script src="{{ asset('admin/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('admin/my_assets/myscript.js') }}"></script>
  <script src="{{ asset('admin/leaflet/leaflet.js') }}"></script>
  {{-- <script>
    const map = L.map('map').setView([-6.9147, 107.6098], 13); // Sesuaikan dengan lokasi default
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

  </script> --}}
@endsection