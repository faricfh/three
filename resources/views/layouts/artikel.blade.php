@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Artikel</div>

                <div class="card-body">
                    <a class="btn btn-primary btn-flat btn-sm" href="javascript:void(0)" id="tambahdata">
                        Tambah Data
                    </a>
                    <br><br>
                    <table class="table table-bordered data-table" width="100%">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Nama</th>
                                <th>konten</th>
                                <th width="120px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Bagian header modal-->
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal"><ion-icon name="close-circle">
                    </ion-icon>
                </button>
            </div>
            <!-- Akhir Bagian header modal-->
            <!-- Bagian Body Modal-->
            <div class="modal-body">
                <!-- Form-->
                <form id="dataForm" name="dataForm" class="form-horizontal">
                    <div>
                        <input type="hidden" name="artikel_id" id="artikel_id">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="name" class="control-label">Nama Artikel</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="name" class="control-label">konten</label>
                                <textarea name="konten" id="konten" cols="30" rows="10" class="form-control anjing"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Akhir Form-->
            </div>
            <!-- modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" type="button" class="form-control"
                id="batal">Batal</button>

                <button align="right" type="submit" class="form-control" id="simpan"
                value="create">Simpan</button>
            </div>
            <!-- Akhir modal footer-->
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    //INDEX TABEL
    var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('artikel') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'nama', name: 'nama'},
        {data: 'konten', name: 'konten'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
    });

    //KETIKA BUTTON TAMBAH DI KLIK
    $('#tambahdata').click(function () {
        $('#pemakaian_id').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Tambah Data");
        $('#modal').modal({backdrop: 'static', keyboard: false});
        $('#modal').modal('show');
    });

    //KETIKA BUTTON EDIT DI KLIK
    $('body').on('click', '.editData', function () {
    var isi_id = $(this).data('id');
        $.get("{{ url('artikel-edit') }}" +'/' + isi_id, function (data) {
            $('#modelHeading').html("Edit Data");
            $('#modal').modal({backdrop: 'static', keyboard: false});
            $('#modal').modal('show');
            $('#artikel_id').val(data.id);
            $('#nama').val(data.nama);
            $('#konten').val(data.konten);
        });
    });

     //KETIKA BUTTON SAVE DI KLIK
    $('#simpan').click(function (e) {
        e.preventDefault();
        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ url('artikel-store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#dataForm').trigger("reset");
                $('#modal').modal('hide');
                table.draw();
            },

            error: function (data) {
                console.log(data);
            }
        });
    });

      //KETIKA BUTTON DELETE DI KLIK
    $('body').on('click', '.hapusData', function () {
    var isi_id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "{{ url('artikel-delete') }}"+'/'+isi_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>
@endsection
