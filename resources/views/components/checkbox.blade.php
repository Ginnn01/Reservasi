@props(['disabled' => false])

<input type="checkbox" @disabled($disabled) {{ $attributes->merge(['class' => 'rounded shadow-sm']) }}
    style="border: 1px solid #E8DFD1; color: #6E2A3B;"
