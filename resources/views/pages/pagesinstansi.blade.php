@extends('layout.layoutAdmin')

@section('activekuinstansi')
    activeku
@endsection

@section('judul')
    <i class="fa fa-city"></i> Data toko
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahInstansi">
                Tambah toko
            </button>

            <!-- Modal -->
            <div class="modal fade" id="tambahInstansi" tabindex="-1" aria-labelledby="tambahInstansiLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tambahInstansiLabel">Tambah toko</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('tambah.toko') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama toko</label>
                                <input type="text" name="namatoko" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="" cols="30" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">No Hp</label>
                                <input type="number" name="hp" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Links</label>
                                <textarea name="links" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" name="gambar" id="" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah toko</button>
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
                        <th>Gambar/Logo</th>
                        <th>Nama toko</th>
                        <th>Alamat</th>
                        <th>Link</th>
                        <th>No HP</th>
                        <th>Jml.P</th>
                        <th>laptop</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($toko as $item)
                    <tr>
                        <td>{{$loop->iteration + $toko->firstItem() - 1}}</td>
                        <td class="text-bold text-center">
                            <img src="{{ url('gambar', $item->gambar) }}" width="70px" alt="">
                        </td>
                        <td class="text-bold">{{$item->namatoko}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>
                            <a href="{{$item->links}}" class="btn btn-xs btn-info" target="_blank">Links</a>
                        </td>
                        <td>{{$item->hp}}</td>
                        <td class="text-center">
                            @php
                                $jml = DB::table('laptop')->where('idtoko', $item->idtoko)->count();
                            @endphp
                            {{$jml}}
                        </td>
                        <td>
                            <a href="{{ route('lihat.laptop', [$item->idtoko]) }}" class="btn btn-xs btn-success"> <i class="fa fa-eye"></i> Lihat laptop</a>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-xs d-inline" data-toggle="modal" data-target="#edit{{$item->idtoko}}">
                              <i class="fa fa-edit"></i> Edit
                            </button>

                            <form action="{{ route('hapus.toko', [$item->idtoko]) }}" method="post" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return confirm('Lanjutkan proses hapus?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            <!-- Modal -->
                        </td>
                    </tr>

                    <div class="modal fade" id="edit{{$item->idtoko}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data toko</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('ubah.toko', [$item->idtoko]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Nama toko</label>
                                            <input type="text" value="{{$item->namatoko}}" name="namatoko"  id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea value="" name="alamat" id="" cols="30" class="form-control" rows="3">{{$item->alamat}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">No Hp</label>
                                            <input type="number" value="{{$item->hp}}" name="hp" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Links</label>
                                            <textarea name="links" id="" cols="30" rows="3" class="form-control">{{$item->links}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gambar</label>
                                            <input type="file" name="gambar" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Data</button>
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
            {{$toko->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

</div>



@endsection

