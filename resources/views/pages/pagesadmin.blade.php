@extends('layout.layoutAdmin')

@section('activekuadmin')
    activeku
@endsection

@section('judul')
    <i class="fa fa-city"></i> Data Admin
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#tambahAdmin">
                Tambah Admin
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="tambahAdminLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tambahAdminLabel">Tambah Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('admin.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Admin</label>
                                <input type="text" name="nama" id="" class="form-control">    
                            </div>  
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="" class="form-control">    
                            </div>  
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" id="" class="form-control">    
                            </div>  
        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Admin</button>
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
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admin as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-bold">{{$item->nama}}</td>
                        <td>{{$item->username}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-xs d-inline" data-toggle="modal" data-target="#edit{{$item->idadmin}}">
                              <i class="fa fa-edit"></i> Edit
                            </button>
                            
                            <form action="{{ route('admin.destroy', [$item->idadmin]) }}" method="post" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return confirm('Lanjutkan proses hapus?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                            <!-- Modal -->
                        </td>
                    </tr>
                    
                    <div class="modal fade" id="edit{{$item->idadmin}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('admin.update', [$item->idadmin]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Nama Admin</label>
                                            <input type="text" value="{{$item->nama}}" name="nama"  id="" class="form-control">    
                                        </div>                    
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" value="" required name="password"  id="" class="form-control">    
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
            {{$admin->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>

</div>



@endsection