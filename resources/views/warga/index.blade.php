@extends('layouts.dashboard')

@section('title')
    <title>Data Warga</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">KelolaData</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Data Warga
                                <div class="float-right">
                                    {{-- <a href="{{ route('product.bulk') }}" class="btn btn-danger btn-sm">Mass Upload</a> --}}
                                    <!-- BUAT TOMBOL UNTUK MENGARAHKAN KE HALAMAN ADD PRODUK -->
                                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->

                            <!-- BUAT FORM UNTUK PENCARIAN, METHODNYA ADALAH GET -->
                            <form action="{{ route('warga.index') }}" method="get">
                                <div class="input-group mb-3 col-md-12 float-right">
                                    <select name="rt" class="form-control mr-3">
                                        <option value="">Pilih RT</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                    </select>
                                    <select name="rt" class="form-control mr-3">
                                        <option value="">Pilih Status</option>
                                        <option value="0">Aktif</option>
                                        <option value="1">Tidak Aktif</option>
                                    </select>
                                    <!-- KEMUDIAN NAME-NYA ADALAH Q YANG AKAN MENAMPUNG DATA PENCARIAN -->
                                    <input type="text" name="q" class="form-control" placeholder="Masukkan nama atau No. KK untuk mencari..." value="{{ request()->q }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                          
                            <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>RT</th>
                                            <th>Dasa Wisma</th>
                                            <th>Nama Legkap</th>
                                            <th>Alamat</th>
                                            <th>No. KK</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- LOOPING DATA TERSEBUT MENGGUNAKAN FORELSE -->
                                        <!-- ADAPUN PENJELASAN ADA PADA ARTIKEL SEBELUMNYA -->
                                        @forelse ($warga as $row)
                                        <tr>
                                            <td>
                                                {{ $row->rt }}
                                            </td>
                                            <td>
                                                {{ $row->dasa_wisma }}
                                            </td>
                                            <td>
                                                <strong>{{ $row->nama_lengkap }}</strong><br>
                                                <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                                {{-- <label>Kategori: <span class="badge badge-info">{{ $row->category->name }}</span></label><br>
                                                <label>Berat: <span class="badge badge-info">{{ $row->weight }} gr</span></label> --}}
                                            </td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->no_kk }}</td>
                                            
                                            <!-- KARENA BERISI HTML MAKA KITA GUNAKAN { !! UNTUK MENCETAK DATA -->
                                            <td>{!! $row->status !!}</td>
                                            <td>
                                                <!-- FORM UNTUK MENGHAPUS DATA WARGA -->
                                                <form action="{{ route('warga.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('warga.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {!! $warga->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
