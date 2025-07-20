<x-layout>
    <x-page-heading>Results</x-page-heading>

    @if($jobs->count() === 0)
        <div class="text-center bg-white/10 p-8 rounded-xl border border-white/10 text-white/70 shadow-sm">
            <p class="text-2xl font-bold">No jobs found</p>
        </div>
    @endif

    <div class="space-y-6">
        @foreach($jobs as $job)
            <x-job-card-wide :job="$job" />
        @endforeach
    </div>
</x-layout>
