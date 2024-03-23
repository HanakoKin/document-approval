<script>
    function showLapkpcModal(lapkpc) {

        var title = "Data id : " + lapkpc.id

        console.log(lapkpc)

        $('#showTitle').text(title);
        $('#lapkpc').text(": " + lapkpc.kpc);
        $('#lapkpcTanggalDitemukan').text(": " + formatDate(lapkpc.tanggal_ditemukan));
        $('#lapkpcJamDitemukan').text(": " + removeSeconds(lapkpc.jam_ditemukan));
        $('#lapkpcPelaporInsiden').text(": " + lapkpc.pelapor_insiden);
        $('#lapkpcTempatInsiden').text(": " + lapkpc.tempat_insiden);
        $('#lapkpcUnitInsiden').text(": " + lapkpc.unit_insiden);
        $('#lapkpcTindakanCepat').text(": " + lapkpc.tindakan_cepat);
        $('#lapkpcTindakanInsiden').text(": " + lapkpc.tindakan_insiden);
        $('#lapkpcKejadianInsiden').text(": " + lapkpc.kejadian_insiden);

        $('#lapkpcPembuatLaporan').text(": " + lapkpc.pembuat_laporan);
        $('#lapkpcParafPelapor').attr('src', lapkpc.paraf_pelapor);

        $('#showLapkpc').modal('show')

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
