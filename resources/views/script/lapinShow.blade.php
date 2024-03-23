<script>
    function showLapinModal(lapin) {

        var title = "Data : " + lapin.nama;
        var unit = "Unit : " + lapin.unit_kerja;

        console.log(lapin.nama);

        $('#showTitle').text(title);
        $('#showUnit').text(unit);
        $('#namaTitle').text(lapin.nama);
        $('#noRMTitle').text(lapin.noRM);
        $('#lapinNama').text(": " + lapin.nama);
        $('#lapinNoRM').text(": " + lapin.noRM);
        $('#lapinRuangan').text(": " + lapin.ruangan);
        $('#lapinUmur').text(": " + lapin.umur);
        $('#lapinJenisKelamin').text(": " + lapin.jenis_kelamin);
        $('#lapinPenjamin').text(": " + lapin.penjamin);
        $('#lapinTanggalMasuk').text(": " + formatDate(lapin.tanggal_masuk));
        $('#lapinJamMasuk').text(": " + removeSeconds(lapin.jam_masuk));
        $('#lapinTanggalKejadian').text(": " + formatDate(lapin.tanggal_kejadian));
        $('#lapinJamKejadian').text(": " + removeSeconds(lapin.jam_kejadian));
        $('#lapinInsiden').text(": " + lapin.insiden);
        $('#lapinKronologis').text(": " + lapin.kronologis);
        $('#lapinJenisInsiden').text(": " + lapin.jenis_insiden);
        $('#lapinPelaporInsiden').text(": " + lapin.pelapor_insiden);
        $('#lapinKorbanInsiden').text(": " + lapin.korban_insiden);
        $('#lapinLayananInsiden').text(": " + lapin.layanan_insiden);
        $('#lapinTempatInsiden').text(": " + lapin.tempat_insiden);
        $('#lapinKasusInsiden').text(": " + lapin.kasus_insiden);
        $('#lapinUnitInsiden').text(": " + lapin.unit_insiden);
        $('#lapinDampakInsiden').text(": " + lapin.dampak_insiden);
        $('#lapinTindakanCepat').text(": " + lapin.tindakan_cepat);
        $('#lapinTindakanInsiden').text(": " + lapin.tindakan_insiden);
        $('#lapinKejadianInsiden').text(": " + lapin.kejadian_insiden);

        $('#lapinPembuatLaporan').text(": " + lapin.pembuat_laporan);
        $('#lapinParafPelapor').attr('src', lapin.paraf_pelapor);
        $('#showLapin').modal('show')

        function formatDate(dateString) {
            // Parse the date string
            var date = new Date(dateString);

            // Get the day, month, and year
            var day = date.getDate();
            var month = date.getMonth() + 1; // Month is zero-based, so we add 1
            var year = date.getFullYear();

            // Add leading zeros if necessary
            var formattedDay = day < 10 ? '0' + day : day;
            var formattedMonth = month < 10 ? '0' + month : month;

            // Construct the formatted date string
            var formattedDate = formattedDay + '-' + formattedMonth + '-' + year;

            return formattedDate;
        }

        function removeSeconds(timeString) {
            // Split waktu menjadi jam, menit, dan detik
            var splitTime = timeString.split(':');
            var hour = splitTime[0];
            var minute = splitTime[1];

            // Format waktu ke dalam format 'HH:mm' tanpa detik
            var formattedTime = hour + ':' + minute;

            return formattedTime;
        }

    }

</script>
