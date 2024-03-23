<script>
    document.getElementById('noRMLap').addEventListener('change', function () {

        var noRM = this.value;

        console.log(noRM)

        fetch('http://10.1.10.7:6070/BipubApi/api/Token', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'ConsId': 'husadati@gmail.com',
                'SecretKey': 'husadaTI.123',
            }
        }).then(tokenResponse => {
            if (tokenResponse.status === 401) {
                throw new Error('Unauthorized: Failed to generate token');
            }

            return tokenResponse.text();

        }).then(tokenData => {

            fetch('/search-patient', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Authorization': 'Bearer ' + tokenData,
                    },
                    body: JSON.stringify({
                        noRM: noRM,
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(informasiPasien => {

                    console.log(informasiPasien)

                    // Isi formulir dengan data yang diterima
                    document.getElementById('naLap').value = informasiPasien.pasienName || '';

                    document.getElementById('talah').value = informasiPasien.birthDate || '';

                    // Ceklist radiobox
                    if (informasiPasien.gender === 'Laki-laki' || informasiPasien.gender ===
                        'Male') {
                        document.getElementById('jekel1').checked = true;
                    } else if (informasiPasien.gender === 'Perempuan' || informasiPasien
                        .gender === 'Female') {
                        document.getElementById('jekel2').checked = true;
                    }

                    const umurMap = {
                        'umur1': 'umur1',
                        'umur2': 'umur2',
                        'umur3': 'umur3',
                        'umur4': 'umur4',
                        'umur5': 'umur5',
                        'umur6': 'umur6',
                        'umur7': 'umur7'
                    };

                    if (informasiPasien.umur && umurMap[informasiPasien.umur]) {
                        document.getElementById(umurMap[informasiPasien.umur]).checked = true;
                    }

                    // const penjaminMap = {
                    //     'Pribadi': 'penjamin1',
                    //     'Pemerintah': 'penjamin2',
                    //     'BPJS': 'penjamin3',
                    //     'Asuransi Swasta': 'penjamin4',
                    //     'Perusahaan': 'penjamin5',
                    //     'Lain-lain': 'penjamin6'
                    // }

                    // if (informasiPasien.penjamin && penjaminMap[informasiPasien.penjamin]) {
                    //     document.getElementById(penjaminMap[informasiPasien.penjamin]).checked =
                    //         true;
                    // }

                    document.getElementById('penjamin').value = informasiPasien.penjamin || '';

                    // Lanjutkan mengisi formulir tanggal & jam
                    document.getElementById('tamas').value = informasiPasien.regDate || '';
                    document.getElementById('jamas').value = informasiPasien.regTime || '';
                })
                .catch(error => {
                    console.error('There was an error!', error);

                    document.getElementById('naLap').value = 'Data pasien tidak ditemukan';
                    document.getElementById('ruLap').value = 'Data pasien tidak ditemukan';

                    document.getElementsByName('jenis_kelamin').forEach(radioButton => {
                        radioButton.checked = false;
                    });

                    document.getElementsByName('umur').forEach(radioButton => {
                        radioButton.checked = false;
                    });

                    document.getElementsByName('penjamin').forEach(radioButton => {
                        radioButton.checked = false;
                    });

                    document.getElementById('tamas').value = '';
                    document.getElementById('jamas').value = '';

                });

        })
    });

</script>
