@extends('admin.layouts.main')
@section('container')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $form }}</h1>
                <div class="section-header-button">
                    <a href="/{{ $url }}/create" class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                        title="Tambah"><i class="fas fa-plus"></i></a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">{{ $breadcrumb }}</a></div>
                    <div class="breadcrumb-item">{{ $form }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Table {{ $form }}</h4>
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

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-md">
                                                    <tr>
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Icon</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    @foreach ($program as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td><i class="{{ $item->icon }}"></i> {{ $item->icon }}</td>
                                                            <td>
                                                                <a href="/{{ $url }}/{{ $item->slug }}/edit"
                                                                    class="btn btn-sm btn-warning btn-action mr-1"
                                                                    data-toggle="tooltip" title="Edit"><i
                                                                        class="fas fa-pencil-alt"></i></a>

                                                                <!-- Button trigger modal -->
                                                                <div class="d-inline">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger btn-action hapus"
                                                                        data-toggle="modal" data-target="#delete"
                                                                        data-toggle="tooltip" title="Hapus" id="hapus"
                                                                        value="{{ $item->slug }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    {{-- modal hapus --}}
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-trash"></i> Delete
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger"> Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
