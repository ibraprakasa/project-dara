@extends('template')
@section('judul_halaman', 'Akun')
@section('breadcrumb', 'Akun')
@section('content')

<div class="content" style="margin-top: 85px;">
  @if(session('error'))
  <div class="alert alert-failed">
    <div class="alert-icon">&#9888;</div>
    <div>
      {{ session('error') }}
    </div>
  </div>
  @elseif(session('success'))
  <div class="alert alert-success-akun">
    <div class="alert-icon">&#10004;</div> 
    <div>
      {{ session('success') }}
    </div>
  </div>
  @endif
  <div class="form-group">
    <label for="name">Nama</label>
    <input class="form-control input" type="text" id="name" placeholder="{{ Auth::user()->name }}" readonly>
  </div>
  <div class="form-group">
    <label for="password">Kata Sandi</label>
    <div class="password-input-wrapper">
      <input class="form-control input" type="password" id="password" placeholder="**********" readonly>
      <button type="button" class="btn btn-success edit-button" data-toggle="modal" data-target=".editkatasandi">
        <i style="font-size:20px" class="bi bi-pencil-square"></i>
      </button>
    </div>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea class="form-control input" name="alamat" id="alamat" rows="3" placeholder="{{ Auth::user()->alamat }}" readonly></textarea>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control input" name="email" type="email" id="email" placeholder="{{ Auth::user()->email }}" readonly>
  </div>
  <div class="form-group">
    <label for="notelp">Nomor Telepon</label>
    <input class="form-control input" name="nohp" type="number" id="notelp" placeholder="{{ Auth::user()->nohp }}" readonly>
  </div>
  <div class="form-group">
    <label for="role">Role</label>
    <input class="form-control input" name="role" type="text" id="role" placeholder="{{ Auth::user()->role->role_name }}" readonly>
  </div>
  <button type="button" class="btn btn-success modalbuttonsuccess-style" data-toggle="modal" data-target=".editakun" style="margin-top:20px;">Edit</button>

  <!-- MODAL -->
  <div class="modal fade editakun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Edit Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
          </button>
        </div>
        <form action="/updateakun" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group" style="color:black; font-weight:bold">
              <label for="name">Nama</label>
              <input class="kolom form-control" name="name" type="text" id="name" value="{{ Auth::user()->name }}">
            </div>
            <div class="form-group" style="color:black; font-weight:bold">
              <label for="alamat">Alamat</label>
              <textarea class="kolom form-control" name="alamat" id="alamat" rows="3">{{ Auth::user()->alamat }}
              </textarea>
            </div>
            <div class="form-group" style="color:black; font-weight:bold">
              <label for="email">Email</label>
              <input class="kolom form-control" name="email" type="email" id="email" value="{{ Auth::user()->email }}">
            </div>
            <div class="form-group" style="color:black; font-weight:bold;">
              <label for="notelp">Nomor Telepon</label>
              <input class="kolom form-control" name="nohp" type="number" id="notelp" value="{{ Auth::user()->nohp }}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
          </div>
        </form>
        <!-- END MODAL -->
      </div>
    </div>
  </div>

  <!-- MODAL PASSWORD-->

  <div class="modal fade editkatasandi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Ubah Kata Sandi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
          </button>
        </div>
        <form action="/updatepassword" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group" style="color:black; font-weight:bold">
              <label for="passwordlama">Kata Sandi Lama</label>
              <input class="kolom form-control" name="passwordlama" type="password" id="passwordlama" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Password Lama.')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group" style="color:black; font-weight:bold">
              <label for="passwordbaru">Kata Sandi Baru</label>
              <input class="kolom form-control" name="passwordbaru" type="password" id="passwordbaru" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Password Baru.')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group" style="color:black; font-weight:bold">
              <label for="passwordkonfirmasi">Konfirmasi Kata Sandi Baru</label>
              <input class="kolom form-control" name="passwordkonfirmasi" type="password" id="passwordkonfirmasi" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Konfirmasi Password Baru.')" oninput="this.setCustomValidity('')">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success modalbuttonsuccess-style">Ubah</button>
          </div>
        </form>
        <!-- END MODAL -->
      </div>
    </div>
  </div>
</div>


@endsection