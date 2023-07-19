<?php

namespace App\Http\Controllers;

use App\Models\kriteriaM;
use App\Models\perumahanM;
use App\Models\nilaiM;
use DB;
use Illuminate\Http\Request;

class konfigurasiC extends Controller
{
    public function kriteria(Request $request)
    {
        $kriteria = kriteriaM::get();

        $bobot = 0;
        foreach ($kriteria as $item) {
            $bobot = $bobot + $item->bobot;
        }

        $bobot = (int)($bobot * 100);

        return view('pages.pageskriteria', [
            'kriteria' => $kriteria,
            'bobot' => $bobot,
        ]);
    }

    public function tambahkriteria(Request $request)
    {
        $request->validate([
            'namakriteria' => 'required',
            'bobot' => 'required',
            'typedata' => 'required',
            'ket' => 'required',
        ]);


        try{
            $kriteria = kriteriaM::get();

            $bobot = 0;
            foreach ($kriteria as $item) {
                $bobot = $bobot + $item->bobot;
            }

            $bobot = ($bobot + ($request->bobot / 100)) * 100;

            if($bobot > 100) {
                return redirect()->back()->with('warning', 'Maaf pastikan bobot keseluruhan maksimal 100% <br> Total bobot <br> '.$bobot."%")->withInput();
            }

            $namakriteria = ucwords($request->namakriteria);
            $bobot = $request->bobot / 100;
            $typedata = $request->typedata;
            $ket = $request->ket;

            $store = new kriteriaM;
            $store->namakriteria = $namakriteria;
            $store->bobot = $bobot;
            $store->typedata = $typedata;
            $store->ket = $ket;
            $store->satuan = $request->satuan;
            $store->save();
            if($store) {
                $nama_k = str_replace(" ", "", strtolower($namakriteria));
                DB::statement("ALTER TABLE laptop ADD $nama_k bigint");

                return redirect('kriteria')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('kriteria')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahkriteria(Request $request, $idkriteria)
    {
        $request->validate([
            'bobot' => 'required',
        ]);


        try{
            $kriteria = kriteriaM::where('idkriteria', '!=', $idkriteria)->get();


            $bobot = 0;
            foreach ($kriteria as $item) {
                $bobot = $bobot + $item->bobot;
            }

            $bobot = (int)(($bobot + ($request->bobot / 100)) * 100);

            if($bobot > 100) {
                return redirect()->back()->with('warning', 'Maaf pastikan bobot keseluruhan maksimal 100% <br> Total bobot <br> '.$bobot."%")->withInput();
            }

            $bobot = $request->bobot / 100;

            $update = kriteriaM::where('idkriteria', $idkriteria)->update([
                'bobot' => $bobot,
                'satuan' => $request->satuan,
            ]);

            if($update) {
                return redirect('kriteria')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('kriteria')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function hapuskriteria(Request $request, $idkriteria)
    {
        try{
            $namakriteria = kriteriaM::where('idkriteria', $idkriteria)->first()->namakriteria;
            $nama_k = str_replace(" ", "", strtolower($namakriteria));
            $destroy = kriteriaM::where('idkriteria', $idkriteria)->delete();
            if($destroy) {
                DB::statement("ALTER TABLE laptop DROP COLUMN $nama_k");
                return redirect('kriteria')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('kriteria')->with('toast_error', 'Terjadi kesalahan');
        }
    }



    public function nilai(Request $request)
    {
        $kriteria = kriteriaM::get();


        return view('pages.pagesnilai', [
            'kriteria' => $kriteria,
        ]);
    }


    public function tambahnilai(Request $request, $idkriteria)
    {
        $request->validate([
            'ket' => 'required',
            'nilai' => 'required',
        ]);


        try{
            $ket = $request->ket;
            $nilai = $request->nilai;

            $store = new nilaiM;
            $store->idkriteria = $idkriteria;
            $store->ket = $ket;
            $store->nilai = $nilai;
            $store->save();
            if($store) {
                return redirect('nilai')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('nilai')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function hapusnilai(Request $request, $idnilai)
    {
        try{
            $nilai = nilaiM::where('idnilai', $idnilai)->first();
            $idkriteria = $nilai->idkriteria;
            $idnilai = $nilai->idnilai;

            $kriteria = kriteriaM::where('idkriteria', $idkriteria)->select('namakriteria', 'ket')->first();
            $namakriteria = str_replace(" ", "", strtolower($kriteria->namakriteria));
            $ket = $kriteria->ket;

            $destroy = nilaiM::where('idnilai', $idnilai)->delete();
            if($destroy) {
                if ($ket == 'statis') {
                    $laptop = perumahanM::where("$namakriteria", $idnilai)->update([
                        $namakriteria => null,
                    ]);
                }
                return redirect('nilai')->with('toast_success', 'success');
            }

        }catch(\Throwable $th){
            return redirect('nilai')->with('toast_error', 'Terjadi kesalahan');
        }
    }


    public function ubahnilai(Request $request, $idnilai)
    {
        $request->validate([
            'ket' => 'required',
            'nilai' => 'required',
        ]);


        try{
            $ket = $request->ket;
            $nilai = $request->nilai;

            $update = nilaiM::where('idnilai', $idnilai)->update([
                'ket' => $ket,
                'nilai' => $nilai,
            ]);

            if($update) {
                return redirect('nilai')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('nilai')->with('toast_error', 'Terjadi kesalahan');
        }
    }





}
