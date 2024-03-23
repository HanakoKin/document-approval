<script>
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1;
    var isYearlyView = true;

    const Utils = {
        months: ({
            count
        }) => {
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember'
            ];

            return months.slice(0, count);
        },
        category: ({
            count
        }) => {
            const category = ['KPCS', 'KNC', 'KTC', 'KTD', 'Sentinel'];
            return category.slice(0, count);
        }
    };

    /* SWITCH */
    document.addEventListener('DOMContentLoaded', function () {
        const barSwitch = document.getElementById('barSwitch');
        // const firstState = barSwitch.classList.contains('active');

        // Mengatur data tahunan
        const monthLabels = Utils.months({
            count: 12
        });

        const yearlyData = {
            labels: monthLabels,
            datasets: [{
                    label: "KPCS",
                    backgroundColor: 'rgba(154, 208, 245, 0.5)',
                    borderColor: '#6BBBF0',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "KNC",
                    backgroundColor: 'rgba(165, 221, 155, 0.5)',
                    borderColor: '#99BC85',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "KTC",
                    backgroundColor: 'rgba(246, 241, 147, 0.5)',
                    borderColor: '#EEC759',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "KTD",
                    backgroundColor: 'rgba(255, 207, 129, 0.5)',
                    borderColor: '#F9B572',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "Sentinel",
                    backgroundColor: 'rgba(255, 160, 180, 0.5)',
                    borderColor: '#FF9BB0',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "My Second dataset",
                    backgroundColor: "rgba(172, 135, 197, 0.5)",
                    borderColor: "#756AB6",
                    data: [],
                    stack: 'Stack 0',
                }
            ]
        };

        const configX = {
            type: 'bar',
            data: yearlyData,
            options: {
                indexAxis: 'y',
                responsive: true,
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    },
                },
                borderRadius: 3,
                borderWidth: 2,
            },
        }

        const updateYearlyChart = (year) => {
            // Memperbarui tahun dan mengambil data baru

            document.getElementById('yearDisplay').textContent = `Tahun ${year}`;
            document.getElementById('monthDisplay').textContent = '';

            fetch(`/chart-data/${year}`)
                .then(response => response.json())
                .then(newData => {

                    console.log(newData)

                    const hasilRandom = Array.from({
                        length: 12
                    }, () => Math.floor(Math.random() * 10) + 1);

                    // Mengambil data KNC, KTC, KTD, dan KPC dari response
                    const KPC = newData.dataKPC;
                    const KNC = newData.dataKNC;
                    const KTC = newData.dataKTC;
                    const KTD = newData.dataKTD;
                    const Sentinel = newData.dataSentinel;

                    // console.log(KPC)

                    const jumlahKPC = KPC.map((item) => item.data.length);
                    const jumlahKNC = KNC.map((item) => item.data.length);
                    const jumlahKTC = KTC.map((item) => item.data.length);
                    const jumlahKTD = KTD.map((item) => item.data.length);
                    const jumlahSentinel = Sentinel.map((item) => item.data.length);

                    // Memperbarui data chart
                    myChart.data.datasets[0].data = jumlahKPC;
                    myChart.data.datasets[1].data = jumlahKNC;
                    myChart.data.datasets[2].data = jumlahKTC;
                    myChart.data.datasets[3].data = jumlahKTD;
                    myChart.data.datasets[4].data = jumlahSentinel;
                    myChart.data.datasets[5].data = hasilRandom;

                    myChart.update();

                });
        };

        // Mengatur data bulanan
        const categoryLabels = Utils.category({
            count: 5
        });

        const monthlyData = {
            labels: categoryLabels,
            datasets: [{
                    label: "KPCS",
                    backgroundColor: 'rgba(154, 208, 245, 0.5)',
                    borderColor: '#6BBBF0',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "KNC",
                    backgroundColor: 'rgba(165, 221, 155, 0.5)',
                    borderColor: '#99BC85',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "KTC",
                    backgroundColor: 'rgba(246, 241, 147, 0.5)',
                    borderColor: '#EEC759',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "KTD",
                    backgroundColor: 'rgba(255, 207, 129, 0.5)',
                    borderColor: '#F9B572',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "Sentinel",
                    backgroundColor: 'rgba(255, 160, 180, 0.5)',
                    borderColor: '#FF9BB0',
                    data: [],
                    stack: 'Stack 0',
                },
                {
                    label: "My Second dataset",
                    backgroundColor: "rgba(172, 135, 197, 0.5)",
                    borderColor: "#756AB6",
                    data: [],
                    stack: 'Stack 0',
                }
            ]
        };

        var configY = {
            type: 'bar',
            data: monthlyData,
            options: {
                indexAxis: 'x',
                responsive: true,
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    },
                },
                borderRadius: 3,
                borderWidth: 2,
            },
        };

        const updateMonthlyChart = (year, month) => {
            // Memperbarui tahun dan mengambil data baru

            document.getElementById('yearDisplay').textContent = `Tahun ${year}`;
            document.getElementById('monthDisplay').textContent =
                `Bulan ${Utils.months({ count: 12 })[month - 1]}`;

            fetch(`/chart-data/${year}/${month}`)
                .then(response => response.json())
                .then(newData => {

                    const finalData = newData.data;

                    const hasilRandom2 = Array.from({
                        length: 6
                    }, () => Math.floor(Math.random() * 10) + 1);

                    const KPC = finalData.map((item) => item.data[0]);
                    const KNC = finalData.map((item) => item.data[1]);
                    const KTC = finalData.map((item) => item.data[2]);
                    const KTD = finalData.map((item) => item.data[3]);
                    const Sentinel = finalData.map((item) => item.data[4]);

                    // Memperbarui data chart
                    myChart.data.datasets[0].data = KPC;
                    myChart.data.datasets[1].data = KNC;
                    myChart.data.datasets[2].data = KTC;
                    myChart.data.datasets[3].data = KTD;
                    myChart.data.datasets[4].data = Sentinel;
                    myChart.data.datasets[5].data = hasilRandom2;

                    myChart.update();

                });
        };

        const ctx = document.getElementById('myChart');
        myChart = new Chart(ctx, configX);
        updateYearlyChart(currentYear);

        // Tambahkan event listener untuk menanggapi perubahan status tombol
        barSwitch.addEventListener('click', function () {
            // Periksa apakah tombol dalam keadaan aktif atau tidak
            var isActive = barSwitch.classList.contains('active');

            if (!isActive) {

                isYearlyView = false;

                document.getElementById('prevBtn').innerHTML =
                    '<i class="fas fa-caret-circle-left"></i> Previous Month';
                document.getElementById('nextBtn').innerHTML =
                    'Next Month <i class="fas fa-caret-circle-right"></i>';

                myChart.destroy();
                const ctx = document.getElementById('myChart');
                myChart = new Chart(ctx, configY);
                // myChart.update();
                updateMonthlyChart(currentYear, currentMonth);

            } else {

                isYearlyView = true;

                document.getElementById('prevBtn').innerHTML =
                    '<i class="fas fa-caret-circle-left"></i> Previous Year';
                document.getElementById('nextBtn').innerHTML =
                    'Next Year <i class="fas fa-caret-circle-right"></i>';

                myChart.destroy();
                const ctx = document.getElementById('myChart');
                myChart = new Chart(ctx, configX);
                updateYearlyChart(currentYear);

            }
        });

        document.getElementById('prevBtn').addEventListener('click', function () {
            if (isYearlyView) {
                currentYear = currentYear - 1;
                updateYearlyChart(currentYear);
                console.log(isYearlyView);
                console.log(currentMonth);
                console.log(currentYear);

            } else {
                currentMonth = (currentMonth - 1) <= 0 ? 12 : currentMonth - 1;
                if (currentMonth === 12) {
                    currentYear = currentYear - 1;
                }
                updateMonthlyChart(currentYear, currentMonth);
                console.log(isYearlyView);
                console.log(currentMonth);
                console.log(currentYear);
            }
        });

        document.getElementById('nextBtn').addEventListener('click', function () {
            if (isYearlyView) {
                currentYear = currentYear + 1;
                console.log(isYearlyView);
                updateYearlyChart(currentYear);
                console.log(currentMonth);
                console.log(currentYear);
            } else {
                currentMonth = (currentMonth + 1) > 12 ? 1 : currentMonth + 1;
                if (currentMonth === 1) {
                    currentYear = currentYear + 1;
                }
                updateMonthlyChart(currentYear, currentMonth);
                console.log(isYearlyView);
                console.log(currentMonth);
                console.log(currentYear);
            }
        });

        console.log(currentMonth);
        console.log(currentYear);


    });

</script>
