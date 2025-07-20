@props(['job'])

<x-panel class="flex-col text-center shadow-xs shadow-blue-600 hover:shadow-md">
    <div class="self-start text-sm">{{ $job->employer->name  }}</div>

    <div class="py-8">
        <div class="text-xl font-bold">
            <a href="{{ $job->url  }}" target="_blank">
                {{ $job->title  }}
            </a>
        </div>
        <div class="text-sm mt-4">{{ $job->schedule  }} - {{$job->salary}} BDT</div>
    </div>

    <div class="flex justify-between items-center">
        <div class="space-x-1">
            @foreach($job->tags as $tag)
                <x-tag :tag="$tag" size="small" />
            @endforeach
        </div>

        <x-employer-logo :size="42"/>
    </div>
</x-panel>
