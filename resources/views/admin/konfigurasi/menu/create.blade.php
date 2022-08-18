@extends('admin.layouts.main')
@section('container')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/{{ $url }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tambah {{ $form }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">{{ $breadcrumb }}</a></div>
                    <div class="breadcrumb-item"><a href="/{{ $url }}">{{ $form }}</a></div>
                    <div class="breadcrumb-item">Tambah</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form action="/{{ $url }}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h4>Tambah Data</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nama" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama') }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Slug</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="slug"
                                                class="form-control  @error('slug') is-invalid @enderror" id="slug"
                                                value="{{ old('slug') }}" required readonly>
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Icon</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="icon" id="icon"
                                                class="form-control @error('icon') is-invalid @enderror"
                                                value="{{ old('icon') }}" required>
                                            @error('icon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');

        nama.addEventListener('change', function() {
            fetch('/konfigurasi/menu/checkSlug?nama=' + nama.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection
