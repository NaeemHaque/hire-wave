@props(['employers'])

<x-layout>
    <x-page-heading>Companies</x-page-heading>

    <div class="space-y-6 mx-4 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($employers as $employer)
            <x-employer-card :employer="$employer" />
        @endforeach
    </div>
</x-layout>
