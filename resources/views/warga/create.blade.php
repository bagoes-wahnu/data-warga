@extends('layouts.dashboard')

@section('title')
    <title>Tambah Data Warga</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">TambahData</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
          
          	<!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('warga.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Data Warga</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                                    <p class="text-danger">{{ $errors->first('nama_lengkap') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" required>
                                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="rt">RT</label>
                                    <select name="rt" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="1" {{ old('rt') == '1' ? 'selected':'' }}>1</option>
                                        <option value="2" {{ old('rt') == '2' ? 'selected':'' }}>2</option>
                                        <option value="3" {{ old('rt') == '3' ? 'selected':'' }}>3</option>
                                        <option value="4" {{ old('rt') == '4' ? 'selected':'' }}>4</option>
                                        <option value="5" {{ old('rt') == '5' ? 'selected':'' }}>5</option>
                                        <option value="6" {{ old('rt') == '6' ? 'selected':'' }}>6</option>
                                        <option value="7" {{ old('rt') == '7' ? 'selected':'' }}>7</option>
                                        <option value="8" {{ old('rt') == '8' ? 'selected':'' }}>8</option>
                                        <option value="9" {{ old('rt') == '9' ? 'selected':'' }}>9</option>
                                        <option value="10" {{ old('rt') == '10' ? 'selected':'' }}>10</option>
                                        <option value="11" {{ old('rt') == '11' ? 'selected':'' }}>11</option>
                                        <option value="12" {{ old('rt') == '12' ? 'selected':'' }}>12</option>
                                        <option value="13" {{ old('rt') == '13' ? 'selected':'' }}>13</option>
                                        <option value="14" {{ old('rt') == '14' ? 'selected':'' }}>14</option>
                                        <option value="15" {{ old('rt') == '15' ? 'selected':'' }}>15</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('rt') }}</p>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    
                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div> --}}
                                <div class="form-group">
                                    <label for="dasa_wisma">Dasa Wisma</label>
                                    <input type="number" name="dasa_wisma" class="form-control" value="{{ old('dasa_wisma') }}" required>
                                    <p class="text-danger">{{ $errors->first('dasa_wisma') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="no_kk">No. KK</label>
                                    <input type="number" name="no_kk" class="form-control" value="{{ old('no_kk') }}" required>
                                    <p class="text-danger">{{ $errors->first('no_kk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ old('status') == '1' ? 'selected':'' }}>Aktif</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected':'' }}>Tidak Aktif</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="image">Foto Produk</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}" required>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div> --}}
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
