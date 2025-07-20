<x-layout>
    <div class="space-y-12">
        <section class="text-center my-10">
            <h1 class="font-bold text-4xl mt-6">Let's find a suitable position</h1>

{{--            <form class="mt-6">--}}
{{--                <input type="text" placeholder="Full-steak developer"--}}
{{--                       class="w-full max-w-xl px-5 p-4 rounded-xl bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-1 focus:ring-offset-blue-800">--}}
{{--            </form>--}}

            <x-forms.form method="GET" action="/search" class="mt-8">
                <x-forms.input name="q" :label="false" placeholder="Search for jobs..." />
            </x-forms.form>
        </section>


        <section class="my-10">
            <x-section-heading>Featured Jobs</x-section-heading>

            <div class="grid grid-cols-3 gap-4 mt-6">
                @foreach($featuredJobs as $job)
                    <x-job-card :job="$job" />
                @endforeach
            </div>
        </section>

        <section class="my-10">
            <x-section-heading>Tags</x-section-heading>

            <div class="space-x-1 mt-6">
               @foreach($tags as $tag)
                <x-tag :tag="$tag" />
               @endforeach
            </div>

        </section>

        <section class="my-10">
            <x-section-heading>Recent Jobs</x-section-heading>

            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <x-job-card-wide :job="$job" />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
