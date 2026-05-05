@props([
    'label' => '',
    'value' => '0',
    'icon' => 'bi-wallet2',
    'type' => 'primary',
    'change' => null
])

@php
    $typeClasses = [
        'income' => 'border-left-color: #10b981; --bg-color: rgba(16, 185, 129, 0.05);',
        'expense' => 'border-left-color: #ef4444; --bg-color: rgba(239, 68, 68, 0.05);',
        'balance' => 'border-left-color: #3b82f6; --bg-color: rgba(59, 130, 246, 0.05);',
        'primary' => 'border-left-color: #4f46e5; --bg-color: rgba(79, 70, 229, 0.05);',
    ];
    $style = $typeClasses[$type] ?? $typeClasses['primary'];
@endphp

<div class="stat-card" style="border-left: 4px solid; {{ $style }}">
    <div class="stat-label">
        <i class="bi {{ $icon }}"></i>
        {{ $label }}
    </div>
    <div class="stat-value">
        {{ $value }}
    </div>
    @if($change)
        <div class="stat-change @if(strpos($change, '+') === 0) positive @else negative @endif">
            {{ $change }}
        </div>
    @endif
</div>

<style>
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: -50px;
        width: 100px;
        height: 100px;
        background: var(--bg-color);
        border-radius: 50%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        z-index: 1;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .stat-change {
        font-size: 0.85rem;
        color: #64748b;
        position: relative;
        z-index: 1;
    }

    .stat-change.positive {
        color: #10b981;
    }

    .stat-change.negative {
        color: #ef4444;
    }
</style>
