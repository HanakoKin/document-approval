<script>
    /* Fungsi untuk menampilkan pilihan sebelumnya (khusus select) */
    function setRadioButtonCheckedByName(name, value) {
        $(`input[name="${name}"]`).each(function () {
            if ($(this).val() === value) {
                $(this).prop('checked', true);
            }
        });
    }

    // Example usage with the provided HTML structure
    var decodedUmur = decodeEntities("{{ $data->umur }}");
    setRadioButtonCheckedByName('umur', decodedUmur);

    function decodeEntities(encodedString) {
        var textarea = document.createElement('textarea');
        textarea.innerHTML = encodedString;
        return textarea.value;
    }

    /* Untuk menampilkan inputan user di radio button yang memiliki custom input */
    function displayCustomInputRadio() {

        // Dapatkan elemen radio button
        let radio_pelapor_lain = document.getElementById("pelIn5");
        let radio_layanan_lain = document.getElementById("layIn4");
        let radio_kasus_lain = document.getElementById("insiden14");
        let radio_korban_lain = document.getElementById("korIn2");
        let radio_tindakan_tim = document.getElementById("tinIn1");
        let radio_tindakan_lain = document.getElementById("tinIn4");
        let radio_pernah_terjadi = document.getElementById("pernah1");

        // Dapatkan elemen input text
        let input_pelapor_lain = document.getElementById("pelapor_lain");
        let input_layanan_lain = document.getElementById("layanan_lain");
        let input_kasus_lain = document.getElementById("kasus_lain");
        let input_korban_lain = document.getElementById("korban_lain");
        let input_tindakan_tim = document.getElementById("tindakan_tim");
        let input_tindakan_lain = document.getElementById("tindakan_lain");
        let input_kejadian_insiden = document.getElementById("kejadian_insiden");
        let input_anggota_tim = document.getElementById("anggota_tim");
        let input_ket_pernah = document.getElementById("ket_pernah");
        let input_des_pernah = document.getElementById("des_pernah");

        // Ambil data yang akan diubah kalimatnya
        let data_kejadian_insiden = "{{ $data->kejadian_insiden }}";
        let data_tindakan_insiden = "{{ $data->tindakan_insiden }}";
        let data_kasus_insiden = "{{ $data->kasus_insiden }}";

        // Ubah ke array
        let kasusInsidenArray = data_kasus_insiden.split(', ');
        let ignoredValues = ["Penyakit Dalam dan Subspesialisasinya", "Anak dan Subspesialisasinya",
            "Bedah dan Subspesialisasinya", "Obstetri Gynekologi dan Subspesialisasinya",
            "THT dan Subspesialisasinya", "Mata dan Subspesialisasinya", "Saraf dan Subspesialisasinya",
            "Anastesi dan Subspesialisasinya", "Kulit &amp; Kelamin dan Subspesialisasinya",
            "Jantung dan Subspesialisasinya", "Paru dan Subspesialisasinya", "Jiwa dan Subspesialisasinya"
        ];

        // Mencari yang tidak ada di dalam array (asumsikan mencari inputan user)
        let filteredArray = kasusInsidenArray.filter(function (value) {
            return !ignoredValues.includes(value);
        });

        // Ubah kalimat pada data
        let fixed_ket_tindakan_tim = data_tindakan_insiden.replace("Tim, yang terdiri dari ", "");
        let fixed_ket_kejadian_insiden = data_kejadian_insiden.replace("Ya, terjadi pada ", "")

        // Tampilkan textarea yang hidden
        let textarea_pernah = document.getElementById("textarea_pernah");

        if (radio_pelapor_lain.checked) {
            input_pelapor_lain.value = "{{ $data->pelapor_insiden }}";
            radio_pelapor_lain.value = "{{ $data->pelapor_insiden }}"
        }

        if (radio_layanan_lain.checked) {
            input_layanan_lain.value = "{{ $data->layanan_insiden }}";
            radio_layanan_lain.value = "{{ $data->layanan_insiden }}";
        }

        if (radio_kasus_lain.checked) {
            input_kasus_lain.value = filteredArray;
            radio_kasus_lain.value = filteredArray;
        }

        if (radio_korban_lain.checked) {
            input_korban_lain.value = "{{ $data->korban_insiden }}";
            radio_korban_lain.value = "{{ $data->korban_insiden }}";
        }

        if (radio_tindakan_tim.checked) {
            input_tindakan_tim.value = fixed_ket_tindakan_tim;
            input_anggota_tim.value = fixed_ket_tindakan_tim;
        }

        if (radio_tindakan_lain.checked) {
            input_tindakan_lain.value = "{{ $data->tindakan_insiden }}";
            radio_tindakan_lain.value = "{{ $data->tindakan_insiden }}";
        }

        if (radio_pernah_terjadi.checked) {
            textarea_pernah.classList.remove("d-none");
            input_ket_pernah.textContent = fixed_ket_kejadian_insiden;
            input_des_pernah.value = fixed_ket_kejadian_insiden;
        } else if (!radio_pernah_terjadi.checked) {
            textarea_pernah.classList.add("d-none");
        }

    }

    /* Manjalankan fungsi ketika halaman diakses */
    document.addEventListener("DOMContentLoaded", function () {
        displayCustomInputRadio();
    });

</script>
