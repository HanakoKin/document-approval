<script>
    function showPreview(dataId, dataType) {
        // Kirim permintaan AJAX ke server untuk mengambil data berdasarkan dataId
        // console.log(dataId, dataType);

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/getPreviewData/" + dataType + "/" + dataId,
            true); // Ganti dengan URL yang sesuai dengan rute Anda
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Tangani respons dari server
                var responseData = JSON.parse(xhr.responseText);
                console.log(responseData)

                document.getElementById('senderInfo').innerHTML = responseData.sender + '<br>' + '<small>' +
                    responseData.sender_username + '@gmail.com' + '</small>' +
                    '<span class="mailbox-read-time pull-right">' + responseData.datetime + '</span>';
                if (responseData.document_text) {
                    document.getElementById('messageContent').innerHTML = responseData.document_text;
                } else {
                    var paths = (responseData.path).split(' - ');
                    paths = paths.map(function(path) {
                        return path.replace('public/', '');
                    });
                    // console.log(paths);
                    var htmlContent = '';

                    paths.forEach(function(path) {
                        if (path.endsWith('.jpg') || path.endsWith('.jpeg') || path.endsWith('.png') || path
                            .endsWith('.gif') || path.endsWith('.bmp')) {
                            htmlContent += '<img src="' + path + '" alt="Document Image">';
                        } else if (path.endsWith('.pdf')) {
                            htmlContent += '<embed src="/storage/' + path +
                                '" type="application/pdf" width="100%" height="600px">';
                        } else {
                            htmlContent += '<a href="' + path + '" target="_blank">View Document</a>';
                        }
                    });

                    document.getElementById('messageContent').innerHTML = htmlContent;
                }

            }
        };
        xhr.send();

        // Mengubah kelas div pertama menjadi col-12
        var secondaryDiv = document.getElementById('secondaryDiv');
        if (secondaryDiv.classList.contains('d-none')) {
            // Mengubah kelas elemen pertama
            var firstDiv = document.getElementById('firstDiv');
            firstDiv.classList.remove('col-12');
            firstDiv.classList.add('col-xl-7', 'col-lg-7', 'col-12');

            // Mengubah kelas elemen-elemen dengan kelas 'spanTruncate'
            var spanTruncateElements = document.getElementsByClassName('spanTruncate');

            // console.log(spanTruncateElements)

            for (var i = 0; i < spanTruncateElements.length; i++) {
                var element = spanTruncateElements[i];
                element.classList.remove('max-w-800');
                element.classList.add('max-w-350');
            }
        }
        // Menampilkan div kedua
        secondaryDiv.classList.remove('d-none');
    }

    window.addEventListener('DOMContentLoaded', (event) => {
        // Membatasi panjang teks
        var maxLength = 300; // Jumlah maksimum karakter sebelum dipotong
        var elements = document.querySelectorAll('.spanTruncate');

        // Loop melalui semua elemen dengan kelas 'spanTruncate'
        elements.forEach(function(element) {
            var text = element.innerText;

            // Jika panjang teks melebihi maxLength, potong teks dan tambahkan tanda titik
            if (text.length > maxLength) {
                var truncatedText = text.substring(0, maxLength) + '...';
                element.innerText = truncatedText;
            }
        });
    });

    function filterData(dataType, category) {
        // Kirim permintaan Ajax untuk mendapatkan data baru berdasarkan jenis yang dipilih

        console.log(dataType, category);
        var xhr = new XMLHttpRequest();

        xhr.open("GET", "/filterData/" + category + "/" + dataType,
            true); // Ganti dengan URL yang sesuai dengan rute Anda
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Tangani respons dari server
                var responseData = JSON.parse(xhr.responseText);

                console.log(responseData);

                // Ganti isi $result dengan data yang diterima
                updateTable(responseData);
            }
        };
        xhr.send();
    }

    function updateTable(data) {
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = ''; // Kosongkan isi tabel sebelum memasukkan data baru

        // Iterasi melalui data yang diterima dan masukkan ke dalam tabel
        data.forEach(function(item) {
            console.log(item);

            var url = item.source === 'memos' ?
                '/memo/' + item.category + '/' + item.id :
                '/document/' + item.category + '/' + item.id;

            var newRow =
                '<tr>' +
                '<td><input type="checkbox"></td>' +
                '<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>' +
                '<td>' +
                '<a href="' + url + '" class="mailbox-name mb-0 fs-16 fw-600">' + item.subject + '</a>' +
                '<p class="mailbox-subject mb-0">' + item.sender + '</p>' +
                '<span onclick="showPreview(\'' + item.id + '\', \'' + item.source +
                '\')" class="d-inline-block text-truncate max-w-800 m-0 spanTruncate">' + item.description +
                '</span>' +
                '</td>' +
                '<td class="mailbox-attachment">'; // Moved this line to concatenate conditionally

            if (item.path) { // Check if item.path exists
                newRow += '<i class="fa fa-paperclip"></i>'; // If yes, add the paperclip icon
            }

            newRow += // Moved this line to concatenate with the above conditional block
                '</td>' +
                '<td class="mailbox-date">' + item.datetime + '</td>' +
                '</tr>';

            tableBody.innerHTML += newRow;


            var spanTruncateElements = document.getElementsByClassName('spanTruncate');
            var secondaryDiv = document.getElementById('secondaryDiv');

            for (var i = 0; i < spanTruncateElements.length; i++) {
                var element = spanTruncateElements[i];

                if (!(element.classList.contains('max-w-800') && secondaryDiv.classList.contains('d-none'))) {
                    element.classList.remove('max-w-800');
                    element.classList.add('max-w-350');
                }
            }
        });
    }

    document.getElementById("refreshButton").addEventListener("click", function() {
        location.reload();
    });
</script>
