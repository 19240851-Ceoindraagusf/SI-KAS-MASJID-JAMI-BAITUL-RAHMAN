@props([
    'setting' => $masjidSetting ?? null,
    'size' => 80,
    'class' => '',
])

@php
    $logoUrl = $setting?->logo_url;
    $name = $setting?->nama_masjid ?? 'Masjid Jami Baitul Rahman';
@endphp

@if ($logoUrl)
    <img
        src="{{ $logoUrl }}"
        alt="Logo {{ $name }}"
        width="{{ $size }}"
        height="{{ $size }}"
        class="{{ $class }}"
        style="width: {{ $size }}px; height: {{ $size }}px; object-fit: contain;"
    >
@else
    <i
        class="bi bi-building {{ $class }}"
        aria-label="Logo {{ $name }}"
        style="font-size: {{ max(24, round($size * 0.62)) }}px; line-height: 1;"
    ></i>
@endif
