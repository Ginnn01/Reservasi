@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-1.5']) }} style="font-family: 'IBM Plex Mono', monospace; font-size: 11px; letter-spacing: 0.04em; text-transform: uppercase; color: #8A7B6C;">
    {{ $value ?? $slot }}
</label>