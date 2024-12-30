@extends('layouts.main')

@section('title', 'Dusun')
    
@section('content')

<link rel="stylesheet" href="{{asset('admin/sweetalert2/dist/sweetalert2.min.css')}}">

<div class="row">
<div class="d-flex justify-content-between align-items-center bd-highlight">
    <button class="btn tambah-dusun ms-auto p-2 bd-highlight position mb-2" data-bs-toggle="modal"
    data-bs-target="#dusunModal">
        <i class="menu-icon tf-icons bx bx-plus"></i> Tambahkan Dusun
    </button>
</div> 
<div class="col-xl-12">
    <div class="card mb-4">
      <h5 class="card-header">Dusun</h5>
      <div class="table-responsive text-nowrap">
        <table id="myTable">
          <thead>
            <tr>
              <th width="20">No</th>
              <th>Nama Dusun</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($dusun as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_dusun }}</i></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item edit-dusun" data-id="{{ $item->id_dusun }}" data-nama="{{ $item->nama_dusun }}" href="#"
                      ><i class="bx bx-edit-alt me-1"></i> Edit Dusun</a
                    >
                    <a class="dropdown-item hapus-dusun" data-delete-url="{{ route('hapusDusun', ['idDusun' => $item->id_dusun]) }}" data-nama="{{ $item->nama_dusun }}" href="#"
                      ><i class="bx bx-trash me-1"></i> Hapus Dusun</a
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
<div class="modal fade" id="dusunModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('simpanDusun') }}" method="POST">
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Dusun</h5>
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
              <label for="dusun" class="form-label">Nama Dusun*</label>
              <input type="text" id="dusun" name="nama_dusun" class="form-control" placeholder="ex: pematang gajah" />
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

  <div class="modal fade" id="editDusunModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('updateDusun') }}" method="POST" >
          @csrf
          @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Edit Dusun</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idDusun" class="idDusun">
          <div class="row">
            <div class="col mb-3">
              <label for="nama_dusun" class="form-label">Nama Dusun*</label>
              <input type="text" id="nama_dusun" name="nama_dusun" class="form-control nama_dusun" />
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