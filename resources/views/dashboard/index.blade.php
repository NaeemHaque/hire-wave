<x-layout>
    <div class="space-y-8">
        <x-success-message />
        <!-- Dashboard Header -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <x-employer-logo :employer="$employer" :size="64"/>
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $employer->name }}</h1>
                        <p class="text-gray-400">Employer Dashboard</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                        Post New Job
                    </a>
                    <a href="/dashboard/profile" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                        Edit Profile
                    </a>
                </div>
            </div>
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Jobs</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total_jobs'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Featured Jobs</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['featured_jobs'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Active Jobs</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['active_jobs'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jobs Section -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Your Job Postings</h2>
                <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    Post New Job
                </a>
            </div>

            @if($jobs->count() > 0)
                <div class="space-y-4">
                    @foreach($jobs as $job)
                        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-semibold text-white">{{ $job->title }}</h3>
                                            <p class="text-gray-400">{{ $job->location }} • {{ $job->salary }} BDT</p>
                                            <div class="flex items-center space-x-2 mt-2">
                                                @if($job->featured)
                                                    <span class="px-2 py-1 bg-green-500/20 text-green-300 text-xs rounded-full">Featured</span>
                                                @endif
                                                <span class="px-2 py-1 bg-blue-500/20 text-blue-300 text-xs rounded-full">{{ $job->schedule }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-400 text-sm">{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    @if($job->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2 mt-3">
                                            @foreach($job->tags as $tag)
                                                <span class="px-2 py-1 bg-white/10 text-white text-xs rounded-full">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center space-x-3 ml-6">
                                    <a href="/jobs/{{ $job->id }}/edit" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition-colors">
                                        Edit
                                    </a>
                                    <form action="/jobs/{{ $job->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-300 px-4 py-2 rounded-lg transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">No jobs posted yet</h3>
                    <p class="text-gray-400 mb-6">Start by posting your first job to attract candidates</p>
                    <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                        Post Your First Job
                    </a>
                </div>
            @endif
        </div>

        <!-- Future Features Placeholder -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-4">Coming Soon</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Applications</h3>
                    </div>
                    <p class="text-gray-400 text-sm">View and manage job applications from candidates</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Analytics</h3>
                    </div>
                    <p class="text-gray-400 text-sm">Track job performance and candidate engagement</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
