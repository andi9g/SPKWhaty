@extends('layout.layoutAdmin')

@section('activekuinstansi')
    activeku
@endsection

@section('judul')
    <i class="fa fa-city"></i> Data Laptop ({{$toko->namatoko}})
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <a href="{{ url('instansi', []) }}" class="btn btn-secondary"><< Back</a>
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahPerumahan">
                Tambah Laptop
            </button>

            <!-- Modal -->
            <div class="modal fade" id="tambahPerumahan" tabindex="-1" aria-labelledby="tambahPerumahanLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tambahPerumahanLabel">Tambah Laptop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('tambah.laptop', [$idtoko]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Laptop</label>
                                <input type="text" name="namalaptop" id="" class="form-control">
                            </div>

                            @foreach ($kriteria as $k)
                                @php
                                    $idkriteria = $k->idkriteria;
                                    $namakriteria = $k->namakriteria;
                                    $nama_k = str_replace(" ", "", strtolower($k->namakriteria));
                                    $typedata = $k->typedata;
                                    $ket = $k->ket;
                                @endphp

                                @if ($ket == 'dinamis')
                                    <div class="form-group">
                                        <label for="">{{$namakriteria}}</label>
                                        <input type="number" name="{{$nama_k}}" id="" class="form-control">
                                    </div>
                                @elseif($ket == 'statis')
                                @php
                                    $pilihan = DB::table('nilai')->where('idkriteria', $idkriteria)->get();
                                @endphp
                                    <div class="form-group">
                                        <label for="">{{$namakriteria}}</label>
                                        <select name="{{$nama_k}}" id="" required class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($pilihan as $item)
                                                <option value="{{$item->idnilai}}">{{$item->ket}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Toko</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ url()->current() }}" class="form-inline justify-content-end">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Laptop</th>
                        @foreach ($kriteria as $item)
                        <th>{{$item->namakriteria}}</th>
                        @endforeach
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($laptop as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td nowrap class="text-bold">{{$item->namalaptop}}</td>
                        @foreach ($kriteria as $k)
                            @php
                                $cek = str_replace(" ", "", strtolower($k->namakriteria));
                                $dataperumahan = DB::table('laptop')
                                ->join('nilai', 'nilai.idnilai', '=', "laptop.$cek")
                                ->where('laptop.idlaptop', $item->idlaptop);
                            @endphp
                            @if ($k->ket == 'dinamis')
                                <td>{{$item->$cek}}</td>
                            @elseif($k->ket == 'statis')
                                @if ($dataperumahan->count() == 1)
                                    <td>{{$dataperumahan->first()->ket}}</td>
                                @else
                                    <td></td>
                                @endif

                            @endif

                        @endforeach
                        <td nowrap>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-xs d-inline" data-toggle="modal" data-target="#edit{{$item->idlaptop}}">
                              <i class="fa fa-edit"></i> Edit
                            </button>

                            <form action="{{ route('hapus.laptop', [$item->idlaptop]) }}" method="post" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return confirm('Lanjutkan proses hapus?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            <!-- Modal -->
                        </td>
                    </tr>

                    <div class="modal fade" id="edit{{$item->idlaptop}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data Laptop</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('ubah.laptop', [$item->idlaptop]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Nama Laptop</label>
                                            <input type="text" name="namalaptop" value="{{$item->namalaptop}}" id="" class="form-control">
                                        </div>

                                        @foreach ($kriteria as $k)
                                            @php
                                                $idkriteria = $k->idkriteria;
                                                $namakriteria = $k->namakriteria;
                                                $nama_k = str_replace(" ", "", strtolower($k->namakriteria));
                                                $typedata = $k->typedata;
                                                $ket = $k->ket;
                                            @endphp

                                            @if ($ket == 'dinamis')
                                                <div class="form-group">
                                                    <label for="">{{$namakriteria}}</label>
                                                    <input type="number" name="{{$nama_k}}" id="" class="form-control" value="{{$item->$nama_k}}">
                                                </div>
                                            @elseif($ket == 'statis')
                                            @php
                                                $pilihan = DB::table('nilai')->where('idkriteria', $idkriteria)->get();
                                            @endphp
                                                <div class="form-group">
                                                    <label for="">{{$namakriteria}}</label>
                                                    <select name="{{$nama_k}}" id="" required class="form-control">
                                                        <option value="">Pilih</option>
                                                        @foreach ($pilihan as $item3)
                                                            <option value="{{$item3->idnilai}}" @if ($item3->idnilai == $item->$nama_k)
                                                                selected
                                                            @endif>{{$item3->ket}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ubah Toko</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{-- {{$toko->links('vendor.pagination.bootstrap-4')}} --}}
        </div>
    </div>

</div>



@endsection
