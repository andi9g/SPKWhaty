@extends('layout.layoutAdmin')

@section('activekusatuan')
    activeku
@endsection

@section('judul')
    <i class="fa fa-city"></i> SATUAN
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-md my-2" data-toggle="modal" data-target="#posisiTambah">
              Tambah Satuan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="posisiTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Satuan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <form action="{{ route('satuan.store', []) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class='form-group'>
                                    <label for='forsatuan' class='text-capitalize'>Nama Satuan</label>
                                    <input type='text' name='namasatuan' id='forsatuan' class='form-control' placeholder='masukan satuan'>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah Satuan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="my-0 py-0">Satuan</h3>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover table-sm table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama Satuan</th>
                            <th>aksi</th>
                        </thead>

                        <thead>
                            @foreach ($satuan as $item)
                            <tr>
                                <td width="5px">{{$loop->iteration}}</td>
                                <td>{{$item->namasatuan}}</td>
                                <td>
                                    <form action="{{ route('satuan.destroy', [$item->idsatuan]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('lanjutkan proses hapus?')" class="badge badge-danger border-0 py-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#editsatuan{{$item->idsatuan}}">
                                            <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- Modal -->

                                </td>

                            </tr>
                            <div class="modal fade" id="editsatuan{{$item->idsatuan}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <form action="{{ route('satuan.update', [$item->idsatuan]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class='form-group'>
                                                    <label for='forsatuan' class='text-capitalize'>Nama Satuan</label>
                                                    <input type='text' name='namasatuan' id='forsatuan' class='form-control' placeholder='masukan namaplaceholder' value="{{$item->namasatuan}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
