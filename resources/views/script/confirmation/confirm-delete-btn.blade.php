<script>
    document.querySelectorAll('.deleteBtn').forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function(event) {
            event.preventDefault();

            // Find the closest form to the delete button clicked
            var deleteForm = deleteBtn.closest('form');

            var data_target = deleteBtn.getAttribute('data-target') || '';

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this ' + data_target + '!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel please!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    deleteForm.submit();
                } else {
                    // Show a message if the deletion is canceled
                    Swal.fire('Cancelled', 'The ' + data_target + ' is safe :)', 'error');
                }
            });
        });
    });
</script>
