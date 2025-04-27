<x-layout>
    <div class="space-y-10">
        <section>
            <x-section-heading>Featured Jobs</x-section-heading>

            <div class="grid grid-cols-3 gap-4 mt-6">
                <x-job-card/>
                <x-job-card/>
                <x-job-card/>
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>

            <div class="space-x-1 mt-6">
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
                <x-tag>Tag</x-tag>
            </div>

        </section>

        <section>
            <x-section-heading>Recent Jobs</x-section-heading>

            <div class="bg-white/10 p-4 rounded-lg mt-6"> Jobs Section </div>
        </section>
    </div>
</x-layout>
