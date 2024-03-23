<script>
    document.addEventListener('DOMContentLoaded', function () {
        var formUnit = document.getElementById('unitsChoice');
        var role =  "{{ $data->role }}";

        if(role === 'user'){
            formUnit.classList.remove('d-none');
        }

        console.log("{{ $data->unit }}")

    })

</script>
