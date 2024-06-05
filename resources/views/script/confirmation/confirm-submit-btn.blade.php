<script>
    document.querySelectorAll('.submitBtn').forEach(function(submitBtn) {
        submitBtn.addEventListener('click', function(event) {
            event.preventDefault();

            // Find the closest form to the submit button clicked
            var submitForm = submitBtn.closest('form');

            var data_target = submitBtn.getAttribute('data-target') || '';

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to add new disposition after published!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'A1DD70',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, I want add something!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    submitForm.submit();
                } else {
                    // Show a message if the deletion is canceled
                    Swal.fire('Cancelled', 'Document is not published!', 'error');
                }
            });
        });
    });
</script>
