{{-- @extends('layouts.layouts')

@push('css')
<style>
    body{
        background-color: 	#b2d8d8;
    }

    .card-hover{
        cursor: pointer;
        background-color: #B8F180;
    }
    .done{
        background-color: #00FFAB;
    }
    .icon:hover{
        background-color: #B8F180;
    }
</style>
    
@endpush
@section('content')
<div class="input-group my-4">
    <input type="text" class="form-control" id="key" placeholder="Cari Tugas" aria-label="Recipient's username" aria-describedby="button-addon2">
    <button class="btn btn-success" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#exampleModal" id="button-tambah">Tambah</button>
  </div>
  @include('tugas.modal')
  @include('tugas.detail-tugas')
  <div class="list" id="container-list">
    
  </div>
@endsection
@push('js')
<script>
    $("#key").on("keyup", function() {
        let key = $(this).val();
        console.log(key);
        $.ajax({
            type: "GET",
            url: "{{ route('tugas.data') }}",
            data: {
                "key": key,
            },
            dataType: "json",
            success: function(response) {
                $('#container-list').html("");
                if (response.length != 0) {
                    $.each(response, function(key, item) {
                        let s = item.status == 1 ? 'bg-dark text-white' : '';
                        $('#container-list').append(`
                            <div class="card ${s}" style="margin-bottom:10px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="text-title">${item.judul}</h6>
                                        </div>

                                        <div class="col-md-6 text-end">
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-success btn-sm" onclick="status(${item.id_tugas})"><i class="fa-solid fa-check"></i></a>
                                                <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#taskmodal" onclick="show(${item.id_tugas})"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" onclick="hapus(${item.id_tugas})"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    ${item.deskripsi}
                                </div>
                            </div>
                            `);
                    });
                } else if (response.length == 0) {
                    $('#container-list').append(`
                        <div class="alert alert-danger text-center">
                            <h5?>Tidak Ditemukan</h5>
                        </div>
                    `);
                } else {
                    dataTugas();
                }
            }
        });
    });
    dataTugas()
    function dataTugas(){
        $.ajax({
            type: "GET",
            url : "{{ route('tugas.data') }}",
            dataType:"json",
            success: function(response){
                if(response.length != 0){
                    $('#container-list').html("")
                    $.each(response, function(key, item){
                        let s = item.status == 1 ? 'bg-secondary text-white' : '';
                        $('#container-list').append(`
                        <div class="card ${s}">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>${item.judul}</h6>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success btn-sm" onclick = "status(${item.id_tugas})"><i class="fa-solid fa-check"></i></button>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#taskmodal" onclick = "show(${item.id_tugas})"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick = "hapus(${item.id_tugas})"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                                ${item.deskripsi}
                            </div>
                        </div>
                        `);
                    });
                }
            }
    });
    }

    function dataDetail(id_tugas) {
        $.ajax({
            type: "GET",
            url: "{{ url('/todolist') }}/" + id_tugas,
            dataType: "json",
            success: function(response) {
                $('#list-check').html("")
                if (response.detail_tugas.length != 0) {
                    $.each(response.detail_tugas, function(key, item) {
                        let s = item.status == 1 ? 'checked' : '';
                        $('#list-check').append(`
                        <li class="list-group-item bg-dark text-white">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="${item.id_detail_tugas}" ${s} onclick="statusList(${item.id_detail_tugas}, ${item.id_tugas})">
                                    <label class="form-check-label">${item.detail_tugas}</label>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="#" class="text-decoration-none text-danger"  onclick="hapusDetail(${item.id_detail_tugas}, ${item.id_tugas})"><i class="fa-solid fa-minus text-danger"></i></a>
                            </div>
                        </div>
                    </li>
                        `);
                    });
                }else{
                    $('#list-check').append(`
                    <div class="alert alert-info text-center">
                        <h5>Belum ada detail tugas</h5>
                        </div>
                    `)
                }
            }
        })
    }

    function tambah() {
        $('#tambah').removeAttr('onclick');
        let judul = $('#judul').val();
        let deskripsi = $('#deskripsi').val();

        var data = {
            'judul': judul,
            'deskripsi': deskripsi,
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('tugas.store') }}",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    $('#judul').val("");
                    $('#deskripsi').val(""),
                    $('.modal').removeClass('show');
                    $(".modal").css('display', 'none');
                    $('.modal-backdrop').remove();
                    $('body').removeAttr('class');
                    $('body').removeAttr('style');
                    $('#tambah').attr('onclick', 'tambah()');
                    dataTugas();
                }
            }
        });
    }

    function status(id_tugas) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "{{ url('todoliststatus') }}/" + id_tugas,
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    dataTugas();
                }
            }
        });
    } 
    
    function hapus(id_tugas){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "{{ url('todolist') }}/" + id_tugas,
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    dataTugas();
                }
            }
        });
    }

    function show(id_tugas){
        $.ajax({
            type: "GET",
            url: "{{ url('/todolist') }}/" + id_tugas,
            dataType: "json",
            success: function(response) {
                $('#id_tugas').val(response.id_tugas)
                $('#detail-judul').val(response.judul)
                $('#detail-deskripsi').val(response.deskripsi)
                $('#list-check').html("")
                

                if(response.detail_tugas.length != 0){
                    dataDetail(response.id_tugas)
                }else{
                    $('#list-check').append(`
                    <div class="alert" alert-info text-center">
                        <h5>Belum ada detail list</h5>
                        </div>
                    `);
                }
            }
        });
    }
    function ubah(){
        $('#simpan').removeAttr('onclick');
        let id_tugas = $('#id_tugas').val();
        let judul = $('#detail-judul').val();
        let deskripsi = $('#detail-deskripsi').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "{{ url('/todolist') }}/" + id_tugas,
            data: {
                "judul": judul,
                "deskripsi": deskripsi,
            },
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    $('.modal').removeClass('show');
                    $(".modal").css('display', 'none');
                    $('.modal-backdrop').remove();
                    $('body').removeAttr('class');
                    $('body').removeAttr('style');
                    $('#simpan').attr('onclick', 'ubah()');
                    dataTugas();
                }
            }
        });
        
    }
    function statusList(id_detail_tugas, id_tugas){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "PUT",
            url: "{{ url('/detail-tugas') }}/" + id_detail_tugas,
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    dataDetail(id_tugas);
                    dataTugas();
                }
            }
        });
    }

    function tambahList(){
        let list = $('#list').val();
        let id_tugas = $('#id_tugas ').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var data = {
            'list': list,
            'id_tugas': id_tugas,

        }
        $.ajax({
            type: "POST",
            url: "{{ route('detail.store') }}",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    $('#list').val("");
                    dataDetail(id_tugas);
                }
            }
        });
    }

    function hapusDetail(id_detail_tugas, id_tugas){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "{{ url('/detail-tugas') }}/" + id_detail_tugas,
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    dataDetail(id_tugas);
                }
            }
        });
    }

    

</script>
    
@endpush --}}