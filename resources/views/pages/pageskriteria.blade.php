@extends('layout.layoutAdmin')

@section('activekukriteria')
    activeku
@endsection

@section('judul')
    <i class="fa fa-edit"></i> Data Kriteria
@endsection

@section('content')
<div class="row">
    {{-- <div class="col-md-6">

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
    </div> --}}
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5>DATA KRITERIA</h5></div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <div class="row">
                    <div class="col-md-7">
                        <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#exampleModal">
                            Tambah Kriteria
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <form action="{{ route('tambah.kriteria') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="" class="text-capitalize">Nama Kriteria</label>
                                        <input type="text" name="namakriteria" id="" class="text-capitalize form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Bobot</label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="bobot" placeholder="1 s/d 100" id="" class="form-control">
                                            <div class="input-group-append">
                                              <span class="input-group-text" id="basic-addon2">%</span>
                                            </div>
                                          </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Type Data</label>
                                        <select name="typedata" id="" required class="form-control text-capitalize">
                                            <option value="angka">angka</option>
                                            <option value="huruf">huruf</option>
                                            <option value="kurensi">kurensi</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Proses</label>
                                        <select name="ket" id="" required class="form-control text-capitalize">
                                            <option value="statis">statis</option>
                                            <option value="dinamis">dinamis</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Satuan</label>
                                        <select name="satuan" id="" class="form-control text-capitalize">
                                            <option value="">Kosongkan</option>
                                            @foreach ($satuan as $sat)
                                                <option value="{{$sat->namasatuan}}">{{$sat->namasatuan}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-right">
                        <label for="">Total Persentase</label>
                        <h2>{{$bobot}}%</h2>

                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th style="width: fit-content">No</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $item)
                        <tr>
                            <td width="30px">{{$loop->iteration}}</td>
                            <td>{{$item->namakriteria}}</td>
                            <td>{{
                                    $item->bobot * 100
                                }}%</td>
                            <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-xs d-inline" data-toggle="modal" data-target="#edit{{$item->idkriteria}}">
                              <i class="fa fa-edit"></i> Edit
                            </button>

                            <form action="{{ route('hapus.kriteria', [$item->idkriteria]) }}"   method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Lanjutkan proses hapus kriteria?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>

                            </form>


                            </td>
                        </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="edit{{$item->idkriteria}}" tabindex="-1" role="dialog" aria-labelledby="ditKriteria" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <h5 class="modal-title">Edit Kriteria</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                        <form action="{{ route('ubah.kriteria', [$item->idkriteria]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="form-group">
                                                        <label for="">Nama Kriteria</label>
                                                        <input type="text" readonly name="namakriteria" value="{{$item->namakriteria}}" id="" class="form-control disabled">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Bobot</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="bobot" value="{{$item->bobot*100}}" id="" class="form-control">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text" id="basic-addon2">%</span>
                                                            </div>
                                                          </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Typedata</label>
                                                        <input type="text" readonly  value="{{$item->typedata}}" id="" class="form-control disabled">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Keterangan</label>
                                                        <input type="text" readonly  value="{{$item->ket}}" id="" class="form-control disabled">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Satuan</label>
                                                        <select name="satuan" id="" class="form-control text-capitalize">
                                                            <option value="" @if ($item->satuan == "")
                                                                selected
                                                             @endif>None</option>
                                                            @foreach ($satuan as $sat)
                                                                <option value="{{$sat->namasatuan}}" @if ($item->satuan == $sat->namasatuan)
                                                                    selected
                                                                @endif>{{$sat->namasatuan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Ubah Kriteria</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>


@endsection
