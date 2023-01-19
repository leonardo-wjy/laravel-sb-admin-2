@include('header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="collapse collapse-list show" id="collapseList">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="padding-top: 8px;" class="m-0 font-weight-bold text-primary float-sm-left">Daftar Peminjaman Buku</h6>
                <a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#createModal"><i class="fas fa-book">&nbsp;</i>Pinjam</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th>Nama Buku</th>
                                <th>Nama Penerbit</th>
                                <th>Nama Peminjam</th>
                                <th>Status Pinjaman</th>
                                <th>Batas Pengembalian</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="cursor: pointer;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card shadow">
                <div class="modal-header card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="col px-0">
                        <h6 class="font-weight-bold text-primary">Pinjam Buku</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <form class="create-form" role="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Nama Buku<label class="text-danger">*</label></label>
                                <select class="form-control buku" name="buku" id="buku">
                                    <option value=""></option>
                                    <?php
                                    if (!empty($dataBuku)) {
                                        foreach ($dataBuku as $buku) {
                                    ?>
                                            <option value="<?= $buku->id; ?>"><?= $buku->name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Batal</button>
                    <button type="button" class="btn btn-primary btn-create-form btn-submit-form">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card shadow">
                <div class="modal-header card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="col px-0">
                        <h6 class="font-weight-bold text-primary">Detail Peminjaman Buku</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Nama Buku</label>
                            <input type="text" readonly class="form-control name-detail">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Penerbit Buku</label>
                            <input type="text" readonly class="form-control penerbit-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Nama Peminjam</label>
                            <input type="text" readonly class="form-control peminjam-detail">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Email Peminjam</label>
                            <input type="text" readonly class="form-control email-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Nomor Telepon Peminjam</label>
                            <input type="text" readonly class="form-control phone-detail">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Status Pinjaman</label>
                            <input type="text" readonly class="form-control status-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Batas Pengembalian</label>
                            <input type="text" readonly class="form-control batas-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Tanggal Peminjaman</label>
                            <input type="text" readonly class="form-control tgl-peminjaman-detail">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label font-weight-bold">Tanggal Pengembalian</label>
                            <input type="text" readonly class="form-control tgl-pengembalian-detail">
                        </div>
                    </div>
                </div>
                <div class="card-footer modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".buku").select2({
            placeholder: "Buku",
            width: "100%",
            theme: "bootstrap-5"
        })

        // Call the dataTables jQuery plugin
        const table = $('#dataTable').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'f>>t<'row align-items-start'<'col-md-4'l><'col-md-4 text-center'i><'col-md-4'p>>",
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: '{{ url()->current() }}',
                dataSrc: "data",
                data: function(data) {

                },
                onError: function(err) {
                    alert("Error")
                }
            },
            responsive: true,
            display: "stripe",
            searching: false,
            columnDefs: [{
                defaultContent: "-",
                targets: "_all"
            }],
            columns: [{
                data: "no",
                className: "text-center actions"
            }, {
                data: "name",
                className: "text-center"
            }, {
                data: "penerbit_name",
                className: "text-center"
            }, {
                data: "peminjam_name",
                className: "text-center"
            }, {
                data: "status",
                className: "text-center",
                render: function(data, type, row) {
                    return data === 3 ? `<label class="text-success">Sudah Mengembalikan</label>` : `<label class="text-danger">Belum Mengembalikan</label>`
                }
            }, {
                data: "batas_pengembalian",
                className: "text-center"
            }, {
                data: "createdAt",
                className: "text-center"
            }, {
                data: "updatedAt",
                className: "text-center"
            },
            {
                data: "id",
                className: "text-center actions",
                searchable: false,
                sortable: false,
                render: function(data, type, row) {
                    return row.status == 1 ? `
                    <div class="dropleft">
                        <button type="button" class="btn btn-link" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" style="box-shadow: 0px 2px 40px rgba(0, 0, 0, 0.2);">
                            <button class="dropdown-item view-detail" data-id="${row.id}" data-name="${row.name}" 
                            data-penerbit="${row.penerbit_name}" data-peminjam="${row.peminjam_name}" data-email="${row.email}" 
                            data-phone="${row.phone}" data-status="${row.status}" data-batas="${row.batas_pengembalian}"
                            data-tglpeminjaman="${row.createdAt}" data-tglpengembalian="${row.updatedAt}"><strong>Lihat</strong></button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item delete-data" data-id="${row.id}"><strong>Ubah Status</strong></button>
                        </div>
                    </div>` :
                    `
                    <div class="dropleft">
                        <button type="button" class="btn btn-link" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" style="box-shadow: 0px 2px 40px rgba(0, 0, 0, 0.2);">
                            <button class="dropdown-item view-detail" data-id="${row.id}" data-name="${row.name}" 
                            data-penerbit="${row.penerbit_name}" data-peminjam="${row.peminjam_name}" data-email="${row.email}" 
                            data-phone="${row.phone}" data-status="${row.status}" data-batas="${row.batas_pengembalian}"
                            data-tglpeminjaman="${row.createdAt}" data-tglpengembalian="${row.updatedAt}"><strong>Lihat</strong></button>
                        </div>
                    </div>`
                }
            }],
            language: {
                emptyTable: "Tidak Ada Data",
                lengthMenu: "Show _MENU_ entries",
                searchPlaceholder: ""
            }
        });

        $(".dataTables_info").addClass("pt-0");


    })

    $(document).on('click', '.view-detail', function() {
        $(".name-detail").val($(this).data('name'))
        $(".penerbit-detail").val($(this).data('penerbit'))
        $(".peminjam-detail").val($(this).data('peminjam'))
        $(".email-detail").val($(this).data('email'))
        $(".phone-detail").val($(this).data('phone'))
        $(".status-detail").val($(this).data('status') == 3 ? 'Sudah Mengembalikan' : 'Belum Mengembalikan')
        $(".batas-detail").val($(this).data('batas'))
        $(".tgl-peminjaman-detail").val($(this).data('tglpeminjaman'))
        $(".tgl-pengembalian-detail").val($(this).data('tglpengembalian'))
        $("#detailModal").modal()
    })

    $(document).on('click', '.delete-data', function() {
        Swal.fire({
            icon: 'question',
            title: 'Ubah Status?',
            confirmButtonColor: '#4e73df',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ubah',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "{{ url('pinjam/update-status') }}",
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    data: {
                        "id": $(this).data('id'),
                        "_token": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                confirmButtonColor: '#4e73df',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                confirmButtonColor: '#4e73df',
                            })
                        }
                    },
                    onError: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Disimpan',
                            confirmButtonColor: '#4e73df',
                        })
                    }
                })
            }
        })
    });
</script>

@include('footer')