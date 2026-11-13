@props(['code'])

@if ($code === 'pt_BR')
    {{-- Bandeira do Brasil (SVG Minimalista) --}}
    <svg class="w-5 h-3.5 rounded-[2px] shrink-0 shadow-sm" viewBox="0 0 640 480">
        <path fill="#229e45" d="M0 0h640v480H0z"/>
        <path fill="#f8e509" d="m320 40 280 200-280 200L40 240Z"/>
        <circle cx="320" cy="240" r="105" fill="#2b49a3"/>
        <path fill="#fff" d="M216 218c65-16 144-4 205 34l-7 16c-58-35-133-47-196-32z"/>
    </svg>
@elseif ($code === 'en')
    {{-- Bandeira dos EUA (SVG Minimalista) --}}
    <svg class="w-5 h-3.5 rounded-[2px] shrink-0 shadow-sm" viewBox="0 0 640 480">
        <path fill="#bd3d44" d="M0 0h640v480H0"/>
        <path stroke="#fff" stroke-width="37" d="M0 55.3h640M0 129h640M0 203h640M0 277h640M0 351h640M0 425h640"/>
        <path fill="#192f5d" d="M0 0h364.8v258.5H0"/>
    </svg>
@endif