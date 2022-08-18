@extends('admin.layouts.main')
@section('container')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/{{ $url }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit {{ $form }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">{{ $breadcrumb }}</a></div>
                    <div class="breadcrumb-item"><a href="/{{ $url }}">{{ $form }}</a></div>
                    <div class="breadcrumb-item">Edit</div>
                </div>

            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form action="/{{ $url }}/{{ $program->slug }}" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Data</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nama" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', $program->nama) }}" required>
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
                                                value="{{ old('slug', $program->slug) }}" required readonly>
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $program->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">

                                        <label class="col-sm-3 col-form-label">Photo</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="oldImage" value={{ $program->image }} />
                                            @if ($program->image)
                                                <img src="{{ asset('storage/' . $program->image) }}"
                                                    class="img-preview img-fluid mb-3  d-block img-bordered-sm"
                                                    width="300" />
                                            @else
                                                <img alt="image" src="/assets/img/avatar/avatar-5.png"
                                                    class="img-preview img-fluid mb-3  d-block img-bordered-sm"
                                                    width="300">
                                            @endif
                                            <input class="form-control @error('image') is-invalid @enderror p-1"
                                                type="file" id="image" name="image" onchange="previewImage()">

                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm selectric" name="role_id">
                                                @foreach ($program_role as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id === $program->role_id ? 'Selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status Aktif</label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="status_aktif"
                                                    class="custom-control-input" value="1"
                                                    {{ $program->status_aktif === 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customRadioInline1">ON</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="status_aktif"
                                                    class="custom-control-input" value="0"
                                                    {{ $program->status_aktif === 0 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customRadioInline2">OFF</label>
                                            </div>
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
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');

        nama.addEventListener('change', function() {
            fetch('/konfigurasi/user/checkSlug?nama=' + nama.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection
