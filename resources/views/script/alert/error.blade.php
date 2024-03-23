<script>
    $(document).ready(function () {
        // Trigger SweetAlert success popup if session flash data exists
        Swal.fire({
            title: 'Oops...',
            text: '{{ session("error") }}',
            icon: 'error',
        });
    });

</script>
