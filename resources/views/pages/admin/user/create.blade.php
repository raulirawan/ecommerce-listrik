@extends('layouts.dashboard-admin')

@section('title','Halaman Tambah User')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Form Tambah Data User</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama User</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Nama User" required>
                       <div class="invalid-feedback">
                            Masukan Nama User
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email User" required>
                     <div class="invalid-feedback">
                          Email Sudah Terdaftar
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" placeholder="Password User" required>
                   <div class="invalid-feedback">
                        Masukan Password User
                    </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">No Handphone</label>
                  <input type="number" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" name="no_hp" placeholder="Nomor Handphone User" required>
                 <div class="invalid-feedback">
                      Masukan Nomor Hanphone User
                  </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Roles</label>
                <select name="roles" id="roles" class="form-control" required>
                    <option value="">Pilih Roles</option>
                    <option value="KONSUMEN">KONSUMEN</option>
                    <option value="SUPPLIER">SUPPLIER</option>
                    <option value="PRODUSEN">PRODUSEN</option>
                </select>
               <div class="invalid-feedback">
                    Masukan Nomor Hanphone User
                </div>
            </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>

              </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
