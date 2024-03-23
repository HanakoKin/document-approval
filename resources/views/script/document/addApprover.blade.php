<script>
    function addApproverInput() {
        var container = document.getElementById('approvers-container');
        var newIndex = container.children.length + 1;

        var newInput = document.createElement('div');
        newInput.innerHTML = '<label class="my-1">Approver ' + newIndex + '</label>' +
            '<select class="form-control" name="approvers[]">' +
            '<option value="" readonly>Pilih Approver ' + newIndex + '</option>' +
            '@foreach ($users as $user)' +
            '<option value="{{ $user->id }}">{{ $user->name }}</option>' +
            '@endforeach' +
            '</select>' +
            '<input type="hidden" name="approvers_queue[]" value="' + newIndex + '">' +
            '<button type="button" class="btn btn-danger btn-sm my-2" onclick="removeApproverInput(this)">Hapus</button>';

        container.appendChild(newInput);
    }

    // Fungsi untuk menghapus input approver
    function removeApproverInput(button) {
        button.parentNode.remove();
    }

    // Event listener untuk tombol "Tambah Approver"
    document.getElementById('add-approver-btn').addEventListener('click', function() {
        addApproverInput();
    });
</script>
