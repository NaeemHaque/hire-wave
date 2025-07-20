@props (['employer', 'size' => 48])

<img src="{{ asset($employer->logo) }}"
     class="rounded-full"
     width="{{ $size }}"
     height="{{ $size }}"
/>
