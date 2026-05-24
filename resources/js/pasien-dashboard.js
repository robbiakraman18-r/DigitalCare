document.addEventListener('alpine:init', () => {
    Alpine.data('pasienDashboard', () => ({
        // State awal untuk modal
        logoutModal: false,

        // Fungsi membuka modal
        openLogout() {
            this.logoutModal = true;
        },

        // Fungsi menutup modal
        closeLogout() {
            this.logoutModal = false;
        }
    }));
});

// Jalankan inisialisasi ikon Lucide setelah halaman termuat sempurna
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});