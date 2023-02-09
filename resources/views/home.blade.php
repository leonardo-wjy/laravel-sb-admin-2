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

<script>

    $(document).ready(function() {
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
                    label: data.length === 0 ? "" : monthNames[(dt.getMonth())] + " " + dt.getFullYear(),
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
                },
            }
        });
    })
</script>



@include('footer')

      