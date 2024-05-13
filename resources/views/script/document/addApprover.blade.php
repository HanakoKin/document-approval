<script>
    function addApproverInput() {
        var container = document.getElementById('approvers-container');
        var newIndex = container.children.length + 1;

        var newInput = document.createElement('div');
        newInput.innerHTML = '<label class="my-2">Approver ' + newIndex + '</label>' +
            '<select class="form-control select2" name="approvers[]">' +
            '<option value="" readonly>Pilih Approver ' + newIndex + '</option>' +
            '@foreach ($users as $user)' +
            '<option value="{{ $user->id }}">{{ $user->name }}</option>' +
            '@endforeach' +
            '</select>' +
            '<input type="hidden" name="approvers_queue[]" value="' + newIndex + '">' +
            '<button type="button" class="btn btn-danger btn-sm my-2" onclick="removeApproverInput(this)">Hapus</button>';

        container.appendChild(newInput);
        $(newInput).find('.select2').select2();
    }

    // Fungsi untuk menghapus input approver
    function removeApproverInput(button) {
        button.parentNode.remove();
    }

    // Event listener untuk tombol "Tambah Approver"
    document.getElementById('add-approver-btn').addEventListener('click', function() {
        addApproverInput();
    });

    // Initialize Dropzone manually for each input file element
    document.querySelectorAll('input[type="file"].dropzone').forEach(function(inputElement) {
        var dropzone = new Dropzone(inputElement, {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            addRemoveLinks: true // Allow removing files from the dropzone
        });
    });
</script>
