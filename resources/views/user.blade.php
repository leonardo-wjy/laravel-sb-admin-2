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
                <h6 style="padding-top: 8px;" class="m-0 font-weight-bold text-primary float-sm-left">User</h6>
                <a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#createModal" ><i class="fas fa-plus">&nbsp;</i>Tambah</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>

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
<!-- /.container-fluid -->

<!-- Change Password Modal-->
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
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Nomor Telepon<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telp" id="telp">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label font-weight-bold">Password<span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="passwd" id="passwd">
                                    </div>
                                    <div class="col-md-3">
                                        <span class="input-group-text bg-white" id="basic-addon2" onclick="change_password_show_hide()">
                                            <i class="fas fa-eye" id="change_show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="change_hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Batal</button>
                    <button type="button" class="btn btn-primary btn-submit-form">Simpan</button>
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

    // Call the dataTables jQuery plugin
    $(document).ready(function () {

        $('#tbl_list').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'f>>t<'row align-items-start'<'col-md-4'l><'col-md-4 text-center'i><'col-md-4'p>>",
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: '{{ url()->current() }}',
            responsive: true,
            display: "stripe",
            columnDefs: [{
                defaultContent: "-",
                targets: "_all"
            }],
            columns: [{
                data: "id",
                className: "text-center actions"
            }, {
                data: "name",
                className: "text-center"
            }, {
                data: "email",
                className: "text-center"
            }],
            language: {
                emptyTable: "Tidak Ada Data",
                lengthMenu: "Show _MENU_ entries",
                searchPlaceholder: "Cari Username / Nama"
            }
        });
    });
</script>

@include('footer')