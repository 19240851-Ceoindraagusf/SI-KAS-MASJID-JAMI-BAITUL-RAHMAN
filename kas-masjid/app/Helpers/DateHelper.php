<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    private static function normalizeDate($date = null): Carbon
    {
        $carbonDate = $date ? Carbon::parse($date) : Carbon::now();

        return $carbonDate->setTimezone('Asia/Jakarta');
    }

    /**
     * Format tanggal dalam format Indonesia
     * Contoh: Senin, 6 Juli 2026
     */
    public static function formatIndonesianDate($date = null): string
    {
        $date = self::normalizeDate($date);

        $daysIndonesian = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];

        $monthsIndonesian = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $dayName = $daysIndonesian[$date->format('l')] ?? $date->format('l');
        $monthName = $monthsIndonesian[$date->format('F')] ?? $date->format('F');

        return $date->format('d') . ' ' . $monthName . ' ' . $date->format('Y');
    }

    /**
     * Format waktu dan tanggal lengkap dalam format Indonesia
     * Contoh: Senin, 6 Juli 2026 14:30:45
     */
    public static function formatIndonesianDateTime($date = null): string
    {
        $date = self::normalizeDate($date);

        return self::formatIndonesianDate($date) . ' ' . $date->format('H:i:s');
    }

    /**
     * Format hanya tanggal dalam format pendek Indonesia
     * Contoh: 6 Juli 2026
     */
    public static function formatIndonesianDateShort($date = null): string
    {
        $date = self::normalizeDate($date);

        $monthsIndonesian = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $monthName = $monthsIndonesian[$date->format('F')] ?? $date->format('F');

        return $date->format('d') . ' ' . $monthName . ' ' . $date->format('Y');
    }

    /**
     * Format hanya waktu dalam format Indonesia
     * Contoh: 14:30:45 WIB
     */
    public static function formatIndonesianTime($date = null): string
    {
        $date = self::normalizeDate($date);

        return $date->format('H:i:s') . ' WIB';
    }

    /**
     * Format untuk audit log: tanggal dan waktu dalam satu baris
     * Contoh: 6 Juli 2026, 14:30:45
     */
    public static function formatIndonesianAuditLog($date = null): string
    {
        $date = self::normalizeDate($date);

        $monthsIndonesian = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $monthName = $monthsIndonesian[$date->format('F')] ?? $date->format('F');

        return $date->format('d') . ' ' . $monthName . ' ' . $date->format('Y') . ', ' . $date->format('H:i:s');
    }
}
