@extends('admin.layouts.main')
@section('container')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/{{ $url }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ $form }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">Konfigurasi</a></div>
                    <div class="breadcrumb-item"><a href="/{{ $url }}">Role</a></div>
                    <div class="breadcrumb-item">{{ $form }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-sm-6 ">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    {{ $program_role->nama }}
                            </div>
                            </h4>

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
                                    <div class="col">
                                        <ul class="list-group">
                                            @foreach ($program_menu as $item)
                                                <li class="list-group-item active">{{ $item->nama }}</li>
                                                @foreach ($item->sub_menu as $items)
                                                    <li class="list-group-item">
                                                        <label class="custom-switch " style="margin-left: -40px;">
                                                            <input type="checkbox" id="{{ $items->id }}"
                                                                name="custom-switch-checkbox" class="custom-switch-input"
                                                                {{ check_access($program_role->id, $items->id) }}
                                                                onclick="pilih({{ $program_role->id }},{{ $items->menu_id }},{{ $items->id }})">
                                                            <span class="custom-switch-indicator"></span>
                                                            <span
                                                                class="custom-switch-description">{{ $items->nama }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function pilih(role_id, menu_id, sub_menu_id) {
            $.ajax({
                type: 'GET',
                url: '/konfigurasi/role/update_access_menu?role_id=' + role_id + '&menu_id=' + menu_id +
                    '&sub_menu_id=' + sub_menu_id,
                success: function(data) {
                    //console.log(data);
                    //  window.location.href = "/update_user_access_menu";
                }
            });
        }
    </script>
@endsection
