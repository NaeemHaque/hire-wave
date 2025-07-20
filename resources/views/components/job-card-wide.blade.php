@props(['job'])

<x-panel class="gap-x-6">
    <div>
        <x-employer-logo :employer="$job->employer"  :size="92"/>
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400">{{ $job->employer->name  }}</a>

        <div class="font-bold text-xl mt-2">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </div>
        <div class="text-gray-400 text-sm mt-auto">{{ $job->schedule  }} -  {{$job->salary}} BDT</div>
    </div>

    <div class="space-x-1 mb-2">
        @foreach($job->tags as $tag)
            <x-tag :tag="$tag" />
        @endforeach
    </div>

</x-panel>
