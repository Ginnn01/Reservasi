<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-lg']) }}
    style="font-family: 'Work Sans', sans-serif; font-weight: 600; background-color: #6E2A3B; color: #FBF8F3; padding: 0.6rem 1.4rem; transition: background-color .15s ease;"
    onmouseover="this.style.backgroundColor='#59212F';"
    onmouseout="this.style.backgroundColor='#6E2A3B';"
>
    {{ $slot }}
</button>