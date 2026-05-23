document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('passwordField');
    const toggleButton = document.getElementById('toggleButton');
    const eyeOpenIcon = document.getElementById('eyeOpenIcon');
    const eyeCloseIcon = document.getElementById('eyeCloseIcon');

    if (toggleButton && passwordField) {
        toggleButton.addEventListener('click', function (e) {
            // Mencegah form ke-submit secara tidak sengaja
            e.preventDefault(); 

            // Jika bertipe password, ubah ke teks biasa (tampilkan)
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeOpenIcon.classList.add('hidden');
                eyeCloseIcon.classList.remove('hidden');
            } else {
                // Jika bertipe teks, kembalikan ke password (sembunyikan)
                passwordField.type = 'password';
                eyeOpenIcon.classList.remove('hidden');
                eyeCloseIcon.classList.add('hidden');
            }
        });
    }
});