@extends('admin.layouts.main')
@section('container')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $form }}</h1>
                <div class="section-header-button">
                    <a href="/{{ $url }}/create" class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                        title="Tambah"><i class="fas fa-plus"></i></a>
                    <br>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">{{ $breadcrumb }}</a></div>
                    <div class="breadcrumb-item">{{ $form }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pilih Status</h4>
                                <h4 class="text-right"> <select class="form-control form-control-sm selectric"
                                        name="status_aktif" id="statusFilter">
                                        <option value="ON" selected>ON</option>
                                        <option value="OFF">OFF</option>
                                        <option value="">SEMUA</option>
                                    </select></h4>

                            </div>
                            <div class="card-body">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible show fade d-block">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>&times;</span>
                                            </button>
                                            <strong> {{ session('success') }}</strong>
                                        </div>
                                    </div>
                                @endif


                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Status Aktif</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($program as $item)
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        @if ($item->image)
                                                            <div class="gallery">
                                                                <div class="gallery-item rounded-circle bg-danger"
                                                                    data-image="{{ asset('storage/' . $item->image) }}"
                                                                    data-title="{{ $item->nama }}">
                                                                </div>
                                                                <span class="p-2"> {{ $item->nama }}</span>
                                                            </div>
                                                        @else
                                                            <div class="gallery">
                                                                <div class="gallery-item rounded-circle"
                                                                    data-image="/assets/img/avatar/avatar-5.png"
                                                                    data-title="{{ $item->nama }}">
                                                                </div>
                                                                <span class="p-2">{{ $item->nama }}</span>
                                                            </div>
                                                        @endif

                                                    </td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->role->nama }} </td>
                                                    <td>
                                                        @if ($item->status_aktif == 1)
                                                            <label class="custom-switch ">
                                                                <input type="checkbox" class="custom-switch-input" checked
                                                                    onclick="status_aktif({{ $item->id }})">
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="custom-switch-description">ON</span>
                                                            </label>
                                                        @else
                                                            <label class="custom-switch">
                                                                <input type="checkbox" class="custom-switch-input"
                                                                    onclick="status_aktif({{ $item->id }})">
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="custom-switch-description">OFF</span>
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="/{{ $url }}/{{ $item->slug }}/edit"
                                                            class="btn btn-warning btn-action mr-1" data-toggle="tooltip"
                                                            title="Edit"><i class="fas fa-pencil-alt"></i></a>

                                                        <!-- Button trigger modal -->
                                                        <div class="d-inline">
                                                            <button type="button" class="btn btn-danger btn-action hapus"
                                                                data-toggle="modal" title="Hapus" id="hapus"
                                                                value="{{ $item->slug }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>

                                                        <!-- Modal -->

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Delete
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" value="/{{ $url }}/" id="url" hidden>
                    Apakah data <u><span id="slug" class="font-weight-bold"></span></u> ingin di hapus ?
                </div>
                <form id="formHapus" action="" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-trash"></i>Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function status_aktif($id) {
            $.ajax({
                type: 'GET',
                url: '/konfigurasi/user_update_status_aktif?id=' + $id,
                success: function(data) {
                    window.location.href = "/konfigurasi/user_update_status_sukses";
                }
            });
        }
    </script>
@endsection
