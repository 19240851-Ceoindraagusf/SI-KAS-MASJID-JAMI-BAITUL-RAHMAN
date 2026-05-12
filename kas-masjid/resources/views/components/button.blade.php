@props([
    'href' => '',
    'type' => 'submit',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => '',
    'disabled' => false
])

@php
    $variants = [
        'primary' => 'background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%); color: white;',
        'success' => 'background: #16a34a; color: white;',
        'danger' => 'background: #dc2626; color: white;',
        'warning' => 'background: #d97706; color: white;',
        'secondary' => 'background: #f8fafc; color: #334155; border: 1px solid #d8e2df;',
        'light' => 'background: #f8fafc; color: #334155; border: 1px solid #e2e8f0;'
    ];
    
    $sizes = [
        'sm' => 'padding: 8px 16px; font-size: 0.85rem;',
        'md' => 'padding: 12px 24px; font-size: 0.95rem;',
        'lg' => 'padding: 14px 32px; font-size: 1rem;'
    ];
    
    $variantStyle = $variants[$variant] ?? $variants['primary'];
    $sizeStyle = $sizes[$size] ?? $sizes['md'];
@endphp

@if($href)
    <a href="{{ $href }}" class="btn-component" style="{{ $variantStyle }} {{ $sizeStyle }}">
        @if($icon)
            <i class="bi {{ $icon }}"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}" 
        {{ $disabled ? 'disabled' : '' }}
        class="btn-component" 
        style="{{ $variantStyle }} {{ $sizeStyle }}"
    >
        @if($icon)
            <i class="bi {{ $icon }}"></i>
        @endif
        {{ $slot }}
    </button>
@endif

<style>
    .btn-component {
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-component:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.14);
    }

    .btn-component:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-component:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
