@props([
    'label' => '',
    'value' => '0',
    'icon' => 'bi-wallet2',
    'type' => 'primary',
    'change' => null
])

@php
    $typeClasses = [
        'income' => 'border-left-color: #16a34a; --bg-color: rgba(22, 163, 74, 0.08);',
        'expense' => 'border-left-color: #dc2626; --bg-color: rgba(220, 38, 38, 0.08);',
        'balance' => 'border-left-color: #0f766e; --bg-color: rgba(15, 118, 110, 0.08);',
        'primary' => 'border-left-color: #0f766e; --bg-color: rgba(15, 118, 110, 0.08);',
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
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.07);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 20px;
        right: 20px;
        width: 44px;
        height: 44px;
        background: var(--bg-color);
        border-radius: 8px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.09);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
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
        color: #16a34a;
    }

    .stat-change.negative {
        color: #dc2626;
    }
</style>
