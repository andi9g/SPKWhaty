<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SPK UNTUK MENENTUKAN PEMILIHAN LAPTOP </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="{{url('assets-frontend/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('assets-frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets-frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{url('assets-frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{url('assets-frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{url('assets-frontend/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{url('assets-frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <!-- Bootstrap CSS -->

    <link href="{{ url('assets-frontend/css/style.css', []) }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}


</head>

<body style="background-image: linear-gradient(rgba(255,255,255,0.75), rgba(255,255,255,0.75)),url(assets-frontend/img/pattern.png)">

    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="#">SPK Maut</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    @if ($open==false)
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#services">Cara Kerja</a></li>
                    @endif
                    @if (Session::get('login') != true)
                        <li><a class="nav-link scrollto" href="{{ url('login', []) }}">Login</a></li>
                    @endif
                    @if (Session::get('login') == true)
                        <li><a class="nav-link scrollto" href="{{ url('logout', []) }}">Logout</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    @if ($open==false)
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-item active" style="background-image: url(assets-frontend/img/images.jpeg)">
                <div class="carousel-container">
                    <div class="container">
                        <h2 class="animated fadeInDown">Sistem Pendukung Keputusan (SPK) Dalam Menentukan Laptop yang Sesuai Dengan Pilihan</h2>
                        <p class="animated fadeInUp"></p>
                        <a href="#pencarian" class="btn-get-started animated fadeInUp scrollto">Analisa</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        <section id="services" class="services">
            <div class="container-fluid">

                <div class="section-title">
                    <h3>Cara <span>Kerja</span></h3>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 icon-box">
                                <div class="icon"><i class="ri-pie-chart-line"></i></div>
                                <h4 class="title"><a href="">Data Laptop</a></h4>
                                <p class="description">Data laptop yang telah terdaftar, <a href="#laptop">Klik Disini</a></p>
                            </div>
                            <div class="col-lg-3 col-md-6 icon-box">
                                <div class="icon"><i class="ri-stack-line"></i></div>
                                <h4 class="title"><a href="">Pencarian Data Laptop</a></h4>
                                <p class="description">Mencari data laptop yang efektif dan sesuai keinginan yang tersedia, <a href="#pencarian">Klik Disini</a></p>
                            </div>
                            <div class="col-lg-3 col-md-6 icon-box">
                                <div class="icon"><i class="ri-markup-line"></i></div>
                                <h4 class="title"><a href="">Proses Pencarian</a></h4>
                                <p class="description">Proses dilakukan dengan metode SPK Maut dalam menentukan hasil yang inginkan</p>
                            </div>
                            <div class="col-lg-3 col-md-6 icon-box">
                                <div class="icon"><i class="ri-shape-line"></i></div>
                                <h4 class="title"><a href="">Hasil</a></h4>
                                <p class="description">Menampilkan hasil kedalam tabel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="laptop" class="services">
            <div class="container-fluid">

                <div class="section-title">
                    <h3>Data <span>Laptop</span></h3>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <table class="table table-sm bg-white table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar/Logo</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Jumlah Laptop</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($toko as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td align="center"><img src="{{ url('gambar/toko', [$item->gambar]) }}" width="60px" alt=""></td>
                                    <td>{{$item->namatoko}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->hp}}</td>
                                    <td align="center">
                                        @php
                                            $laptop = DB::table('laptop')->where('idtoko', $item->idtoko)->count();
                                        @endphp
                                        {{$laptop}}
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <section id="pencarian" class="services " >
            <div class="container-fluid" >

                <div class="section-title ">
                    <h3>Analisa <span>Pencarian</span></h3>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 px-5 ">
                                <div class="card">
                                    <div class="card-header bg-dark text-light"></div>
                                    <form action="{{ route('cari.data') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            @foreach ($kriteria as $k)
                                            @php
                                                $idkriteria = $k->idkriteria;
                                                $namakriteria = $k->namakriteria;
                                                $satuan = empty($k->satuan)?"": "(".$k->satuan.")";
                                                $nama_k = str_replace(" ", "", strtolower($k->namakriteria));
                                                $typedata = $k->typedata;
                                                $ket = $k->ket;
                                            @endphp

                                            @if ($ket == 'dinamis')
                                                <div class="form-group mb-4">
                                                    <label for="" class=""><b>{{$namakriteria." "}} <?= htmlspecialchars_decode($satuan) ?></b></label>
                                                    <input required type="number" name="{{$nama_k}}" class="form-control @error($nama_k)
                                                        is-invalid
                                                    @enderror" value="{{old($nama_k)}}" @if ($k->typedata == 'kurensi')
                                                        id="kurensi"
                                                    @endif>
                                                    @if ($k->typedata == 'kurensi')
                                                        {{-- <small><i>@if ($nilaimin != 500000000)
                                                            harga minimum Rp{{number_format($nilaimin)}}
                                                        @endif</i></small> --}}

                                                        <i>
                                                            <small>Nominal : </small>
                                                            <small id="terbilang"></small>
                                                        </i>

                                                        <script type="text/javascript">
                                                            var terbilang = document.getElementById('terbilang');
                                                            var rupiah = document.getElementById('kurensi');
                                                            rupiah.addEventListener('keyup', function(e){
                                                                // tambahkan 'Rp.' pada saat form di ketik
                                                                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                                                terbilang.innerHTML = formatRupiah(this.value, 'Rp. ');
                                                            });

                                                            /* Fungsi formatRupiah */
                                                            function formatRupiah(angka, prefix){
                                                                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                                split   		= number_string.split(','),
                                                                sisa     		= split[0].length % 3,
                                                                rupiah     		= split[0].substr(0, sisa),
                                                                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

                                                                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                                                if(ribuan){
                                                                    separator = sisa ? '.' : '';
                                                                    rupiah += separator + ribuan.join('.');
                                                                }

                                                                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                                                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                                                            }
                                                        </script>

                                                    @endif
                                                </div>
                                            @elseif($ket == 'statis')
                                            @php
                                                $pilihan = DB::table('nilai')->where('idkriteria', $idkriteria)->get();
                                            @endphp
                                                <div class="form-group mb-4">
                                                    <label for=""><b>{{$namakriteria." "}} <?= htmlspecialchars_decode($satuan) ?></b></label>
                                                    <select name="{{$nama_k}}" id="" required class="form-control @error($nama_k)
                                                    is-invalid
                                                @enderror">
                                                        <option value="">Pilih</option>
                                                        @foreach ($pilihan as $item)
                                                            <option value="{{$item->idnilai}}" @if (old($nama_k) == $item->idnilai)
                                                                selected
                                                            @endif>{{$item->ket}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-block w-100 btn-success">Proses</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @endif



    @if ($open==true)
    <main id="main">
        <section id="services" class="services">
            <div class="container-fluid">

                <div class="section-title">
                    <h3>Hasil <span>Ranking</span></h3>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <a href="{{ route('back.welcome', []) }}" class="btn btn-danger d-inline">Kembali</a>

                        <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn btn-success py-1 d-inline" data-bs-toggle="modal" data-bs-target="#perumahanAnalis">
                            Laptop
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="perumahanAnalis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="perumahanAnalisLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="perumahanAnalisLabel"><b>Hasil Pengurutan Nilai Ranking Laptop</b></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">


                                        @foreach ($toko as $item)
                                        <tr>
                                            <th colspan="3" class="bg-light">{{$item->namatoko}}</th>
                                        </tr>


                                        @php
                                            $no = 1;
                                        @endphp
                                        @for ($i = 0; $i < count($hasilPengurutan); $i++)

                                        @if ($item->namatoko == $hasilPengurutan[$i]['namatoko'])

                                        <tr>
                                            <td width="30px">{{$no++}}</td>
                                            <td>{{$hasilPengurutan[$i]['laptop']}}</td>
                                            <td><b>{{$hasilPengurutan[$i]['nilai']}}</b></td>

                                        </tr>

                                        @endif


                                        @endfor

                                        @endforeach
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div> --}}





                        <button type="button" class="btn btn-primary py-1 d-inline" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Proses Analisis
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><b>Proses Analisis</b></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="font-family: 10px">
                                    <label><b>Nama Toko</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach ($penampungToko as $item)
                                            <td width="{{100 / count($penampungToko)}}%">{{$item}}</td>

                                            @endforeach
                                        </tr>
                                    </table>

                                    <br>
                                    <label><b>Jumlah Laptop</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach ($penampungRumah as $item)
                                            <td width="{{100 / count($penampungRumah)}}%">{{$item}}</td>

                                            @endforeach
                                        </tr>
                                    </table>


                                    <br>
                                    <label><b>Kriteria Penilaian</b></label>
                                    <table width="100%" class="text-center text-bold table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach ($penampungNamaKriteria as $item)
                                            <td width="{{100 / count($penampungNamaKriteria)}}%"><b>{{$item}}</b></td>

                                            @endforeach
                                        </tr>
                                    </table>



                                    <br>
                                    <label><b>Bobot Kriteria</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach ($penampungBobot as $item)
                                            <td width="{{100 / count($penampungBobot)}}%">{{$item}}</td>

                                            @endforeach
                                        </tr>
                                    </table>


                                    {{-- nilai penting --}}
                                    <br>
                                    <label><b>Nilai Matriks Berdasarkan Kriteria</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        @php
                                            $i = 0;
                                            $k = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($penampungMatriks[0]); $i++)

                                        <tr>

                                            @for ($j = 0; $j < count($penampungMatriks); $j++)


                                                <td width="{{100 / count($penampungNamaKriteria)}}%">{{$penampungMatriks[$j][$i]}}</td>

                                            @endfor
                                        </tr>
                                        @endfor
                                    </table>


                                    <br>
                                    <label><b>Nilai Tertinggi</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach($kriteria as $item)
                                                @php
                                                    $namakriteria = str_replace(" ", "", strtolower($item->namakriteria));

                                                @endphp


                                            <td width="{{100 / count($penampungBobot)}}%">{{$penampungMax[$namakriteria]}}</td>

                                            @endforeach
                                        </tr>
                                    </table>

                                    <br>
                                    <label><b>Nilai Terendah</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach($kriteria as $item)
                                                @php
                                                    $namakriteria = str_replace(" ", "", strtolower($item->namakriteria));

                                                @endphp


                                            <td width="{{100 / count($penampungBobot)}}%">{{$penampungMin[$namakriteria]}}</td>

                                            @endforeach
                                        </tr>
                                    </table>

                                    <br>
                                    <label><b>Selisih Nilai (Tertinggi - Terendah)</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        <tr>
                                            @foreach($kriteria as $item)
                                                @php
                                                    $namakriteria = str_replace(" ", "", strtolower($item->namakriteria));

                                                @endphp


                                            <td width="{{100 / count($penampungBobot)}}%">{{$penampungSelisih[$namakriteria]}}</td>

                                            @endforeach
                                        </tr>
                                    </table>

                                    <br>
                                    <label><b>Nilai Matriks Normalisasi (matriks / selisih)</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        @for ($i = 0; $i < count($penampungMatriksNormalisasi); $i++)

                                        <tr>
                                            @foreach($kriteria as $item)
                                                @php
                                                    $namakriteria = str_replace(" ", "", strtolower($item->namakriteria));

                                                @endphp


                                            <td width="{{100 / count($penampungBobot)}}%">{{$penampungMatriksNormalisasi[$i][$namakriteria]}}</td>

                                            @endforeach
                                        </tr>
                                        @endfor
                                    </table>


                                    <br>
                                    <label><b>Hasil Matriks (Normalisasi * Bobot)</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                        @for ($i = 0; $i < count($penampungMatriksBobot); $i++)

                                        <tr>
                                            @foreach($kriteria as $item)
                                                @php
                                                    $namakriteria = str_replace(" ", "", strtolower($item->namakriteria));

                                                @endphp


                                            <td width="{{100 / count($penampungBobot)}}%">{{$penampungMatriksBobot[$i][$namakriteria]}}</td>

                                            @endforeach
                                        </tr>
                                        @endfor
                                    </table>


                                    <br>
                                    <label><b>Hasil Sementara</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">


                                        @foreach ($toko as $item)
                                        <tr>
                                            <th colspan="3" class="bg-light">{{$item->namatoko}}</th>
                                        </tr>


                                        @php
                                            $no = 1;
                                        @endphp
                                        @for ($i = 0; $i < count($hasilSementara); $i++)

                                        @if ($item->namatoko == $hasilSementara[$i]['namatoko'])

                                        <tr>
                                            <td width="30px">{{$no++}}</td>
                                            <td>{{$hasilSementara[$i]['laptop']}}</td>
                                            <td>{{$hasilSementara[$i]['nilai']}}</td>

                                        </tr>

                                        @endif


                                        @endfor

                                        @endforeach
                                    </table>


                                    <br>
                                    <label><b>Hasil Pengurutan Nilai Ranking</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">


                                        @foreach ($toko as $item)
                                        <tr>
                                            <th colspan="3" class="bg-light">{{$item->namatoko}}</th>
                                        </tr>


                                        @php
                                            $no = 1;
                                        @endphp
                                        @for ($i = 0; $i < count($hasilPengurutan); $i++)

                                        @if ($item->namatoko == $hasilPengurutan[$i]['namatoko'])

                                        <tr>
                                            <td width="30px">{{$no++}}</td>
                                            <td>{{$hasilPengurutan[$i]['laptop']}}</td>
                                            <td>{{$hasilPengurutan[$i]['nilai']}}</td>

                                        </tr>

                                        @endif


                                        @endfor

                                        @endforeach
                                    </table>


                                    <br>
                                    <label><b>Hasil Akhir</b></label>
                                    <table width="100%" class="table-bordered table-sm" border="1" style="border-collapse: collapse;font-family: 8pt">
                                    <tr>
                                        <th>Nama Toko</th>
                                        <th>Nilai Ranking</th>
                                    </tr>
                                        @php
                                            $i = 0;

                                        @endphp
                                        @foreach ($hasilUrut as $item)

                                        <tr>
                                            <td>{{$hasilUrut[$i]['namatoko']}}</td>
                                            <td>{{$hasilUrut[$i]['nilai']}}</td>
                                        </tr>

                                        @php
                                            $i++;
                                        @endphp
                                        @endforeach
                                    </table>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        {{-- <form action="{{ route('cetak.laporan') }}" class="d-inline" method="GET" target="_blank">
                            <button type="submit" class="btn btn-secondary my-2 py-1">Cetak Hasil Ranking</button>
                        </form> --}}

                        {{-- <table class="table table-sm table-striped table-bordered bg-white">
                            <thead>
                                <th>No</th>
                                <th>Gambar/Logo</th>
                                <th>Nama Toko</th>
                                <th>Alamat</th>
                                <th>Hp</th>
                                <th>Link</th>
                                <th>Nilai Ranking</th>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($hasilUrut as $item)
                                <tr>
                                    <td width="10px">{{$i++}}</td>
                                    <th class="text-center"><img src="{{ url('gambar/toko', [$item['gambar']]) }}" width="60px" alt=""></th>
                                    <th>{{$item['namatoko']}}</th>
                                    <td>{{$item['alamat']}}</td>
                                    <td>{{$item['hp']}}</td>
                                    <td class="text-center"><a href="{{$item['links']}}" class="btn btn-sm btn-secondary" target="_blank">Cek Link</a></td>
                                    <td>{{$item['nilai']}}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table> --}}

                        <table width="100%" class="table-bordered table-sm mt-2" border="0" style="border-collapse: collapse;font-family: 8pt">


                            @foreach ($hasilUrut as $item)
                            <tr>
                                <th colspan="4" style="background: rgb(224, 224, 224)">
                                    <table>
                                        @for ($i = 0; $i < count($hasilUrut); $i++)
                                        @if ($item['namatoko'] == $hasilUrut[$i]["namatoko"])
                                        {{-- <tr>
                                            <td rowspan="6" valign="top" class="p-2"><img src="{{ url('gambar/toko', [$hasilUrut[$i]['gambar']]) }}" class="rounded border-1" width="140px" alt=""></td>
                                            <td>PERINGKAT {{$loop->iteration}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr> --}}
                                        <tr>
                                            <td>Nama Toko</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{$hasilUrut[$i]["namatoko"]}}</td>
                                        </tr>

                                        <tr>
                                            <td>Alamat</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{$hasilUrut[$i]["alamat"]}}</td>
                                        </tr>

                                        <tr>
                                            <td>Nomor HP</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{$hasilUrut[$i]["hp"]}}</td>
                                        </tr>
                                        <tr>
                                            <td>Links</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><a href="{{$hasilUrut[$i]['links']}}" class="links-primary" target="_blank">Google Map</a></td></td>
                                        </tr>

                                        {{-- <tr>
                                            <td>Nilai Ranking</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{$hasilUrut[$i]["nilai"]}}</td>
                                        </tr> --}}

                                        @endif
                                        @endfor
                                    </table>
                                </th>
                            </tr>


                            @php
                                $no = 1;
                                $noH = 0;
                                $nilaiS = "";
                                $nilaiH = 0;
                            @endphp
                            @for ($i = 0; $i < count($hasilPengurutan); $i++)
                            @if ($item['namatoko'] == $hasilPengurutan[$i]['namatoko'])

                            <tr>
                                <td class="bg-light text-center" width="30px">{{$no++}}</td>
                                <td class="bg-light">{{$hasilPengurutan[$i]['laptop']}}</td>
                                <td width="10%" nowrap>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#detail{{$i}}">
                                      Lihat Spesifikasi Laptop
                                    </button>

                                    <!-- Modal -->

                                </td>
                                <td class="bg-light" width="10%" nowrap><b>{{$hasilPengurutan[$i]['nilai']*100}}%</b> Sesuai Keinginan</td>
                                @php
                                    $nilaiH = $nilaiH + $hasilPengurutan[$i]['nilai'];
                                    $noH++;
                                @endphp
                            </tr>

                            @endif

                            <div class="modal fade" id="detail{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Spesifikasi Laptop</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            @php
                                                $kriteria = DB::table('kriteria')->get();
                                            @endphp
                                            @foreach ($kriteria as $itemkriteria)
                                            @php
                                                $nkrit = str_replace(" ", "", strtolower($itemkriteria->namakriteria));
                                            @endphp
                                                <div class='form-group'>
                                                    <label for='{{$itemkriteria->namakriteria}}' class='text-capitalize'>{{$itemkriteria->namakriteria}}</label>
                                                    <input type='text' name='{{$itemkriteria->namakriteria}}' id='{{$itemkriteria->namakriteria}}' class='form-control' placeholder='masukan namaplaceholder' readonly value="{{$hasilPengurutan[$i][$nkrit]}}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor

                            {{-- <tr>
                                <td colspan="2"><b>Nilai Ranking : (Jumlah Nilai Laptop / Banyak Rumah)</b></td>
                                <td><b><font color="blue">{{$nilaiH." / ".$noH}}</font> =  {{$nilaiH / $noH}}</b></td>
                            </tr> --}}

                            <tr class="border-0">
                                <td colspan="3" class="border-0">
                                    <br>
                                </td>
                            </tr>

                            @php
                                $nilaiH = 0;
                                $noH = 0;
                            @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endif

    @if ($open == false)
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>SPK Maut</span></strong>
            </div>
        </div>
    </footer>
    @endif

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="{{ url('assets-frontend/vendor/purecounter/purecounter.js', []) }}"></script>
    <script src="{{ url('assets-frontend/vendor/bootstrap/js/bootstrap.bundle.min.js', []) }}"></script>
    <script src="{{ url('assets-frontend/vendor/glightbox/js/glightbox.min.js', []) }}"></script>
    <script src="{{ url('assets-frontend/vendor/isotope-layout/isotope.pkgd.min.js', []) }}"></script>
    <script src="{{ url('assets-frontend/vendor/swiper/swiper-bundle.min.js', []) }}"></script>
    <script src="{{ url('assets-frontend/vendor/waypoints/noframework.waypoints.js', []) }}"></script>
    <script src="{{ url('assets-frontend/vendor/php-email-form/validate.js', []) }}"></script>

    <script src="{{ url('assets-frontend/js/main.js', []) }}"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}


    @include('sweetalert::alert')

</body>

</html>
