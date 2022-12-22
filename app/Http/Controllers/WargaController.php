<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warga;

class WargaController extends Controller
{
    // public function dashboard(){
    //     return view('warga.dashboard')
    //                 ->with('rt', Warga::all()->count())
    //                 ->with('status', Warga::all('status', '0')->get()->count())
    //                 ->with('user_count', User::all()->count())
    //                 ->with('categories_count', Category::all()->count());
    // }
    public function index()
    {
        //BUAT QUERY MENGGUNAKAN MODEL PRODUCT, DENGAN MENGURUTKAN DATA BERDASARKAN CREATED_AT
        //KEMUDIAN LOAD TABLE YANG BERELASI MENGGUNAKAN EAGER LOADING WITH()
        //ADAPUN CATEGORY ADALAH NAMA FUNGSI YANG NNTINYA AKAN DITAMBAHKAN PADA PRODUCT MODEL
        $warga = Warga::orderBy('created_at', 'DESC');
      
        //JIKA TERDAPAT PARAMETER PENCARIAN DI URL ATAU Q PADA URL TIDAK SAMA DENGAN KOSONG
        if (request()->q != '') {
            //MAKA LAKUKAN FILTERING DATA BERDASARKAN NAME DAN VALUENYA SESUAI DENGAN PENCARIAN YANG DILAKUKAN USER
            $warga = $warga->where(function($q){
                $q->where('nama_lengkap', 'LIKE', '%' . request()->q . '%')
                ->orWhere('no_kk', 'LIKE', '%' . request()->q . '%');
            });
        }
        //JIKA RT TIDAK KOSONG 
        if (request()->rt != '') {
            //MAKA DATA DIFILTER BERDASARKAN STATUS
            $warga = $warga->where('rt', request()->rt);
        }
        //JIKA RT TIDAK KOSONG 
        if (request()->status != '') {
            //MAKA DATA DIFILTER BERDASARKAN STATUS
            $warga = $warga->where('status', request()->status);
        }
        //TERAKHIR LOAD 10 DATA PER HALAMANNYA
        $warga = $warga->paginate(10);
        return view('warga.index', compact('warga'));
    }
    public function create(){
        //QUERY UNTUK MENGAMBIL SEMUA DATA CATEGORY
        // $warga = Warga::orderBy('nama', 'DESC')->get();
        $warga = Warga::orderBy('created_at', 'DESC');
        //LOAD VIEW create.blade.php` YANG BERADA DIDALAM FOLDER PRODUCTS
        //DAN PASSING DATA CATEGORY
        return view('warga.create', compact('warga'));
    }
    public function store(Request $request){
        //VALIDASI REQUESTNYA
        $this->validate($request, [
            'rt' => 'required|integer',
            'dasa_wisma' => 'required|integer',
            'nama_lengkap' => 'required|string|max:100',
            'no_kk' => 'required',
            'status' => 'required',
        ]);

        //SETELAH FILE TERSEBUT DISIMPAN, KITA SIMPAN INFORMASI PRODUKNYA KEDALAM DATABASE
        $warga = Warga::create([
            'rt' => $request->rt,
            'dasa_wisma' => $request->dasa_wisma,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'no_kk' => $request->no_kk,
            'status' => $request->status,
        ]);
        //JIKA SUDAH MAKA REDIRECT KE LIST PRODUK
        return redirect(route('warga.index'))->with(['success' => 'Data Warga Baru Ditambahkan']);
    }
    public function destroy($id){
        $warga = Warga::find($id); //QUERY UNTUK MENGAMBIL DATA PRODUK BERDASARKAN ID
        //HAPUS FILE IMAGE DARI STORAGE PATH DIIKUTI DENGNA NAMA IMAGE YANG DIAMBIL DARI DATABASE
        // File::delete(storage_path('app/public/products/' . $product->image));
        //KEMUDIAN HAPUS DATA PRODUK DARI DATABASE
        $warga->delete();
        //DAN REDIRECT KE HALAMAN LIST PRODUK
        return redirect(route('warga.index'))->with(['success' => 'Data Warga Sudah Dihapus']);
    }
    public function edit($id){
        $warga = Warga::find($id); //AMBIL DATA PRODUK TERKAIT BERDASARKAN ID
        // $category = Category::orderBy('name', 'DESC')->get(); //AMBIL SEMUA DATA KATEGORI
        return view('warga.edit', compact('warga')); //LOAD VIEW DAN PASSING DATANYA KE VIEW
    }
    public function update(Request $request, $id){
    //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'rt' => 'required|integer',
            'dasa_wisma' => 'required|integer',
            'nama_lengkap' => 'required|string|max:100',
            'no_kk' => 'required',
            'status' => 'required',
        ]);

        $warga = Warga::find($id); //AMBIL DATA PRODUK YANG AKAN DIEDIT BERDASARKAN ID
        // $filename = $product->image; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI
    
        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
        //     //MAKA UPLOAD FILE TERSEBUT
        //     $file->storeAs('public/products', $filename);
        //     //DAN HAPUS FILE GAMBAR YANG LAMA
        //     File::delete(storage_path('app/public/products/' . $product->image));
        // }

        //KEMUDIAN UPDATE PRODUK TERSEBUT
        $warga->update([
            'rt' => $request->rt,
            'dasa_wisma' => $request->dasa_wisma,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'no_kk' => $request->no_kk,
            'status' => $request->status,
        ]);
        return redirect(route('warga.index'))->with(['success' => 'Data Warga Diperbaharui']);
    }
}