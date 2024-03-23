<script>
    $(document).ready(function () {
        // Menentukan jumlah formulir yang sudah ada dari data database
        var existingFormsCount = $("textarea[name='catatan[]']").length;

        window.removeCatatanRow = function (index) {
            $("#catatanRow" + index).remove();
        };

        window.removeTanggalRow = function (index) {
            $("#tanggalRow" + index).remove();
        };

        window.removeNarasumberRow = function (index) {
            $("#narasumberRow" + index).remove();
        };

        // Ketika tombol "Tambah Input" ditekan
        $("#addInput").click(function () {
            // Hitung jumlah input yang sudah ada
            var inputCount = $("textarea[name='catatan[]']").length + 1;

            // Tambahkan input textarea baru
            var textareaHtml = `
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group" id="catatanRow${inputCount}">
                            <label for="textarea${inputCount}">Catatan ${inputCount}:</label>
                            <textarea rows="5" class="form-control" id="textarea${inputCount}" name="catatan[]" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="form-group" id="tanggalRow${inputCount}">
                                <label for="date${inputCount}">Tanggal untuk Catatan ${inputCount}:</label>
                                <input type="date" class="form-control" id="date${inputCount}" name="tanggal_catatan[]" required>
                            </div>
                            <div class="form-group" id="narasumberRow${inputCount}">
                                <label for="narasumber${inputCount}">Narasumber untuk Catatan ${inputCount}:</label>
                                <input type="text" class="form-control" id="narasumber${inputCount}" name="narasumber[]" required>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            // Tambahkan input ke dalam dynamicInputs
            $("#dynamicInputs").append(textareaHtml);

            console.log(dynamicInputs.length);

        });

        // Ketika tombol "Kurangi Input" ditekan
        $("#removeInput").click(function () {
            var dynamicInputs = $("#dynamicInputs").children();

            if (dynamicInputs.length < 1) {
                var lastCatatanIndex = $("textarea[name='catatan[]']").length - 1;
                console.log(lastCatatanIndex);
                window.removeCatatanRow(lastCatatanIndex);

                var lastTanggalIndex = $("input[name='tanggal_catatan[]']").length - 1;
                console.log(lastTanggalIndex);
                window.removeTanggalRow(lastTanggalIndex);

                var lastNarasumberIndex = $("input[name='narasumber[]']").length - 1;
                console.log(lastNarasumberIndex);
                window.removeNarasumberRow(lastNarasumberIndex);
            }

            // Hapus satu elemen terakhir dari div dengan id "dynamicInputs"
            dynamicInputs.last().remove();
        });



    });

</script>
