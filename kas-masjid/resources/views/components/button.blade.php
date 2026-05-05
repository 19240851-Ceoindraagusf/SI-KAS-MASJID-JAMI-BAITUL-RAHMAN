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
        'primary' => 'background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white;',
        'success' => 'background: #10b981; color: white;',
        'danger' => 'background: #ef4444; color: white;',
        'warning' => 'background: #f59e0b; color: white;',
        'secondary' => 'background: #e2e8f0; color: #1e293b;',
        'light' => 'background: #f1f5f9; color: #1e293b;'
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
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-component:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-component:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
