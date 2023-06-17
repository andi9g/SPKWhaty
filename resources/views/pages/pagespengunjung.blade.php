@extends('layout.layoutAdmin')

@section('activekupengunjung')
    activeku
@endsection

@section('judul')
    <i class="fa fa-city"></i> Data pengunjung
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            
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
                        <th>Nama Pengunjung</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pengunjung as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-bold">{{$item->nama}}</td>
                        <td>{{$item->username}}</td>
                        <td>
                            
                            <form action="{{ route('hapus.pengunjung', [$item->idpengunjung]) }}" method="post" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return confirm('Lanjutkan proses hapus?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            <!-- Modal -->
                        </td>
                    </tr>
                    
                    
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{$pengunjung->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

</div>



@endsection