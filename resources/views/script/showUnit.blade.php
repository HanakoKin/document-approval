<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen select role
        var roleSelect = document.getElementById('roleSelector');

        var unitInput = document.getElementById('unit');

        // Ambil elemen form group untuk unit
        var unitFormGroup = document.getElementById('unitsChoice');

        // Tambahkan event listener untuk perubahan pada select role
        roleSelect.addEventListener('change', function (event) {
            // Periksa apakah role yang dipilih adalah "user"
            if (event.target.value === 'user') {
                // Tampilkan form group untuk unit
                unitFormGroup.classList.remove('d-none');
                // unitInput.required = true;
                console.log(unitInput)

            } else {
                // Sembunyikan form group untuk unit
                unitInput.value = '';
                // unitInput.required = false;

                console.log(unitInput.value)

                unitFormGroup.classList.add('d-none');

            }
        });
    });

</script>
