<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    /* UNTUK MENAMPILKAN / MENYEMBUNYIKAN CANVAS */

    function showSignature() {
        document.querySelector('.signature').classList.remove('d-none');
        removeHiddenInput();
    }

    function hideSignature() {
        // Hapus nilai dari canvas menggunakan signaturePad
        signaturePad.clear();

        document.querySelector('.signature').classList.add('d-none');

        addHiddenInput();

        // Hapus nilai dari elemen textarea
        document.getElementById('signature64').value = '';

    }

    var kategori = '{{ $kategori }}'

    console.log(kategori === 'lemkis')

    function addHiddenInput() {
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        if(kategori === 'lemkis'){
            hiddenInput.name = 'ttd_pelengkap';
            hiddenInput.value = '{{ $data->ttd_pelengkap }}';
        } else {
            hiddenInput.name = 'paraf_pelapor';
            hiddenInput.value = '{{ $data->paraf_pelapor }}';
        }
        hiddenInput.id = 'hiddenInputId';
        document.getElementById('formId').appendChild(hiddenInput);

        console.log(hiddenInput.name);
        console.log(hiddenInput.value);

    }

    function removeHiddenInput() {
        var hiddenInput = document.getElementById('hiddenInputId');
        if (hiddenInput) {
            hiddenInput.parentNode.removeChild(hiddenInput);
        }
    }

    document.getElementById('new-signature').addEventListener('click', function () {
        showSignature();
    });

    document.getElementById('old-signature').addEventListener('click', function () {
        hideSignature();
    });

    /* UNTUK CANVAS */

    var canvas = document.getElementById('signature-pad');

    var signatureElement = document.querySelector('.signature');

    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.

    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio = Math.max(window.devicePixelRatio || 1, 1);

        if (signatureElement && !signatureElement.classList.contains('d-none')) {
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
        } else {
            canvas.width = 571;
            canvas.height = 255;
        }
        canvas.getContext("2d").scale(ratio, ratio);

        console.log(canvas.width)
        console.log(canvas.height)
        console.log(canvas.getContext("2d").scale(ratio, ratio))
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });

    document.getElementById('save-png').addEventListener('click', function () {

        if (signaturePad.isEmpty()) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanda Tangan Kosong!',
                text: 'Silahkan tanda tangan terlebih dahulu.',
            });
        } else {
            var data = signaturePad.toDataURL('image/png');
            console.log(data);
            var textareaName = (kategori === 'lemkis') ? 'ttd_pelengkap' : 'paraf_pelapor';
            $('#myModal').modal('show').find('.modal-body').html('<img src="' + data +
                '"><textarea id="signature64" name=" ' + textareaName + '"  style="display:none">' + data +
                '</textarea>');
        }
    });

    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
    });

    document.getElementById('undo').addEventListener('click', function () {
        var data = signaturePad.toData();
        if (data) {
            data.pop(); // remove the last dot or line
            signaturePad.fromData(data);
        }
    });

</script>
