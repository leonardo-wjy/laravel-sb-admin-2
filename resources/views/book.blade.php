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
                <h6 style="padding-top: 8px;" class="m-0 font-weight-bold text-primary float-sm-left">Daftar Buku</h6>
                <a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus">&nbsp;</i>Tambah</a>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-end mx-0">
                    <div class="form-group col-md-3">
                        <select class="form-control filter-kategori-buku">
                            <option value=""></option>
                            <?php
                            if (!empty($dataKategoriBuku)) {
                                foreach ($dataKategoriBuku as $kategori_buku) {
                            ?>
                                    <option value="<?= $kategori_buku->id; ?>"><?= $kategori_buku->value; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select class="form-control filter-penerbit-buku">
                            <option value=""></option>
                            <?php
                            if (!empty($dataPenerbitBuku)) {
                                foreach ($dataPenerbitBuku as $penerbit_buku) {
                            ?>
                                    <option value="<?= $penerbit_buku->id; ?>"><?= $penerbit_buku->value; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" placeholder="Cari Nama Buku" class="form-control filter-nama-buku" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th>Nama Buku</th>
                                <th>Cover Buku</th>
                                <th>Kategori</th>
                                <th>Nama Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diperbarui</th>
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
<!-- /.container-fluid -->

<!-- Detail Modal-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card shadow">
                <div class="modal-header card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="col px-0">
                        <h6 class="font-weight-bold text-primary">Detail Buku</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Nama Buku</label>
                            <input type="text" readonly class="form-control name-book-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Kategori Buku</label>
                            <input type="text" readonly class="form-control category-book-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Nama Penerbit</label>
                            <input type="text" readonly class="form-control name-penerbit-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Tahun Terbit</label>
                            <input type="text" readonly class="form-control tahun-terbit-detail">
                        </div>
                    </div>
                    <div class="form-row tab-image-detail">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Cover Buku</label>
                            <div>
                                <img class="image-detail" src="" width="200" height="200" alt="" />
                            </div>
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
        $(".filter-kategori-buku").select2({
            placeholder: "Filter: Kategori",
            allowClear: true,
            theme: "bootstrap-5"
        })

        $(".filter-penerbit-buku").select2({
            placeholder: "Filter: Penerbit",
            allowClear: true,
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
                    data.kategori = $(".filter-kategori-buku option:selected").val();
                    data.penerbit = $(".filter-penerbit-buku option:selected").val();
                    data.nama = $(".filter-nama-buku").val();
                },
                onError: function(err) {
                    alert("Eror")
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
                data: "image",
                className: "text-center",
                render: function(data, type, row) {
                    return data ? `
                    <div style="cursor: pointer;"><a target="_blank" href="{{URL::asset("`+ data +`")}}">
                    <img src="{{URL::asset("`+ data +`")}}" width="50" height="50" alt="" />
                    </a></div>` : '-'
                }
            }, {
                data: "category_name",
                className: "text-center"
            }, {
                data: "penerbit_name",
                className: "text-center"
            }, {
                data: "tahun_terbit",
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
                    return row.image ?  `
                        <div class="dropleft">
                            <button type="button" class="btn btn-link" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu" style="box-shadow: 0px 2px 40px rgba(0, 0, 0, 0.2);">
                                <button class="dropdown-item view-detail" 
                                    data-id="${row.id}" 
                                    data-name="${row.name}"
                                    data-category="${row.category_name}"
                                    data-penerbit="${row.penerbit_name}"
                                    data-tahun="${row.tahun_terbit}"
                                    data-image="{{URL::asset("`+ row.image +`")}}"
                                ><strong>Lihat</strong></button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item delete-data" data-id="${row.id}"><strong>Hapus</strong></button>
                            </div>
                        </div>
                        `
                    :   `
                        <div class="dropleft">
                            <button type="button" class="btn btn-link" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu" style="box-shadow: 0px 2px 40px rgba(0, 0, 0, 0.2);">
                                <button class="dropdown-item view-detail" 
                                    data-id="${row.id}" 
                                    data-name="${row.name}"
                                    data-category="${row.category_name}"
                                    data-penerbit="${row.penerbit_name}"
                                    data-tahun="${row.tahun_terbit}"
                                    data-image=""
                                ><strong>Lihat</strong></button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item delete-data" data-id="${row.id}"><strong>Hapus</strong></button>
                            </div>
                        </div>
                        `
                }
            }],
            language: {
                emptyTable: "Tidak Ada Data",
                lengthMenu: "Show _MENU_ entries",
                searchPlaceholder: ""
            }
        });

        $(".dataTables_info").addClass("pt-0");

        $('.filter-kategori-buku, .filter-penerbit-buku').on('change', function() {
            table.ajax.reload();
        })

        $('.filter-nama-buku').on('keyup', function() {
            table.ajax.reload();
        })
    })

    $(document).on('click', '.view-detail', function() {
        $(".name-book-detail").val($(this).data('name'))
        $(".category-book-detail").val($(this).data('category'))
        $(".name-penerbit-detail").val($(this).data('penerbit'))
        $(".tahun-terbit-detail").val($(this).data('tahun'))
        $(".image-detail").attr("src", $(this).data('image'));
        $(this).data('image') ? $(".tab-image-detail").css("display",  "") : $(".tab-image-detail").css("display",  "none");
        $("#detailModal").modal()
    })

    $(document).on('click', '.delete-data', function() {
        Swal.fire({
            icon: 'question',
            title: 'Hapus Data?',
            confirmButtonColor: '#4e73df',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "{{ url('book') }}",
                    type: "DELETE",
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
                            title: 'Data Gagal Dihapus!',
                            confirmButtonColor: '#4e73df',
                        })
                    }
                })
            }
        })
    });
</script>

@include('footer')