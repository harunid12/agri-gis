@extends('layouts.main')

@section('title', 'Komoditi')
    
@section('content')

<link rel="stylesheet" href="{{asset('admin/sweetalert2/dist/sweetalert2.min.css')}}">

<div class="row">
<div class="d-flex justify-content-between align-items-center bd-highlight">
    <button class="btn tambah-komoditi ms-auto p-2 bd-highlight position mb-2" data-bs-toggle="modal"
    data-bs-target="#komoditiModal">
        <i class="menu-icon tf-icons bx bx-plus"></i> Tambahkan Komoditas
    </button>
</div> 
<div class="col-xl-12">
    <div class="card mb-4">
      <h5 class="card-header">Komoditas</h5>
      <div class="table-responsive text-nowrap">
        <table id="myTable">
          <thead>
            <tr>
              <th width="20">No</th>
              <th>Nama Tanaman</th>
              <th>Kode Warna</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($komoditas as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_tanaman }}</i></td>
              <td>{{ $item->kode_warna }}</i></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item edit-komoditas" data-id="{{ $item->id_komoditas }}" data-nama="{{ $item->nama_tanaman }}" data-warna="{{ $item->kode_warna }}" href="#"
                      ><i class="bx bx-edit-alt me-1"></i> Edit Komoditas</a
                    >
                    <a class="dropdown-item hapus-komoditas" data-delete-url="{{ route('hapusKomoditas', ['idKomoditas' => $item->id_komoditas]) }}" data-nama="{{ $item->nama_tanaman }}" href="#"
                      ><i class="bx bx-trash me-1"></i> Hapus Komoditas</a
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
<div class="modal fade" id="komoditiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('simpanKomoditas') }}" method="POST">
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Komoditas</h5>
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
              <label for="tanaman" class="form-label">Nama Tanaman*</label>
              <input type="text" id="tanaman" name="nama_tanaman" class="form-control" placeholder="ex: sawit" />
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="warna" class="form-label">Kode Warna*</label>
              <input type="text" id="warna" name="kode_warna" class="form-control" placeholder="ex: ....." />
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

  <div class="modal fade" id="editKomoditasModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('updateKomoditas') }}" method="POST" >
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
          <input type="hidden" name="idKomoditas" class="idKomoditas">
          <div class="row">
            <div class="col mb-3">
              <label for="nama_tanaman" class="form-label">Nama Komoditas*</label>
              <input type="text" id="nama_tanaman" name="nama_tanaman" class="form-control nama_tanaman" />
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="kode_warna" class="form-label">Kode Warna*</label>
              <input type="text" id="kode_warna" name="kode_warna" class="form-control kode_warna" />
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

  
  <script src="{{ asset('admin/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('admin/my_assets/myscript.js') }}"></script>
@endsection