@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg w-full']) }}
    style="font-family: 'Work Sans', sans-serif; border: 1px solid #E8DFD1; padding: 0.65rem 0.9rem; background: #FFFFFF; color: #2B211D;"
    onfocus="this.style.outline='none'; this.style.borderColor='#6E2A3B';"
    onblur="this.style.borderColor='#E8DFD1';"
>