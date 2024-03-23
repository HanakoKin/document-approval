<script>
    window.addEventListener('beforeunload', function (e) {
        // Mendapatkan data status edit dari server dan mengubahnya menjadi false
        fetch('/{{ $kategori }}/reset-edit-status/{{ $data->id }}', {
                method: 'POST', // Atau 'PUT', 'PATCH', tergantung pada API Anda
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Jangan lupa sesuaikan dengan framework Anda
                },
            })
            .then(response => {
                // Handle response jika diperlukan
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

</script>
