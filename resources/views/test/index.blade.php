<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Testing</title>
</head>

<body>
    <div id="pspdfkit" style="height: 90vh;"></div>
    <button onclick="saveSignature()">Simpan</button>

    <script src="{{ asset('assets/pspdfkit.js') }}"></script>

    <script>
        let pspdfkitInstance;

        PSPDFKit.load({
            container: '#pspdfkit',
            document: 'assets/doc/pspdfkit-web-demo.pdf', // Add the path to your document here.
        }).then(function(instance) {
            console.log('PSPDFKit loaded', instance);
            pspdfkitInstance = instance;
        }).catch(function(error) {
            console.error(error.message);
        });

        function saveSignature() {
            pspdfkitInstance.exportAnnotationData().then(function(data) {
                // Kirim data tanda tangan ke server
                fetch('/api/save-signature', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        signatureData: data
                    })
                }).then(function(response) {
                    if (response.ok) {
                        alert('Tanda tangan berhasil disimpan!');
                    } else {
                        alert('Gagal menyimpan tanda tangan.');
                    }
                }).catch(function(error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan tanda tangan.');
                });
            });
        }
    </script>

</body>

</html>
