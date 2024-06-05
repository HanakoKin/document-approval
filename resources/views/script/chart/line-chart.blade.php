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
                data: [],
                // data: [42, 17, 93, 65, 28, 11, 74, 55, 39, 82, 6, 20],
                stack: 'Stack 0',
            },
            {
                label: "Memos",
                backgroundColor: 'rgba(165, 221, 155, 0.5)',
                borderColor: '#99BC85',
                data: [],
                // data: [78, 25, 91, 14, 63, 47, 32, 69, 5, 83, 29, 58],
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

                // console.log(newData);

                const hasilRandom = Array.from({
                    length: 12
                }, () => Math.floor(Math.random() * 10) + 1);

                const Documents = newData.dataDocuments;
                const Memos = newData.dataMemos;

                const jumlahDocuments = Documents.map((item) => item.data.length);
                const jumlahMemos = Memos.map((item) => item.data.length);

                lineChart.data.datasets[0].data = jumlahDocuments;
                lineChart.data.datasets[1].data = jumlahMemos;

                lineChart.update();

            });
    };

    // Mengatur data bulanan
    const categoryLabels = Utils.category({
        count: 3
    });

    const updateShortcutValue = (year) => {
        document.getElementById('yearDisplay').textContent = `Tahun ${year}`;

        fetch(`/shortcut-data/${year}`)
            .then(response => response.json())
            .then(newData => {

                console.log(newData);

                document.getElementById('memo_received').textContent = newData.memos_received.length;
                document.getElementById('memo_sent').textContent = newData.memos_sent.length;
                document.getElementById('documents_approved').textContent = newData.documents_approved.length;
                document.getElementById('documents_pending').textContent = newData.documents_pending.length;
                document.getElementById('documents_need_approval').textContent = newData.documents_need_approval
                    .length;
                document.getElementById('documents_received').textContent = newData.documents_received.length;

            });
    };

    const ctx = document.getElementById('line-chart1');
    lineChart = new Chart(ctx, configLine);
    updateYearlyChart(currentYear);
    updateShortcutValue(currentYear);
    const types = {
        'memo': ['receive', 'sent'],
        'document': ['approved', 'pending', 'approval', 'received']
    };

    const array = ['memo', 'document'];

    function updateLinks(year) {
        updateYearlyChart(year);
        updateShortcutValue(year);

        const newHrefArr = [];

        array.forEach(type => {
            if (types[type]) {
                types[type].forEach(category => {
                    const newHref =
                        `{{ route('shortcut', ['type' => 'TYPE', 'category' => 'CATEGORY', 'year' => 'YEAR_PLACEHOLDER']) }}`
                        .replace('TYPE', type)
                        .replace('CATEGORY', category)
                        .replace('YEAR_PLACEHOLDER', year);
                    newHrefArr.push(newHref);
                });
            }
        });

        document.getElementById('mr_link').setAttribute('href', newHrefArr[0]);
        document.getElementById('ms_link').setAttribute('href', newHrefArr[1]);
        document.getElementById('da_link').setAttribute('href', newHrefArr[2]);
        document.getElementById('dp_link').setAttribute('href', newHrefArr[3]);
        document.getElementById('dna_link').setAttribute('href', newHrefArr[4]);
        document.getElementById('dr_link').setAttribute('href', newHrefArr[5]);

        console.log(newHrefArr);
    }

    document.getElementById('prevBtn').addEventListener('click', function() {
        currentYear = currentYear - 1;

        updateYearlyChart(currentYear);
        updateShortcutValue(currentYear);
        updateLinks(currentYear);
    });

    document.getElementById('nextBtn').addEventListener('click', function() {
        currentYear = currentYear + 1;

        updateYearlyChart(currentYear);
        updateShortcutValue(currentYear);
        updateLinks(currentYear);

    });
</script>
