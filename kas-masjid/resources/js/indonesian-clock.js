/**
 * Indonesian Real-Time Clock
 * Menampilkan jam real-time dalam format Indonesia
 */

class IndonesianClock {
    constructor(elementId, options = {}) {
        this.element = document.getElementById(elementId);
        if (!this.element) {
            console.error(`Element dengan ID "${elementId}" tidak ditemukan`);
            return;
        }

        this.format = options.format || 'full'; // 'full', 'time', 'date'
        this.showSeconds = options.showSeconds !== false;
        this.updateInterval = options.updateInterval || 1000;

        this.daysIndonesian = [
            'Minggu', 'Senin', 'Selasa', 'Rabu',
            'Kamis', 'Jumat', 'Sabtu'
        ];

        this.monthsIndonesian = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        this.init();
    }

    init() {
        this.update();
        this.intervalId = setInterval(() => this.update(), this.updateInterval);
    }

    update() {
        const now = new Date();
        this.element.textContent = this.formatTime(now);
    }

    formatTime(date) {
        const dayName = this.daysIndonesian[date.getDay()];
        const day = String(date.getDate()).padStart(2, '0');
        const monthName = this.monthsIndonesian[date.getMonth()];
        const year = date.getFullYear();

        let hours = String(date.getHours()).padStart(2, '0');
        let minutes = String(date.getMinutes()).padStart(2, '0');
        let seconds = String(date.getSeconds()).padStart(2, '0');

        switch (this.format) {
            case 'time':
                return this.showSeconds ? `${hours}:${minutes}:${seconds}` : `${hours}:${minutes}`;

            case 'date':
                return `${day} ${monthName} ${year}`;

            case 'full':
            default:
                const timeStr = this.showSeconds ? `${hours}:${minutes}:${seconds}` : `${hours}:${minutes}`;
                return `${dayName}, ${day} ${monthName} ${year} - ${timeStr} WIB`;
        }
    }

    destroy() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
    }
}

// Inisialisasi jika di-load sebagai script
document.addEventListener('DOMContentLoaded', function () {
    // Cek apakah ada elemen dengan id 'indonesian-clock' di navbar
    if (document.getElementById('indonesian-clock')) {
        new IndonesianClock('indonesian-clock', {
            format: 'full',
            showSeconds: true,
            updateInterval: 1000
        });
    }

    // Cek apakah ada elemen dengan id 'dashboard-clock' di dashboard
    if (document.getElementById('dashboard-clock')) {
        new IndonesianClock('dashboard-clock', {
            format: 'full',
            showSeconds: true,
            updateInterval: 1000
        });
    }
});
