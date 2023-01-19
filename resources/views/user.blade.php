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
                <h6 style="padding-top: 8px;" class="m-0 font-weight-bold text-primary float-sm-left">Daftar Pengguna</h6>
                <a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus">&nbsp;</i>Tambah</a>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-end mx-0">
                    <div class="form-group col-md-3">
                        <input type="text" placeholder="Cari Email/Name/Phone" class="form-control filter-search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Status</th>
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
                        <h6 class="font-weight-bold text-primary">Tambah User</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <form class="create-form" role="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Nama<label class="text-danger">*</label></label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Email<label class="text-danger">*</label></label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Role<label class="text-danger">*</label></label>
                                <select class="form-control role" name="role" id="role">
                                    <option value="Admin">Admin</option>
                                    <option value="Peminjam">Peminjam</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Nomor Telepon<label class="text-danger">*</label></label>
                                <input type="text" class="form-control phone" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Password<label class="text-danger">*</label></label>
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="passwd" id="passwd">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="input-group-text bg-white" id="basic-addon2" onclick="change_password_show_hide()">
                                            <i class="fas fa-eye" id="change_show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="change_hide_eye"></i>
                                        </label>
                                    </div>
                                </div>
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
                        <h6 class="font-weight-bold text-primary">Edit User</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <form class="update-form" role="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" class="id" id="id" />
                        <input type="hidden" name="status_edit" class="status-edit" id="status_edit" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Nama<label class="text-danger">*</label></label>
                                <input type="text" class="form-control name-edit" name="name_edit" id="name_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Email<label class="text-danger">*</label></label>
                                <input type="email" class="form-control email-edit" name="email_edit" id="email_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Role<label class="text-danger">*</label></label>
                                <select class="form-control role-edit" name="role_edit" id="role_edit">
                                    <option value="Admin">Admin</option>
                                    <option value="Peminjam">Peminjam</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Nomor Telepon<label class="text-danger">*</label></label>
                                <input type="text" class="form-control phone-edit" name="phone_edit" id="phone_edit">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Password</label>
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control password-edit" name="passwd_edit" id="passwd_edit">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="input-group-text bg-white" id="basic-addon2" onclick="edit_change_password_show_hide()">
                                            <i class="fas fa-eye" id="edit_change_show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="edit_change_hide_eye"></i>
                                        </label>
                                    </div>
                                </div>
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
                        <h6 class="font-weight-bold text-primary">Detail User</h6>
                    </div>
                </div>
                <div class="modal-body card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Nama</label>
                            <input type="text" readonly class="form-control name-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Email</label>
                            <input type="text" readonly class="form-control email-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Role</label>
                            <input type="text" readonly class="form-control role-detail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label font-weight-bold">Nomor Telepon</label>
                            <input type="text" readonly class="form-control phone-detail">
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
    const change_password_show_hide = function() {
        var x = document.getElementById("passwd");
        var show_eye = document.getElementById("change_show_eye");
        var hide_eye = document.getElementById("change_hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "text") {
            x.type = "password";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "text";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

    const edit_change_password_show_hide = function() {
        var x = document.getElementById("passwd_edit");
        var show_eye = document.getElementById("edit_change_show_eye");
        var hide_eye = document.getElementById("edit_change_hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "text") {
            x.type = "password";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "text";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

    $(document).ready(function () {
        $(".phone, .phone-edit").mask("000000000000000")

        $(".role").select2({
            placeholder: "Role",
            theme: "bootstrap-5"
        })

        $(".role-edit").select2({
            placeholder: "Role",
            theme: "bootstrap-5"
        })

        $(".create-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                    maxlength: 30
                },
                passwd: {
                    required: true,
                    minlength: 5,
                    maxlength: 30
                },
                email: {
                    email: true,
                    required: true
                },
                phone: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Nama Harus Diisi",
                    minlength: "Nama Minimal 4 Karakter",
                    maxlength: "Nama Maksimal 30 Karakter"
                },
                passwd: {
                    required: "Password Harus Diisi",
                    minlength: "Password Minimal 5 Karakter",
                    maxlength: "Password Maksimal 30 Karakter"
                },
                email: {
                    email: "Email Tidak Valid",
                    required: "Email Harus Diisi"
                },
                phone: {
                    required: "Nomor Telepon Harus Diisi"
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
            // errorPlacement: function(error, element) {
            //     if(element.parent('.form-control').length) {
            //         error.insertAfter(element.parent());
            //     } else {
            //         error.insertAfter(element);
            //     }
            // }
            // end add
        });

        var validator = $(".update-form").validate({
            rules: {
                name_edit: {
                    required: true,
                    minlength: 4,
                    maxlength: 30
                },
                email_edit: {
                    email: true,
                    required: true
                },
                phone_edit: {
                    required: true
                },
                passwd_edit: {
                    minlength: 5,
                    maxlength: 30
                }
            },
            messages: {
                name_edit: {
                    required: "Nama Harus Diisi",
                    minlength: "Nama Minimal 4 Karakter",
                    maxlength: "Nama Maksimal 30 Karakter"
                },
                email_edit: {
                    email: "Email Tidak Valid",
                    required: "Email Harus Diisi"
                },
                phone_edit: {
                    required: "Nomor Telepon Harus Diisi"
                },
                passwd_edit: {
                    minlength: "Password Minimal 5 Karakter",
                    maxlength: "Password Maksimal 30 Karakter"
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
                    data.search = $(".filter-search").val();
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
                data: "role",
                className: "text-center"
            }, {
                data: "email",
                className: "text-center"
            }, {
                data: "phone",
                className: "text-center"
            }, {
                data: "status",
                className: "text-center",
                render: function(data, type, row) {
                    return data === "ACTIVE" ? `<label class="text-success">ACTIVE</label>` : `<label class="text-danger">NOT ACTIVE</label>`
                }
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
                    return `
                    <div class="dropleft">
                        <button type="button" class="btn btn-link" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" style="box-shadow: 0px 2px 40px rgba(0, 0, 0, 0.2);">
                            <button class="dropdown-item view-detail" data-id="${row.id}" data-role="${row.role}" data-name="${row.name}" data-email="${row.email}" data-phone="${row.phone}"><strong>Lihat</strong></button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item delete-data" data-id="${row.id}" data-status="${row.status}"><strong>Ubah Status</strong></button>
                        </div>
                    </div>
                    `
                }
            }],
            language: {
                emptyTable: "Tidak Ada Data",
                lengthMenu: "Show _MENU_ entries",
                searchPlaceholder: "Cari Nama / Email / Telp"
            }
        });

        $(".dataTables_info").addClass("pt-0");

        $('.filter-search').on('keyup', function() {
            table.ajax.reload();
        })

        $('#dataTable tbody').on('click', 'tr td:not(.actions):not(.dataTables_empty)', function() {
            validator.resetForm();
            validator.reset();
            const data = table.row(this).data();
            $(".id").val(data.id)
            $(".status-edit").val(data.status_id)
            $(".role-edit").val(data.role)
            $(".name-edit").val(data.name)
            $(".email-edit").val(data.email)
            $(".phone-edit").val(data.phone)
            $("#editModal").modal()
        });

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
                        $.ajax({
                            url : "{{ url('user/create') }}",
                            type: "POST",
                            dataType: "json",
                            cache: false,
                            data: $(".create-form").serialize(),
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
                            url : "{{ url('user/update') }}" + "/" + id,
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
        })
    });   

    $(document).on('click', '.view-detail', function() {
        $(".name-detail").val($(this).data('name'))
        $(".role-detail").val($(this).data('role'))
        $(".email-detail").val($(this).data('email'))
        $(".phone-detail").val($(this).data('phone'))
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
                    url : "{{ url('user/update-status') }}",
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    data: {
                        "id": $(this).data('id'),
                        "status": $(this).data('status') === 'NOT ACTIVE' ? 2 : 3,
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