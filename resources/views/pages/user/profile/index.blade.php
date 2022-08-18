@extends('layouts.dashboard-user')

@section('title','Halaman Profile')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">  
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @if(session()->has('sukses'))
                <div class="alert alert-success">
                    {{ session()->get('sukses') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Data Profile</h3>
              </div>
              <!-- /.card-header -->
              <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Lenkap</label>
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" name="name" placeholder="Nama Mahasiswa">
                                 <div class="invalid-feedback">
                                      Masukan Nama
                                  </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Handphone</label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $user->no_hp }}" name="no_hp" placeholder="Nomor Handphone">
                               <div class="invalid-feedback">
                                    Masukan Nomor Hanphone
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" placeholder="Alamat Lengkap">{{ $user->alamat_lengkap }}</textarea>
                               <div class="invalid-feedback">
                                    Masukan Alamat Lengkap
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
        
            </div>
          
          </div>

          <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Form Ubah Password</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('change.password') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Passowrd Lama</label>
                                      <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" autocomplete="off" placeholder="Password Lama"> 
                                 <div class="invalid-feedback">
                                      Masukan Password Lama
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Passowrd Baru</label>
                                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password Baru">
                                 <div class="invalid-feedback">
                                      Password Baru
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Passowrd Baru Lagi</label>
                                  <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Baru Lagi">
                                 <div class="invalid-feedback">
                                      Password Baru Lagi
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
          
              </div>
            
          </div>

          
        
        </div>
       
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

