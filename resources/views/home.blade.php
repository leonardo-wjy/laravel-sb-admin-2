@include('header')

<div class="row mb-3">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah Peminjaman Buku</h6>
            </div>
            <div class="card-body d-flex justify-content-center">
                <canvas class="bar-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 style="padding-top: 8px;" class="m-0 font-weight-bold text-primary float-sm-left">Daftar Peminjaman Buku (Maksimal Hari Ini)</h6>
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
                        <th>Email Peminjam</th>
                        <th>Telepon Peminjam</th>
                        <th>Batas Pengembalian</th>
                        <th>Tanggal Peminjaman</th>
                    </tr>
                </thead>
                <tbody style="cursor: pointer;">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        // Call the dataTables jQuery plugin
        const table = $('#dataTable').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'f>>t<'row align-items-start'<'col-md-4'l><'col-md-4 text-center'i><'col-md-4'p>>",
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: '{{ url()->current() }}',
                dataSrc: "data",
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
                data: "email",
                className: "text-center"
            }, {
                data: "phone",
                className: "text-center"
            }, {
                data: "batas_pengembalian",
                className: "text-center"
            }, {
                data: "createdAt",
                className: "text-center"
            }],
            language: {
                emptyTable: "Tidak Ada Data",
                lengthMenu: "Show _MENU_ entries",
                searchPlaceholder: ""
            }
        });

        $(".dataTables_info").addClass("pt-0");

        let arr_count = [];
        let arr_name = [];
        let data = <?= $count ? $count : [] ?>;

        //get date today
        var dt = new Date();

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        data.forEach((value) => {
            arr_count.push(value.count);
            arr_name.push(value.name);
        })

        const bar = document.querySelector('.bar-chart');

        const barChart = new Chart(bar, {
            plugins: [ChartDataLabels],
            type: 'bar',
            data: {
                labels: arr_name,
                datasets: [{
                    label: monthNames[(dt.getMonth())] + " " + dt.getFullYear(),
                    backgroundColor: "green",
                    data: arr_count
                }]
            },
            options: {
                legend: {
                    labels: {
                        fontColor: "white",
                        fontSize: 18
                    }
                }
            }
        });
    })
</script>



@include('footer')

      