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
                <div class="col px-0 text-right">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus">&nbsp;</i>Tambah</a>
                    <a class="btn btn-primary btn-print"><i class="fas fa-print">&nbsp;</i>Print</a>
                </div>
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
                                <th>Jumlah Buku</th>
                                <th>Jumlah Pinjaman</th>
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

<!-- Create Modal-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card shadow">
                <div class="modal-header card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="col px-0">
                        <h6 class="font-weight-bold text-primary">Tambah Buku</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <form class="create-form" role="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Nama Buku<label class="text-danger">*</label></label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Kategori Buku<label class="text-danger">*</label></label>
                                <select class="form-control kategori" name="kategori[]" id="kategori" multiple>
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Nama Penerbit<label class="text-danger">*</label></label>
                                <select class="form-control penerbit" name="penerbit" id="penerbit">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Tahun Terbit<label class="text-danger">*</label></label>
                                <input class="form-control tahun" name="tahun" id="tahun">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Jumlah Buku<label class="text-danger">*</label></label>
                                <input class="form-control jumlah" type="number" onkeypress="return event.charCode != 45 && (event.charCode >= 48 && event.charCode <= 57)" min="0" max="100" name="jumlah" id="jumlah">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Cover Buku</label>
                                <div>
                                    <img width="200" style="display: none;" id="preview_photo" height="200" src="" alt="" />
                                </div>
                                <input type="file" class="form-control" onchange="previewPhoto();" name="image" id="image" accept="image/png, image/jpg, image/jpeg">
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

