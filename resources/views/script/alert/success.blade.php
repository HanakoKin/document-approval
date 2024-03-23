<script>
    $(document).ready(function () {
        // Trigger SweetAlert success popup if session flash data exists
        Swal.fire({
            title: 'Good job!',
            text: '{{ session("success") }}',
            icon: 'success',
        });
    });

</script>
