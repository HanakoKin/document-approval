<script>
    function validasiForm() {
        var checkboxes = document.getElementsByName("kasus_insiden[]");
        var isChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert("Pilih minimal satu opsi sebelum mengirimkan formulir.");
            return false;
        }

        return true;
    }

    /* Untuk mengHIGHLIGHT pilihan user sebelumnya */
    function selectRadio(radioId) {
        var radio = document.getElementById(radioId);
        radio.checked = true;
    }

    /* Untuk membuat radio button terpilih ketika user melakukan custom input */
    function syncInputRadio(radioId, inputId) {
        var radio = document.getElementById(radioId);
        var input = document.getElementById(inputId);

        console.log(radio.value)

        if (input.value.trim() !== "") {
            radio.value = input.value;
            radio.checked = true;
        } else {
            radio.value = "";
            radio.checked = false;
        }

    }

    /* Untuk membuat radio button terpilih ketika user melakukan custom input */
    function syncInputRadioSpecial(radioId, hiddenInputId, textInputId) {
        var radio = document.getElementById(radioId);
        var hiddenInput = document.getElementById(hiddenInputId);
        var textInput = document.getElementById(textInputId);

        var existingData = textInput.value.trim();

        console.log(existingData)

        if (radio.checked && radio.value === "Ya") {
            hiddenInput.value = "Ya, terjadi pada " + textInput.value;
        } else {
            hiddenInput.value = "Tim, yang terdiri dari " + textInput.value;
        }
    }

    /* Menampilkan textarea sesuai trigger */
    function showTextarea(textareaId) {
        var textarea = document.getElementById(textareaId);
        // Menggunakan kelas Bootstrap untuk menampilkan elemen
        textarea.classList.remove("d-none");
    }

    /* Menghilangkan textarea sesuai trigger */
    function hideTextarea(textareaId) {
        var textarea = document.getElementById(textareaId);
        // Menggunakan kelas Bootstrap untuk menyembunyikan elemen
        textarea.classList.add("d-none");
    }

</script>