<!-- Edit Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card shadow">
                <div class="modal-header card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="col px-0">
                        <h6 class="font-weight-bold text-primary">Edit Buku</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <form class="update-form" role="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" class="id" id="id" />
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Nama Buku<label class="text-danger">*</label></label>
                                <input type="text" class="form-control name-edit" name="name_edit" id="name_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Kategori Buku<label class="text-danger">*</label></label>
                                <select class="form-control kategori-edit" name="kategori_edit[]" id="kategori_edit" multiple>
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Nama Penerbit<label class="text-danger">*</label></label>
                                <select class="form-control penerbit-edit" name="penerbit_edit" id="penerbit_edit">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Tahun Terbit<label class="text-danger">*</label></label>
                                <input class="form-control tahun-edit" name="tahun_edit" id="tahun_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Jumlah Saat Ini</label>
                                <input class="form-control jumlah-lama" type="text" readonly name="jumlah_lama" id="jumlah_lama">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Jumlah Dipinjam</label>
                                <input type="text" readonly class="form-control jumlah-pinjam-edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Tambah Jumlah</label>
                                <input class="form-control jumlah-edit" type="number" onkeypress="return event.charCode != 45 && (event.charCode >= 48 && event.charCode <= 57)" name="jumlah_edit" id="jumlah_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label font-weight-bold">Cover Buku</label>
                                <div>
                                    <img width="200" style="display: none;" id="preview_photo_edit" height="200" src="" alt="" />
                                </div>
                                <input type="file" class="form-control" name="image_edit" id="image_edit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Batal</button>
                    <button type="button" class="btn btn-primary btn-update-form btn-submit-form">Ubah</button>
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
                            <label class="control-label font-weight-bold">Jumlah Buku</label>
                            <input type="text" readonly class="form-control jumlah-buku-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Jumlah Dipinjam</label>
                            <input type="text" readonly class="form-control jumlah-pinjam-detail">
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
                                <img class="image-detail" src="" width="200" height="200" alt="" accept="image/png, image/jpg, image/jpeg" />
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
        $(".btn-print").click(function() {
            $.ajax({
                type: 'GET',
                url : "{{ url('book/print') }}",
                data: {
                    kategori: $(".filter-kategori-buku option:selected").val(),
                    penerbit: $(".filter-penerbit-buku option:selected").val(),
                    nama_kategori: $(".filter-kategori-buku option:selected").text(),
                    nama_penerbit: $(".filter-penerbit-buku option:selected").text(),
                    nama: $(".filter-nama-buku").val()
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var fileURL = window.URL.createObjectURL(blob);
                    window.open(fileURL);
                },
                onError: function(err) {
                    alert("Error")
                }
            });
        })

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

        $(".kategori").select2({
            placeholder: "Kategori Buku",
            width: "100%",
            theme: "bootstrap-5"
        })

        $(".penerbit").select2({
            placeholder: "Penerbit Buku",
            theme: "bootstrap-5"
        })

        $(".kategori-edit").select2({
            placeholder: "Kategori Buku",
            width: "100%",
            theme: "bootstrap-5"
        })

        $(".penerbit-edit").select2({
            placeholder: "Penerbit Buku",
            theme: "bootstrap-5"
        })

        $(".tahun").datepicker({
            todayHighlight: true,
            format: "yyyy",
            minViewMode: 2,
            orientation: "bottom auto",
            autoclose: true
        })

        $(".tahun-edit").datepicker({
            todayHighlight: true,
            format: "yyyy",
            minViewMode: 2,
            orientation: "bottom auto",
            autoclose: true
        })

        $(".create-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                    maxlength: 1000
                },
                "kategori[]": {
                    required: true
                },
                penerbit: {
                    required: true
                },
                tahun: {
                    required: true
                },
                jumlah: {
                    required: true,
                    min: 0
                }
            },
            messages: {
                name: {
                    required: "Nama Harus Diisi",
                    minlength: "Nama Minimal 4 Karakter",
                    maxlength: "Nama Maksimal 1000 Karakter"
                },
                "kategori[]": {
                    required: "Kategori Harus Diisi"
                },
                penerbit: {
                    required: "Penerbit Harus Diisi"
                },
                tahun: {
                    required: "Tahun Terbit Harus Diisi"
                },
                jumlah: {
                    required: "Jumlah Buku Harus Diisi",
                    min: "Jumlah Buku Minimal 0"
                }
            },
            // highlight: function(element) {
            //     $(element).addClass("is-invalid").removeClass("is-valid");
            // },
            // unhighlight: function(element) {
            //     $(element).addClass("is-valid").removeClass("is-invalid");
            // },

            //add
            errorElement: 'span',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent(); 
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            }
            // end add
        });

        $(".update-form").validate({
            rules: {
                name_edit: {
                    required: true,
                    minlength: 4,
                    maxlength: 1000
                },
                "kategori_edit[]": {
                    required: true
                },
                penerbit_edit: {
                    required: true
                },
                tahun_edit: {
                    required: true
                },
                jumlah_edit: {
                    min: 0
                }
            },
            messages: {
                name_edit: {
                    required: "Nama Harus Diisi",
                    minlength: "Nama Minimal 4 Karakter",
                    maxlength: "Nama Maksimal 1000 Karakter"
                },
                "kategori_edit[]": {
                    required: "Kategori Harus Diisi"
                },
                penerbit_edit: {
                    required: "Penerbit Harus Diisi"
                },
                tahun_edit: {
                    required: "Tahun Terbit Harus Diisi"
                },
                jumlah_edit: {
                    min: "Jumlah Buku Minimal 0"
                }
            },
            // highlight: function(element) {
            //     $(element).addClass("is-invalid").removeClass("is-valid");
            // },
            // unhighlight: function(element) {
            //     $(element).addClass("is-valid").removeClass("is-invalid");
            // },

            //add
            errorElement: 'span',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent(); 
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            }
            // end add
        });

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
                data: "jumlah",
                className: "text-center",
                render: function(data, type, row) {
                    return `
                    <label>`+ data +` Unit
                    </label>`
                }
            }, {
                data: "jumlah_dipinjam",
                className: "text-center",
                render: function(data, type, row) {
                    return `
                    <label>`+ data +` Unit
                    </label>`
                }
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
                                    data-jumlah="${row.jumlah}"
                                    data-jumlahdipinjam="${row.jumlah_dipinjam}"
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
                                    data-jumlah="${row.jumlah}"
                                    data-jumlahdipinjam="${row.jumlah_dipinjam}"
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
        $('#dataTable tbody').on('click', 'tr td:not(.actions):not(.dataTables_empty)', function() {
            // validator.resetForm();
            // validator.reset();
            const data = table.row(this).data();
            $(".id").val(data.id)
            $(".name-edit").val(data.name)
            $(".kategori-edit").val(data.category_id).trigger('change')
            $(".penerbit-edit").val(data.penerbit_id).trigger('change')
            $(".jumlah-pinjam-edit").val(data.jumlah_dipinjam)
            $(".tahun-edit").val(data.tahun_terbit)
            $(".jumlah-lama").val(data.jumlah)
            document.getElementById("preview_photo_edit").style = data.image ? "" : "display: none;";
            document.getElementById("preview_photo_edit").src = `{{URL::asset("`+ data.image +`")}}`;
            $("#editModal").modal()
        });

        $('.filter-kategori-buku, .filter-penerbit-buku').on('change', function() {
            table.ajax.reload();
        })

        $('.filter-nama-buku').on('keyup', function() {
            table.ajax.reload();
        })

        $(".btn-create-form").click(function() {
            if ($(".create-form").valid()) {
                Swal.fire({
                    icon: 'question',
                    title: 'Simpan Data?',
                    confirmButtonColor: '#4e73df',
                    cancelButtonColor: '#d33',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setLoading()
                        let data = new FormData(document.querySelector(".create-form"));

                        $.ajax({
                            url : "{{ url('book/create') }}",
                            type: "POST",
                            cache: false,
                            data: data,
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        confirmButtonColor: '#4e73df',
                                    }).then((responseSuccess) => {
                                        if (responseSuccess.isConfirmed) {
                                            stopLoading()
                                            table.ajax.reload();
                                            $('.kategori').val([]).trigger("change")
                                            $('.penerbit').val("").trigger("change")
                                            $(".create-form")[0].reset();
                                            $("#createModal").modal('toggle');
                                        }
                                    })
                                } else {
                                    stopLoading()
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        confirmButtonColor: '#4e73df',
                                    })
                                }
                            },
                            onError: function(err) {
                                stopLoading()
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data Gagal Disimpan',
                                    confirmButtonColor: '#4e73df',
                                })
                            }
                        })
                    }
                })
            }
        })

        $(".btn-update-form").click(function() {
            let id = $(".id").val();

            if ($(".update-form").valid()) {
                Swal.fire({
                    icon: 'question',
                    title: 'Simpan Data?',
                    confirmButtonColor: '#4e73df',
                    cancelButtonColor: '#d33',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonText: 'Ubah',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setLoading()
                        $.ajax({
                            url : "{{ url('book/update') }}" + "/" + id,
                            type: "PATCH",
                            dataType: "json",
                            cache: false,
                            data: $(".update-form").serialize(),
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        confirmButtonColor: '#4e73df',
                                    }).then((responseSuccess) => {
                                        if (responseSuccess.isConfirmed) {
                                            stopLoading()
                                            table.ajax.reload();
                                            $('.kategori-edit').val([]).trigger("change")
                                            $('.penerbit-edit').val("").trigger("change")
                                            $(".update-form")[0].reset();
                                            $("#editModal").modal('toggle');
                                        }
                                    })
                                } else {
                                    stopLoading()
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        confirmButtonColor: '#4e73df',
                                    })
                                }
                            },
                            onError: function(err) {
                                stopLoading()
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data Gagal Diubah',
                                    confirmButtonColor: '#4e73df',
                                })
                            }
                        })
                    }
                })
            }
        });  
    })

    $(document).on('click', '.view-detail', function() {
        $(".name-book-detail").val($(this).data('name'))
        $(".category-book-detail").val($(this).data('category'))
        $(".name-penerbit-detail").val($(this).data('penerbit'))
        $(".tahun-terbit-detail").val($(this).data('tahun'))
        $(".image-detail").attr("src", $(this).data('image'));
        $(".jumlah-buku-detail").val($(this).data('jumlah'))
        $(".jumlah-pinjam-detail").val($(this).data('jumlahdipinjam'))
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

    //change picture
    const previewPhoto = function() {
        let file = document.getElementById("image").files[0];
        document.getElementById("preview_photo").style = "";
        document.getElementById("preview_photo").src = window.URL.createObjectURL(file);
    }

    const previewPhotoEdit = function() {
        let file = document.getElementById("image_edit").files[0];
        document.getElementById("preview_photo_edit").style = "";
        document.getElementById("preview_photo_edit").src = window.URL.createObjectURL(file);
    }
</script>

@include('footer')