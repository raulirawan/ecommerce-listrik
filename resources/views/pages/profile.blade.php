@extends('layouts.app')

@section('title', 'Toko Melati')
@section('content')

    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-md 12">
                    @if (session()->has('sukses'))
                        <div class="alert alert-success">
                            {{ session()->get('sukses') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">Profil</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Profil</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_fname" class="text-black">Nama <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                            name="name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="c_fname" class="text-black">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="c_lname" class="text-black">Nomor Handphone <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->no_hp }}"
                                            name="no_hp" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h5>Ganti Password</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('password.update.user') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_fname" class="text-black">Password Lama<span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="oldPassword" class="form-control" autocomplete="off"
                                            placeholder="Password Lama" required>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="c_lname" class="text-black">Password Baru <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password Baru" required>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="c_lname" class="text-black">Konfirmasi Password Baru <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control "
                                            placeholder="Konfirmasi Password Baru" required>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

@endsection
