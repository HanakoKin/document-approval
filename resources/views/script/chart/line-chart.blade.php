<script>
    var currentYear = new Date().getFullYear();

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
            const category = ['Documents', 'Memos'];
            return category.slice(0, count);
        }
    };

    const monthLabels = Utils.months({
        count: 12
    });

    const yearlyData = {
        labels: monthLabels,
        datasets: [{
                label: "Documents",
                backgroundColor: 'rgba(154, 208, 245, 0.5)',
                borderColor: '#6BBBF0',
                data: [42, 17, 93, 65, 28, 11, 74, 55, 39, 82, 6, 20],
                stack: 'Stack 0',
            },
            {
                label: "Memos",
                backgroundColor: 'rgba(165, 221, 155, 0.5)',
                borderColor: '#99BC85',
                data: [78, 25, 91, 14, 63, 47, 32, 69, 5, 83, 29, 58],
                stack: 'Stack 1',
            }
        ]
    };

    const configLine = {
        type: 'line',
        data: yearlyData,
        options: {
            title: {
                display: true,
                text: 'My Dateset'
            }
        }
    };

    const updateYearlyChart = (year) => {
        document.getElementById('yearDisplay').textContent = `Tahun ${year}`;

        fetch(`/chart-data/${year}`)
            .then(response => response.json())
            .then(newData => {

                const hasilRandom = Array.from({
                    length: 12
                }, () => Math.floor(Math.random() * 10) + 1);

                const Documents = newData.dataDocuments;
                const Memos = newData.dataMemos;

                const jumlahDocuments = Documents.map((item) => item.data.length);
                const jumlahMemos = Memos.map((item) => item.data.length);

                // lineChart.data.datasets[0].data = jumlahDocuments;
                // lineChart.data.datasets[1].data = jumlahMemos;

                lineChart.update();

            });
    };

    // Mengatur data bulanan
    const categoryLabels = Utils.category({
        count: 3
    });

    const ctx = document.getElementById('line-chart1');
    lineChart = new Chart(ctx, configLine);
    updateYearlyChart(currentYear);

    document.getElementById('prevBtn').addEventListener('click', function() {
        currentYear = currentYear - 1;
        updateYearlyChart(currentYear);
    });

    document.getElementById('nextBtn').addEventListener('click', function() {
        currentYear = currentYear + 1;
        updateYearlyChart(currentYear);
    });
</script>
