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
<script>
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