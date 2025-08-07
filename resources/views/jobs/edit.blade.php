<x-layout>
    <div class="space-y-8">
        <!-- Edit Header -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Edit Job</h1>
                    <p class="text-gray-400">Update your job posting</p>
                </div>
                <a href="/dashboard" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <x-forms.form method="PUT" action="/jobs/{{ $job->id }}">
                <x-forms.input name="title" label="Job Title" :value="$job->title" placeholder="Full-stack Developer" />
                <x-forms.input name="salary" label="Salary" :value="$job->salary" placeholder="$10,000" />
                <x-forms.input name="location" label="Location" :value="$job->location" placeholder="Remote" />

                <x-forms.select name="schedule" label="Schedule">
                    <option value="Full Time" {{ $job->schedule === 'Full Time' ? 'selected' : '' }}>Full Time</option>
                    <option value="Part Time" {{ $job->schedule === 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    <option value="Contract" {{ $job->schedule === 'Contract' ? 'selected' : '' }}>Contract</option>
                </x-forms.select>

                <x-forms.input name="url" label="URL" :value="$job->url" placeholder="https://example.com" />
                <x-forms.checkbox name="featured" label="Featured" :checked="$job->featured" />

                <x-forms.divider />

                <x-forms.input name="tags" label="Tags (comma separated)" :value="$job->tags->pluck('name')->implode(', ')" placeholder="Developer, Management, HR" />

                <x-forms.divider />

                <div class="flex space-x-4">
                    <x-forms.button>Update Job</x-forms.button>
                    <a href="/dashboard" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                        Cancel
                    </a>
                </div>
            </x-forms.form>
        </div>

        <!-- Job Preview -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Current Job Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400 text-sm">Job Title</p>
                        <p class="text-white font-medium">{{ $job->title }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Salary</p>
                        <p class="text-white font-medium">{{ $job->salary }} BDT</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Location</p>
                        <p class="text-white font-medium">{{ $job->location }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Schedule</p>
                        <p class="text-white font-medium">{{ $job->schedule }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400 text-sm">Application URL</p>
                        <a href="{{ $job->url }}" target="_blank" class="text-blue-400 hover:text-blue-300 transition-colors">{{ $job->url }}</a>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Featured Status</p>
                        <span class="px-2 py-1 {{ $job->featured ? 'bg-green-500/20 text-green-300' : 'bg-gray-500/20 text-gray-300' }} text-xs rounded-full">
                            {{ $job->featured ? 'Featured' : 'Regular' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Posted</p>
                        <p class="text-white font-medium">{{ $job->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Tags</p>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($job->tags as $tag)
                                <span class="px-2 py-1 bg-white/10 text-white text-xs rounded-full">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout> 