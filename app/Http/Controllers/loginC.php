<?php

namespace App\Http\Controllers;

use App\Models\pengunjungM;
use App\Models\adminM;
use Hash;
use Illuminate\Http\Request;

class loginC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pageslogin');
    }


    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try{
            $request->session()->flush();
            $username = $request->username;
            $password = $request->password;
            $posisi = $request->posisi;

            if($posisi === 'pengunjung') {
                $cek = pengunjungM::where('username', $username);
            }elseif($posisi === 'admin') {
                $cek = adminM::where('username', $username);
            }

            if ($cek->count() == 1) {
                if(Hash::check($password, $cek->first()->password)) {
                    $request->session()->put('posisi', $posisi);
                    $request->session()->put('login', true);
                    $request->session()->put('nama', $cek->first()->nama);
                    
                    if($posisi === 'pengunjung') {
                        $request->session()->put('idpengunjung', $cek->first()->idpengunjung);
                        return redirect('/welcome')->with('welcome');
                    }elseif($posisi === 'admin') {
                        $request->session()->put('idadmin', $cek->first()->idadmin);
                        return redirect('/home')->with('success', 'Welcome');
                    }

                }else {
                    return redirect()->back()->with('toast_error', 'username atau password salah')->withInput();
                }
            }else {
                return redirect()->back()->with('toast_error', 'username atau password salah')->withInput();
            }


        }catch(\Throwable $th){
            return redirect('/login')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }


    public function daftar(Request $request)
    {
        return view('pages.pagesregister');
    }

    public function prosesdaftar(Request $request)
    {
        $request->validate([
            'username' => 'email|required|unique:pengunjung,username',
            'nama' => 'required',
            'password1' => 'required',
            'password2' => 'required',
        ],[
            'email' => 'Masukan Email',
            'required' => 'Tidak boleh kosong',
            'unique' => 'Username telah terdaftar',
        ]);

        
        
        try{
            $username = $request->username;
            $nama = $request->nama;
            $password1 = $request->password1;
            $password2 = $request->password2;

            if($password1 === $password2) {
                $password = Hash::make($password1);

                $store = new pengunjungM;
                $store->username = $username;
                $store->nama = $nama;
                $store->password = $password;
                $store->save();
                if($store) {
                    return redirect('login')->with('toast_success', 'Akun berhasil dibuat');
                }
            }else {
                return redirect()->back()->with('toast_error', 'Terjadi kesalahan')->withInput();
            }
        
            
        }catch(\Throwable $th){
            return redirect('daftar')->with('toast_error', 'Terjadi kesalahan');
        }


    }


    public function reset()
    {
        return view('pages.pagesreset');
    }

    public function datareset(Request $request)
    {
        $request->validate([
            'username' => 'email|required',
            'nama' => 'required',
        ]);

        try{
            $username = $request->username;
            $nama = $request->nama;

            $pengunjung = pengunjungM::where('username', $username)->where('nama', $nama);

            if($pengunjung->count() == 1) {
                $idpengunjung = $pengunjung->first()->idpengunjung;

                return view('pages.pagesresetpassword', [
                    'idpengunjung' => $idpengunjung,
                ]);

            }else {
                return redirect()->back()->with('warning', 'Tidak ada data yang ditemukan')->withInput();
            }

        }catch(\Throwable $th){
            return redirect('/reset')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function resetpassword(Request $request, $idpengunjung)
    {
        $request->validate([
            'password' => 'required',
        ]);

        try{
            $password = Hash::make($request->password);
            $update = pengunjungM::where('idpengunjung', $idpengunjung)->update([
                'password' => $password,
            ]);

            if($update) {
                return redirect('login')->with('success', 'password berhasil direset');
            }
        
        }catch(\Throwable $th){
            return redirect('/login')->with('toast_error', 'Terjadi kesalahan');
        }
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengunjungM  $pengunjungM
     * @return \Illuminate\Http\Response
     */
    public function show(pengunjungM $pengunjungM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengunjungM  $pengunjungM
     * @return \Illuminate\Http\Response
     */
    public function edit(pengunjungM $pengunjungM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengunjungM  $pengunjungM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengunjungM $pengunjungM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengunjungM  $pengunjungM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengunjungM $pengunjungM)
    {
        //
    }
}
