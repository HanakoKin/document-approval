<script>
    document.addEventListener('DOMContentLoaded', function () {
        var greetingMessage = document.getElementById('greetingMessage');
        var currentTime = new Date().getHours();

        if (currentTime >= 5 && currentTime < 11) {
            greetingMessage.innerText = 'Selamat Pagi';
        } else if (currentTime >= 11 && currentTime < 14) {
            greetingMessage.innerText = 'Selamat Siang';
        } else if (currentTime >= 14 && currentTime < 17) {
            greetingMessage.innerText = 'Selamat Sore';
        } else {
            greetingMessage.innerText = 'Selamat Malam';
        }
    });

</script>
