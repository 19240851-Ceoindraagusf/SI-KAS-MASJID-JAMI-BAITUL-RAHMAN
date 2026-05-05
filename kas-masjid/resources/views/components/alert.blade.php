@props([
    'type' => 'info',
    'title' => '',
    'message' => ''
])

@php
    $typeConfig = [
        'success' => [
            'bg' => '#ecfdf5',
            'border' => '#10b981',
            'text' => '#065f46',
            'icon' => 'bi-check-circle'
        ],
        'danger' => [
            'bg' => '#fee2e2',
            'border' => '#ef4444',
            'text' => '#991b1b',
            'icon' => 'bi-exclamation-circle'
        ],
        'warning' => [
            'bg' => '#fffbeb',
            'border' => '#f59e0b',
            'text' => '#78350f',
            'icon' => 'bi-exclamation-triangle'
        ],
        'info' => [
            'bg' => '#eff6ff',
            'border' => '#3b82f6',
            'text' => '#0c2340',
            'icon' => 'bi-info-circle'
        ]
    ];
    $config = $typeConfig[$type] ?? $typeConfig['info'];
@endphp

<div class="alert" style="
    background: {{ $config['bg'] }};
    border-left: 4px solid {{ $config['border'] }};
    color: {{ $config['text'] }};
    padding: 16px;
    border-radius: 8px;
">
    <i class="bi {{ $config['icon'] }}"></i>
    @if($title)
        <strong>{{ $title }}</strong>
    @endif
    @if($message)
        <p style="margin: {{ $title ? '8px 0 0 0' : '0' }};">{{ $message }}</p>
    @else
        {{ $slot }}
    @endif
</div>

<style>
    .alert {
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
