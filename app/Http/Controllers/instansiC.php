<?php

namespace App\Http\Controllers;

use App\Models\instansiM;
use App\Models\perumahanM;
use App\Models\kriteriaM;
use App\Models\nilaiM;
use Illuminate\Http\Request;

class instansiC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?"":$request->keyword;
        $toko = instansiM::where('namatoko', 'like', "%$keyword%")->paginate(15);

        $toko->appends($request->only(['limit', 'keyword']));

        return view('pages.pagesinstansi', [
            'toko' => $toko,
        ]);
    }

    public function laptop(Request $request, $idtoko)
    {

        $kriteria = kriteriaM::orderBy('ket', 'DESC')->get();

        // dd($kriteria);
        $typerumah = nilaiM::select('idnilai','ket')
                     ->where('idkriteria', 2)->get();
        $luastanah = nilaiM::select('idnilai','ket')
        ->where('idkriteria', 3)->get();

        $spesifikasirumah = nilaiM::select('idnilai','ket')
        ->where('idkriteria', 4)->get();

        $kepadatanpenduduk = nilaiM::select('idnilai','ket')
        ->where('idkriteria', 6)->get();


        $laptop = perumahanM::join('toko', 'toko.idtoko', '=', 'laptop.idtoko')
        ->where('laptop.idtoko', $idtoko)->get();


        $toko = instansiM::where('idtoko', $idtoko)->first();

        return view('pages.pagesperumahan', [
            'laptop' => $laptop,
            'kriteria' => $kriteria,
            'toko' => $toko,
            'idtoko' => $idtoko,
            'typerumah' => $typerumah,
            'luastanah' => $luastanah,
            'spesifikasirumah' => $spesifikasirumah,
            'kepadatanpenduduk' => $kepadatanpenduduk,
        ]);
    }

    public function tambahlaptop(Request $request, $idtoko)
    {
        // dd($request->toArray());
        $kriteria = kriteriaM::get();
        $validateku = [];
        $request->validate([
            "namalaptop" => 'required',
        ]);

        foreach ($kriteria as $k) {
            $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));

            $request->validate([
                "$namakriteria" => 'required',
            ]);
        }
        try{
            $namalaptop = $request->namalaptop;
            $store = new perumahanM;
            $store->idtoko = $idtoko;
            $store->namalaptop = $namalaptop;
            foreach ($kriteria as $k) {
                $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));
                $store->$namakriteria = $request->$namakriteria;
            }
            $store->save();

            if($store) {
                return redirect()->back()->with('toast_success', 'success');
            }

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahlaptop(Request $request, $idlaptop)
    {

        $kriteria = kriteriaM::get();
        $validateku = [];
        $request->validate([
            "namalaptop" => 'required',
        ]);
        foreach ($kriteria as $k) {
            $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));

            $request->validate([
                "$namakriteria" => 'required',
            ]);
        }



        try{
            $namalaptop = $request->namalaptop;

            $update = perumahanM::where('idlaptop', $idlaptop)->update([
                "namalaptop" => $namalaptop,
            ]);

            foreach ($kriteria as $k) {
                $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));

                $update = perumahanM::where('idlaptop', $idlaptop)->update([
                    "$namakriteria" => $request->$namakriteria,
                ]);
            }

            return redirect()->back()->with('toast_success', 'success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapuslaptop(Request $request, $idlaptop)
    {
        try{
            $destroy = perumahanM::where('idlaptop', $idlaptop)->delete();
            if($destroy) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
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
        $request->validate([
            'namatoko' => 'required',
            'links' => 'required',
            'alamat' => 'required',
            'hp' => 'required|numeric',
        ]);

        // try{
            if ($request->hasFile('gambar')) {
                $originName = $request->file('gambar')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    $fileName = $fileName.'_'.time().'.'.$extension;
                    $upload = $request->file('gambar')->move(\base_path() ."/public/gambar/gambar", $fileName);
                }else {
                    $fileName= 'none.jpg';
                }

            }else {
                $fileName= 'none.jpg';
            }

            $alamat = $request->alamat;
            $hp = $request->hp;
            $namatoko = $request->namatoko;
            $links = $request->links;

            $store = new instansiM;
            $store->namatoko = $namatoko;
            $store->alamat = $alamat;
            $store->links = $links;
            $store->hp = $hp;
            $store->gambar = $fileName;
            $store->save();

            if($store) {
                return redirect('toko')->with('toast_success', 'success');
            }
        // }catch(\Throwable $th){
        //     return redirect('toko')->with('toast_error', 'Terjadi kesalahan');
        // }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\instansiM  $instansiM
     * @return \Illuminate\Http\Response
     */
    public function show(instansiM $instansiM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\instansiM  $instansiM
     * @return \Illuminate\Http\Response
     */
    public function edit(instansiM $instansiM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\instansiM  $instansiM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, instansiM $instansiM, $idtoko)
    {
        $request->validate([
            'namatoko' => 'required',
            'alamat' => 'required',
            'links' => 'required',
            'hp' => 'required|numeric',
        ]);


        try{
            $namatoko = $request->namatoko;
            $alamat = $request->alamat;
            $links = $request->links;
            $hp = $request->hp;

            if ($request->hasFile('gambar')) {
                $originName = $request->file('gambar')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    $fileName = $fileName.'_'.time().'.'.$extension;
                    $upload = $request->file('gambar')->move(\base_path() ."/public/gambar/toko", $fileName);
                    $update = instansiM::where('idtoko', $idtoko)->update([
                        'namatoko' => $namatoko,
                        'alamat' => $alamat,
                        'links' => $links,
                        'hp' => $hp,
                        'gambar' => $fileName,
                    ]);
                }else {
                    return redirect()->back()->with('toast_error', 'File yang diupload bukan gambar!')->withInput();
                }

            }else {
                $fileName= 'none.jpg';
                $update = instansiM::where('idtoko', $idtoko)->update([
                    'namatoko' => $namatoko,
                    'alamat' => $alamat,
                    'links' => $links,
                    'hp' => $hp,
                    'gambar' => $fileName,
                ]);
            }


            if($update) {
                return redirect()->back()->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('toko')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\instansiM  $instansiM
     * @return \Illuminate\Http\Response
     */
    public function destroy(instansiM $instansiM, $idtoko)
    {

        try{
            $destroy = instansiM::where('idtoko', $idtoko)->delete();
            if($destroy) {
                return redirect('toko')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('toko')->with('toast_error', 'Terjadi kesalahan');
        }

    }
}
