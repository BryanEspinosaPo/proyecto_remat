@props([
    'title' => '',
    'open' => false,
    // id único por item (si no envías uno, se genera)
    'uid' => Str::uuid(),
])

@php
    $btnId = "acc-btn-$uid";
    $panelId = "acc-panel-$uid";
@endphp

<div class="accordion-item border-b border-gray-200">
    <h3 class="accordion-header">
        <button id="{{ $btnId }}"
            class="accordion-trigger w-full flex items-center justify-between gap-3 py-3 text-left"
            aria-expanded="false" aria-controls="{{ $panelId }}" data-accordion-trigger>
            <span class="font-medium">{{ $title }}</span>
            <img src="{{ asset('images/home/mas.svg') }}" alt="toggle icon" class="accordion-icon">
        </button>
    </h3>

    <div id="{{ $panelId }}" class="accordion-panel overflow-hidden transition-[max-height] duration-200"
        role="region" aria-labelledby="{{ $btnId }}" data-accordion-panel {{ $open ? '' : 'hidden' }}
        style="max-height: {{ $open ? '1000px' : '0px' }};">
        <div class="py-2">
            {{ $slot }}
        </div>
    </div>
</div>
