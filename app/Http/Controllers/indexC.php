<?php

namespace App\Http\Controllers;

use App\Models\instansiM;
use App\Models\perumahanM;
use App\Models\nilaiM;
use App\Models\pengunjungM;
use App\Models\adminM;
use App\Models\laporanM;
use App\Models\kriteriaM;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Toko;
use App\Models\Laptop;
use PDF;
use Illuminate\Http\Request;

class indexC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function root()
    {
        return redirect('welcome');
    }

    public function indexkembali()
    {
        return redirect('welcome#pencarian');
    }

    public function index()
    {
        $toko = instansiM::get();

        $open = false;
        $dataharga = nilaiM::where('idkriteria', 1)->orderBy('ket', 'asc')->get();
        $nilaimin = 500000000000;
        foreach ($dataharga as $item) {
            if($nilaimin > $item->ket) {
                $nilaimin = $item->ket;
            }
        }

        $typerumah = nilaiM::select('idnilai','ket')
                     ->where('idkriteria', 2)->get();
        $luastanah = nilaiM::select('idnilai','ket')
        ->where('idkriteria', 3)->get();

        $spesifikasirumah = nilaiM::select('idnilai','ket')
        ->where('idkriteria', 4)->get();

        $kepadatanpenduduk = nilaiM::select('idnilai','ket')
        ->where('idkriteria', 6)->get();

        $kriteria = kriteriaM::orderBy('ket', 'DESC')->get();


        return view('pages.pagesindex', [
            'toko' => $toko,
            'nilaimin' => $nilaimin,
            'typerumah' => $typerumah,
            'luastanah' => $luastanah,
            'spesifikasirumah' => $spesifikasirumah,
            'kepadatanpenduduk' => $kepadatanpenduduk,
            'open' => $open,
            'kriteria' => $kriteria,
        ]);
    }


    public function cari2(Request $request)
    {
        $kriteria = Kriteria::orderBy('ket', 'DESC');
        foreach ($kriteria->get() as $k) {
            $namakriteria = str_replace(" ","", strtolower($k->namakriteria));
            $request->validate([
                $namakriteria => 'required',
            ]);
        }


        $data = [];
        $dataToko = Toko::get();
        $arrToko = [];
        foreach ($dataToko as $toko) {
            $idtoko = $toko->idtoko;
            $dataLaptop = Laptop::where('idtoko', $toko->idtoko)->get();

            $arrLaptop = [];
            foreach ($dataLaptop as $laptop) {
                $dataKriteria = Kriteria::get();

                $matriks = [];
                foreach ($dataKriteria as $kriteria) {
                    $namakriteria = str_replace(" ","", strtolower($kriteria->namakriteria));
                    $bobot = $kriteria->bobot;
                    $nilai = 0;
                    $tinggi = 30000000;
                    // dd($kriteria->ket);


                    if($kriteria->ket == 'dinamis') {
                        $dataSubkriteria = Subkriteria::where('idkriteria', $kriteria->idkriteria)->orderBy('ket', 'desc')->get();

                        $hargaTerendah = (int) Subkriteria::where('idkriteria', $kriteria->idkriteria)->orderBy('ket', 'asc')->first()->ket;
                        $hargaTertinggi = (int) Subkriteria::where('idkriteria', $kriteria->idkriteria)->orderBy('ket', 'desc')->first()->ket;



                        foreach ($dataSubkriteria as $subkriteria) {
                            $harga = (int)$subkriteria->ket;
                            $cari = (int) $request->$namakriteria;
                            $hargaLaptop = (int) $laptop->$namakriteria;

                            // $coba[] = ($hargaLaptop > $harga);
                            if($nilai == 0) {
                                // $coba[] =(($cari > $harga || $cari < $tinggi). " ". (($hargaLaptop > $harga) && ($hargaLaptop <= $tinggi)). " ". $tinggi);
                                if($cari > $harga){
                                    if($hargaLaptop > $harga) {
                                        $nilai = $subkriteria->nilai;
                                    }
                                }
                            }
                        }



                    }else {
                        $dataSubkriteria = Subkriteria::where('idkriteria', $kriteria->idkriteria)->orderBy('ket', 'desc')->get();

                        foreach ($dataSubkriteria as $subkriteria) {
                            $idket = (int)$subkriteria->idnilai;
                            $cari = (int) $request->$namakriteria;
                            $ketLaptop = (int) $laptop->$namakriteria;
                            if($cari == $ketLaptop && $cari == $idket && $nilai === 0) {
                                $nilai = $subkriteria->nilai;
                            }
                        }
                    }

                    $matriks[$namakriteria] = $nilai;


                }

                $arrLaptop[] = [
                    'namalaptop' => $laptop->namalaptop,
                    'matriks' => $matriks,
                ];

            }
            // dd($coba);
            // dd($arrLaptop);
            foreach ($dataKriteria as $kriteria) {
                $namakriteria = str_replace(" ","", strtolower($kriteria->namakriteria));
                ${$namakriteria} = [];
                ${'min'.$namakriteria} = 0;
                ${'max'.$namakriteria} = 0;
                ${'selisih'.$namakriteria} = 0;
            }

            foreach ($arrLaptop as $nilai) {
                $data[0]['namalaptop'][] = $nilai['namalaptop'];
                foreach ($dataKriteria as $kriteria) {
                    $namakriteria = str_replace(" ","", strtolower($kriteria->namakriteria));
                    $data[0][$namakriteria]['matriks'][] = $nilai['matriks'][$namakriteria];
                }
            }
            // dd($data);
            foreach ($dataKriteria as $kriteria) {
                $namakriteria = str_replace(" ","", strtolower($kriteria->namakriteria));
                foreach ($data as $dt) {

                    ${'min'.$namakriteria} = min($dt[$namakriteria]['matriks']);
                    ${'max'.$namakriteria} = max($dt[$namakriteria]['matriks']);


                    ${'selisih'.$namakriteria} = ${'max'.$namakriteria} - ${'min'.$namakriteria};
                    $data[0][$namakriteria]['min'] = ${'min'.$namakriteria};
                    $data[0][$namakriteria]['max'] = ${'max'.$namakriteria};
                    $data[0][$namakriteria]['selisih'] = ${'selisih'.$namakriteria};
                }
            }


            foreach ($dataKriteria as $kriteria) {
                $namakriteria = str_replace(" ","", strtolower($kriteria->namakriteria));
                foreach ($data as $dt) {
                    // dd($dt[$namakriteria]['matriks']);
                    foreach ($dt[$namakriteria]['matriks'] as $mt) {
                        // dd($data[0][$namakriteria]['selisih']);
                        if($mt > 0 && $data[0][$namakriteria]['selisih'] > 0) {
                            $data[0][$namakriteria]['normalisasi'][] = $mt / $data[0][$namakriteria]['selisih'];
                        }else {
                            $data[0][$namakriteria]['normalisasi'][] = 0;
                        }

                    }
                }

            }
            dd($data);



            $arrToko = [];

        }
        dd($ArrLaptop);

    }

    public function cari(Request $request)
    {
        // $request->validate([
        //     'hargarumah' => 'required',
        //     'jarakpusatkota' => 'required',
        //     'typerumah' => 'required',
        //     'luastanah' => 'required',
        //     'spesifikasirumah' => 'required',
        //     'kepadatanpenduduk' => 'required',
        // ]);

        //validate
        $kriteria = kriteriaM::orderBy('ket', 'DESC');
        foreach ($kriteria->get() as $k) {
            $namakriteria = str_replace(" ","", strtolower($k->namakriteria));
            $request->validate([
                $namakriteria => 'required',
            ]);
        }


        //cek nominal
        $kurensi = $kriteria->where('typedata', 'kurensi')->first()->idkriteria;
        $dataharga = nilaiM::where('idkriteria', $kurensi)->orderBy('ket', 'asc')->get();
        $nilaiminharga = 500000000000;
        foreach ($dataharga as $item) {
            if($nilaiminharga > $item->ket) {
                $nilaiminharga = $item->ket;
            }
        }


        $ceekinstansi = instansiM::join('laptop','laptop.idtoko', '=','toko.idtoko')->count();
        if($ceekinstansi == 0) {
            return redirect()->back()->with('warning','Maaf, Data toko belum ditambahkan')->withInput();
        }

        //---------------------------------------------
        $kriteria = kriteriaM::orderBy('ket', 'DESC');

        foreach ($kriteria->get() as $k) {
            // $request_hargarumah = $request->hargarumah;
            $namakriteria = str_replace(" ","", strtolower($k->namakriteria));
            if($k->typedata == 'kurensi') {
                if((int)$request->$namakriteria < $nilaiminharga) {
                    // return redirect('welcome#pencarian')->with('toast_error', 'Harga Rumah tidak valid');
                }
            }

            //tampung data;
            ${$namakriteria} = [];


            if($k->ket == 'dinamis') {
                $ambilData = nilaiM::select('ket')->where('idkriteria', $k->idkriteria)->get();


                foreach ($ambilData as $harga2) {
                    // $hargaArr[] = (int)($harga2->ket);
                    // dd($namakriteria);
                    ${"urutnilai_$namakriteria"}[] = (int)($harga2->ket);
                    rsort(${"urutnilai_$namakriteria"});
                }
            }



        }



        $toko = instansiM::get();
        $penampungToko = [];
        $penampungRumah = [];
        $index = 0;
        foreach ($toko as $instansi_) {
            $penampungToko[] = $instansi_->namatoko;

            $laptop = perumahanM::where('idtoko', $instansi_->idtoko)->get();

            $ipr = 0;
            foreach ($laptop as $laptop_) {
                $namalaptop = str_replace(" ", "", strtolower($laptop_->namalaptop));
                $ipr++;
                // dd($ipr++);
                //---------------------------------------------
                $kriteria = kriteriaM::orderBy('ket', 'DESC');


                $tinggi = 30000000;
                foreach ($kriteria->get() as $k) {
                    $idkriteria = $k->idkriteria;
                    $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));
                    $typedata = $k->typedata;
                    $ket = $k->ket;
                    dd($tinggi);
                    if($ket == 'dinamis') {
                        ${"dinamis_$namakriteria"} = 0;
                        foreach (${"urutnilai_$namakriteria"} as $item) {
                            // dd($laptop_->$namakriteria);
                            // if(($laptop_->$namakriteria > $item && ((int)$request->$namakriteria) >= $laptop_->$namakriteria) && ${"dinamis_$namakriteria"} == 0) {
                            //     ${$namakriteria}[] =  empty(nilaiM::where('ket', $item)->first()->nilai)?0:nilaiM::where('ket', $item)->first()->nilai;
                            //     ${"dinamis_$namakriteria"}++;
                            // }


                            if(${"dinamis_$namakriteria"} == 0){

                                if(((int)$request->$namakriteria) > $item) {
                                    if($laptop_->$namakriteria > $item && $laptop_->$namakriteria < $tinggi){

                                        ${$namakriteria}[] =  empty(nilaiM::where('ket', $item)->first()->nilai)?0:nilaiM::where('ket', $item)->first()->nilai;
                                        ${"dinamis_$namakriteria"}++;
                                    }else{
                                        ${$namakriteria}[] =  0;
                                        ${"dinamis_$namakriteria"}++;
                                    }
                                }elseif(((int)$request->$namakriteria) < $item && $laptop_->$namakriteria > $item){
                                    ${$namakriteria}[] =  0;
                                        ${"dinamis_$namakriteria"}++;
                                }

                                $tinggi = $item;
                            }


                        }
                        if(${"dinamis_$namakriteria"} === 0) {
                            ${$namakriteria}[] = 0;
                        }
                    }else if($ket == 'statis') {
                        if($laptop_->$namakriteria == $request->$namakriteria) {
                            ${$namakriteria}[] = empty(nilaiM::where('idnilai', $laptop_->$namakriteria)->first()->nilai)?0:nilaiM::where('idnilai', $laptop_->$namakriteria)->first()->nilai;
                        }else {
                            ${$namakriteria}[] = 0;
                        }
                    }


                }

                //DATA INSTANSI
                $dataToko[$index]['namatoko'] = $instansi_->namatoko;
                $dataToko[$index]['gambar'] = $instansi_->gambar;
                $dataToko[$index]['links'] = $instansi_->links;
                $dataToko[$index]['alamat'] = $instansi_->alamat;
                $dataToko[$index]['hp'] = $instansi_->hp;
                $dataToko[$index]['laptop'] = $laptop_->namalaptop;
                $dataToko[$index]['gambarLaptop'] = $laptop_->gambar;
                foreach ($kriteria->get() as $krit) {

                    $nkrit = str_replace(" ", "", strtolower($krit->namakriteria));
                    if ($krit->ket=='dinamis') {
                        if ($krit->typedata=='kurensi') {
                            $dataToko[$index][$nkrit] = "Rp".number_format($laptop_->$nkrit,0,",",".");
                        }else{
                            $dataToko[$index][$nkrit] = $laptop_->$nkrit;
                        }
                    }elseif($krit->ket == 'statis') {
                        $ambilNilai1 = $laptop_->$nkrit;
                        $nnilai = nilaiM::where('idnilai', $ambilNilai1)->first();
                        $dataToko[$index][$nkrit] = $nnilai->ket;
                    }



                    // dd($ambilNilai1);

                }

                $index++;
            }
            $penampungRumah[] = $ipr;
            $ipr =0;
        }


        $kriteria = kriteriaM::orderBy('ket', 'DESC');

        $penampungMatriks = [];
        $nom = 0;
        foreach ($kriteria->get() as $k) {
            $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));
            $penampungMatriks[$nom++] = ${$namakriteria};

        }

        // dd($COBA);

        // dd($penampungMatriks);
        //--------------------------------------------------------
        // dd($hargarumah);
        // dd($dataToko);

        $penampungMax = [];
        $penampungMin = [];
        $penampungSelisih = [];
        $penampungMatriksNormalisasi = [];
        $penampungMatriksBobot = [];


        $penampungNamakriteria = [];
        $penampungBobot = [];

        $kriteria = kriteriaM::orderBy('ket', 'DESC');

        foreach ($kriteria->get() as $k) {
            $penampungNamakriteria[] = $k->namakriteria;
            $penampungBobot[] = $k->bobot;
        }

        for ($i=0; $i < count($dataToko); $i++) {
            $kriteria = kriteriaM::orderBy('ket', 'DESC');

            foreach ($kriteria->get() as $k) {
                $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));

                //min, max, selisih harga
                ${"manipulasi_$namakriteria"} = ${$namakriteria};

                rsort(${"manipulasi_$namakriteria"});
                $max = ${"manipulasi_$namakriteria"}[0];
                $penampungMax[$namakriteria] = $max;

                sort(${"manipulasi_$namakriteria"});
                $min = ${"manipulasi_$namakriteria"}[0];
                $penampungMin[$namakriteria] = $min;

                $selisih = $max - $min;
                $penampungSelisih[$namakriteria] = $selisih;
                //pembagian selisih hargarumah
                $bobot = kriteriaM::where('idkriteria', $k->idkriteria)->first()->bobot;

                if($selisih != 0) {
                    $normalisasi = ${$namakriteria}[$i] / $selisih;
                    $tampung = (${$namakriteria}[$i] / $selisih) * $bobot;
                    $penampungMatriksNormalisasi[$i][$namakriteria] = $normalisasi;
                    //tampung baru
                    ${"tampung_$namakriteria"}[$i] = $tampung;
                    $penampungMatriksBobot[$i][$namakriteria] = ${"tampung_$namakriteria"}[$i];
                }else {
                    ${"tampung_$namakriteria"}[$i] = 0;
                    $penampungMatriksNormalisasi[$i][$namakriteria] = 0;
                    $penampungMatriksBobot[$i][$namakriteria] = 0;
                }

            }

        }


        $penampungHasilAkhir = [];
        $hasil = [];

        for ($i=0; $i < count($dataToko); $i++) {
            $kriteria = kriteriaM::orderBy('ket', 'DESC');

            $ambilnilai = 0 ;
            foreach ($kriteria->get() as $k) {
                $namakriteria = str_replace(" ", "", strtolower($k->namakriteria));
                // echo (float)(${"tampung_$namakriteria"}[$i])." ";
                $tambahNilai = ${"tampung_$namakriteria"}[$i];
                $ambilnilai = $ambilnilai + $tambahNilai;


            }

            // dd('stop');
            $hasil[$i]['nilai'] = $ambilnilai;
            $hasil[$i]['namatoko'] = $dataToko[$i]['namatoko'];
            $hasil[$i]['gambar'] = $dataToko[$i]['gambar'];
            $hasil[$i]['links'] = $dataToko[$i]['links'];
            $hasil[$i]['alamat'] = $dataToko[$i]['alamat'];
            $hasil[$i]['laptop'] = $dataToko[$i]['laptop'];
            $hasil[$i]['gambarLaptop'] = $dataToko[$i]['gambarLaptop'];
            $hasil[$i]['hp'] = $dataToko[$i]['hp'];
            foreach ($kriteria->get() as $krit) {
                $nkrit = str_replace(" ", "", strtolower($krit->namakriteria));
                $hasil[$i][$nkrit] = $dataToko[$i][$nkrit];
            }


        }


        $hasilSementara = $hasil;
        // dd($hasilnormalisasi);

        rsort($hasil);
        // dd($hasilnormalisasi);

        $penampungHasilSementara = [];

        $hasilUrut = [];
        $hasilUrutTampung = [];
        $cekurut = [];
        $nom = 0;
        for ($i=0; $i < count($hasil); $i++) {
            if(empty($cekurut)) {
                $cekurut[] = $hasil[$i]['namatoko'];

                $hasilUrutTampung[$hasil[$i]['namatoko']]['namatoko'] = $hasil[$i]['namatoko'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['laptop'] = $hasil[$i]['laptop'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['gambarLaptop'] = $hasil[$i]['gambarLaptop'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['gambar'] = $hasil[$i]['gambar'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['links'] = $hasil[$i]['links'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['alamat'] = $hasil[$i]['alamat'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['hp'] = $hasil[$i]['hp'];
            }
            if(in_array($hasil[$i]['namatoko'], $cekurut)) {
            }else {
                $cekurut[] = $hasil[$i]['namatoko'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['namatoko'] = $hasil[$i]['namatoko'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['laptop'] = $hasil[$i]['laptop'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['gambarLaptop'] = $hasil[$i]['gambarLaptop'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['gambar'] = $hasil[$i]['gambar'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['links'] = $hasil[$i]['links'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['alamat'] = $hasil[$i]['alamat'];
                $hasilUrutTampung[$hasil[$i]['namatoko']]['hp'] = $hasil[$i]['hp'];
            }

        }


        // dd($hasilUrutTampung);

        $nom = 0;
        foreach ($cekurut as $cek) {
            $icek = 0;
            $nilaiKeseluruhan = 0;

            for ($i=0; $i < count($hasil); $i++) {

                if($hasil[$i]['namatoko'] == $cek){
                    $icek++;
                    $nilaiKeseluruhan = $nilaiKeseluruhan + $hasil[$i]['nilai'];
                }
            }

            $nilaiKeseluruhan = $nilaiKeseluruhan / $icek;
            $hasilUrut[$nom]['nilai'] = $nilaiKeseluruhan;
            $hasilUrut[$nom]['namatoko'] = $hasilUrutTampung[$cek]['namatoko'];
            $hasilUrut[$nom]['laptop'] = $hasilUrutTampung[$cek]['laptop'];
            $hasilUrut[$nom]['gambarLaptop'] = $hasilUrutTampung[$cek]['gambarLaptop'];
            $hasilUrut[$nom]['gambar'] = $hasilUrutTampung[$cek]['gambar'];
            $hasilUrut[$nom]['links'] = $hasilUrutTampung[$cek]['links'];
            $hasilUrut[$nom]['alamat'] = $hasilUrutTampung[$cek]['alamat'];
            $hasilUrut[$nom]['hp'] = $hasilUrutTampung[$cek]['hp'];

            $nom++;
            $icek = 0;
        }

        rsort($hasilUrut);
        // dd($cekurut);
        // dd($hasilUrut);
        $open = true;
        $toko = instansiM::get();

        $dataharga = nilaiM::where('idkriteria', 1)->orderBy('ket', 'asc')->get();
        $nilaimin = 500000000000;
        foreach ($dataharga as $item) {
            if($nilaimin > $item->ket) {
                $nilaimin = $item->ket;
            }
        }

        // dd($hasil);
        // $typerumah = nilaiM::select('idnilai','ket')
        //              ->where('idkriteria', 2)->get();
        // $luastanah = nilaiM::select('idnilai','ket')
        // ->where('idkriteria', 3)->get();

        // $spesifikasirumah = nilaiM::select('idnilai','ket')
        // ->where('idkriteria', 4)->get();

        // $kepadatanpenduduk = nilaiM::select('idnilai','ket')
        // ->where('idkriteria', 6)->get();

        if($request->session()->get('login') === true && $request->session()->get('posisi') === 'pengunjung') {
            laporanM::where('idpengunjung', $request->session()->get('idpengunjung'))->delete();

            foreach ($hasilUrut as $data) {
                $tambah = new laporanM;
                $tambah->idpengunjung = $request->session()->get('idpengunjung');
                $tambah->gambar = $data['gambar'];
                $tambah->nilai = $data['nilai'];
                $tambah->namatoko = $data['namatoko'];
                $tambah->links = $data['links'];
                $tambah->alamat = $data['alamat'];
                $tambah->hp = $data['hp'];
                $tambah->save();
            }

        }

        // dd(count($hasilSementara));
        // dd(count($penampungMatriksNormalisasi));
        // dd(count($penampungMatriks[0]));
        // dd($hasil);
        $kriteria = kriteriaM::orderBy('ket', 'DESC')->get();

        $in = instansiM::get();
        return view('pages.pagesindex', [
            'toko' => $toko,
            'in' => $in,
            'nilaimin' => $nilaimin,
            // 'typerumah' => $typerumah,
            // 'luastanah' => $luastanah,
            // 'spesifikasirumah' => $spesifikasirumah,
            // 'kepadatanpenduduk' => $kepadatanpenduduk,
            'open' => $open,
            'hasilUrut' => $hasilUrut,
            'kriteria' => $kriteria,

            //penampung
            'penampungToko' => $penampungToko,
            'penampungRumah' => $penampungRumah,
            'penampungNamaKriteria' => $penampungNamakriteria,
            'penampungBobot' => $penampungBobot,
            'penampungMatriks' => $penampungMatriks,
            'penampungMatriksNormalisasi' => $penampungMatriksNormalisasi,
            'penampungMatriksBobot' => $penampungMatriksBobot,
            'penampungMax' => $penampungMax,
            'penampungMin' => $penampungMin,
            'penampungSelisih' => $penampungSelisih,

            //hasil
            'hasilSementara' => $hasilSementara,
            'hasilPengurutan' => $hasil,
            'hasilUrut' => $hasilUrut,

        ]);

    }

    public function cetak(Request $request)
    {
        if($request->session()->get('posisi')=='admin') {
            $request->session()->flush();
            return redirect('login')->with('warning', 'Silahkan login sebagai pengunjung!');
        }

        $idpengunjung = $request->session()->get('idpengunjung');
        $data = laporanM::where('idpengunjung', $idpengunjung)->orderBy('nilai', 'DESC')->get();

        $pdf = PDF::loadView('laporan.laporan',[
            'data' => $data,
        ]);

        return $pdf->stream();
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
    public function update(Request $request, instansiM $instansiM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\instansiM  $instansiM
     * @return \Illuminate\Http\Response
     */
    public function destroy(instansiM $instansiM)
    {
        //
    }
}
