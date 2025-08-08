<x-layout>
    <x-page-heading>{{ $job->title }}</x-page-heading>

    <div class="space-y-12">
        <div class="min-h-screen py-8">
            <div class="max-w-4xl mx-auto px-4">

                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ url()->previous() }}"
                       class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <span>Back to Jobs</span>
                    </a>
                </div>

                <!-- Job Header -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 mb-8">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

                        <!-- Left Content -->
                        <div class="flex-1">
                            <!-- Company Info -->
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-16 h-16 flex items-center justify-center overflow-hidden">
                                    <x-employer-logo :employer="$job->employer" :size="50"/>
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-white">{{ $job->employer->name }}</h2>
                                    <p class="text-gray-400">{{ $job->employer->user->name ?? 'Verified Employer' }}</p>
                                </div>
                            </div>

                            <!-- Job Title -->
                            <h1 class="text-4xl font-bold text-white mb-4 leading-tight">{{ $job->title }}</h1>

                            <!-- Job Meta Info -->
                            <div class="flex flex-wrap gap-4 mb-6">
                                @if($job->location)
                                    <div class="flex items-center space-x-2 text-gray-300">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $job->location }}</span>
                                    </div>
                                @endif

                                @if($job->salary)
                                    <div class="flex items-center space-x-2 text-gray-300">
                                        <span class="text-green-400 font-semibold">{{ $job->salary }}</span>
                                    </div>
                                @endif

                                @if($job->schedule)
                                    <div class="flex items-center space-x-2 text-gray-300">
                                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ ucfirst($job->schedule) }}</span>
                                    </div>
                                @endif

                                <div class="flex items-center space-x-2 text-gray-300">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <!-- Job Tags -->
                            @if($job->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach($job->tags as $tag)
                                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 text-sm rounded-full border border-blue-500/30">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Right Content - Apply Section -->
                        <div class="lg:w-80 flex-shrink-0">
                            <div class="bg-white/10 border border-white/20 rounded-xl p-6 sticky top-8">
                                <div class="text-center mb-6">
                                    @if($job->salary)
                                        <div class="text-3xl font-bold text-green-400 mb-2">
                                            {{ $job->salary }}
                                        </div>
                                        <div class="text-gray-400 text-sm">per year</div>
                                    @else
                                        <div class="text-xl font-semibold text-white mb-2">Competitive Salary</div>
                                        <div class="text-gray-400 text-sm">Based on experience</div>
                                    @endif
                                </div>

                                <a href="{{ $job->url }}" target="_blank"
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition-colors mb-4 text-lg block text-center">
                                    Apply Now
                                </a>

                                <!-- <button
                                    class="w-full bg-white/10 hover:bg-white/20 border border-white/20 text-white font-medium py-3 px-6 rounded-xl transition-colors mb-6">
                                    Save Job
                                </button> -->

                                <!-- Quick Stats -->
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Job Type</span>
                                        <span class="text-white">{{ ucfirst($job->schedule ?? 'Full-time') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Experience</span>
                                        <span class="text-white">Mid-Senior Level</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Industry</span>
                                        <span class="text-white">Technology</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Remote</span>
                                        <span class="text-green-400">{{ str_contains(strtolower($job->location ?? ''), 'remote') ? 'Yes' : 'Hybrid' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Content -->
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">

                        <!-- Job Description -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-8">
                            <h2 class="text-2xl font-bold text-white mb-6">Job Description</h2>
                            <div class="prose prose-invert max-w-none">
                                @if($job->description)
                                    <div class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $job->description }}</div>
                                @else
                                    <!-- Static Description for Demo -->
                                    <div class="text-gray-300 leading-relaxed space-y-4">
                                        <p>We are seeking a highly skilled and motivated {{ $job->title }} to join our
                                            dynamic team. This is an excellent opportunity to work with cutting-edge
                                            technologies and contribute to innovative projects that impact millions of
                                            users worldwide.</p>

                                        <h3 class="text-xl font-semibold text-white mt-6 mb-3">Key Responsibilities:</h3>
                                        <ul class="list-disc list-inside space-y-2 text-gray-300">
                                            <li>Develop and maintain high-quality software solutions</li>
                                            <li>Collaborate with cross-functional teams to define and implement new features</li>
                                            <li>Write clean, maintainable, and efficient code</li>
                                            <li>Participate in code reviews and contribute to team best practices</li>
                                            <li>Troubleshoot and debug applications to optimize performance</li>
                                            <li>Stay up-to-date with emerging technologies and industry trends</li>
                                        </ul>

                                        <h3 class="text-xl font-semibold text-white mt-6 mb-3">Requirements:</h3>
                                        <ul class="list-disc list-inside space-y-2 text-gray-300">
                                            <li>Bachelor's degree in Computer Science or related field</li>
                                            <li>3+ years of experience in software development</li>
                                            <li>Strong proficiency in modern programming languages</li>
                                            <li>Experience with database design and optimization</li>
                                            <li>Excellent problem-solving and communication skills</li>
                                            <li>Ability to work in a fast-paced, collaborative environment</li>
                                        </ul>

                                        <h3 class="text-xl font-semibold text-white mt-6 mb-3">Nice to Have:</h3>
                                        <ul class="list-disc list-inside space-y-2 text-gray-300">
                                            <li>Experience with cloud platforms (AWS, Azure, GCP)</li>
                                            <li>Knowledge of containerization and microservices</li>
                                            <li>Previous experience in a startup environment</li>
                                            <li>Contributions to open-source projects</li>
                                        </ul>

                                        <h3 class="text-xl font-semibold text-white mt-6 mb-3">What We Offer:</h3>
                                        <ul class="list-disc list-inside space-y-2 text-gray-300">
                                            <li>Competitive salary and equity package</li>
                                            <li>Comprehensive health, dental, and vision insurance</li>
                                            <li>Flexible work arrangements and remote-first culture</li>
                                            <li>Professional development opportunities</li>
                                            <li>Modern office space with all the amenities</li>
                                            <li>Unlimited PTO and work-life balance focus</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Apply Section -->
                        <div class="bg-gradient-to-r from-blue-600/20 to-purple-600/20 border border-blue-500/30 rounded-xl p-8 text-center">
                            <h3 class="text-2xl font-bold text-white mb-4">Ready to Apply?</h3>
                            <p class="text-gray-300 mb-6">Join {{ $job->employer->name }} and take your career to the next level</p>
                            <a href="{{ $job->url }}" target="_blank"
                               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-xl transition-colors text-lg inline-block">
                                Apply for this Position
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Job Stats -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-4">Job Statistics</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span class="text-gray-400 text-sm">Views</span>
                                    </div>
                                    <span class="text-white font-medium">{{ rand(5, 100) }}</span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span class="text-gray-400 text-sm">Applications</span>
                                    </div>
                                    <span class="text-white font-medium">{{ rand(5, 50) }}</span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-gray-400 text-sm">Posted</span>
                                    </div>
                                    <span class="text-white font-medium">{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Similar Jobs -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-white mb-4">Similar Jobs</h3>
                            <div class="space-y-4">
                                @for($i = 1; $i <= 3; $i++)
                                    <div class="group cursor-pointer">
                                        <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-white/5 transition-colors">
                                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span class="text-white text-sm font-semibold">{{ chr(64 + $i) }}</span>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-medium text-white text-sm group-hover:text-blue-300 transition-colors truncate">
                                                    {{ ['Senior Frontend Developer', 'Full Stack Engineer', 'Backend Developer'][$i-1] }}
                                                </h4>
                                                <p class="text-gray-400 text-xs">{{ ['TechCorp', 'StartupXYZ', 'InnovateLab'][$i-1] }}</p>
                                                <p class="text-gray-500 text-xs mt-1">${{ rand(80, 150) }}k • Remote</p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                                <div class="pt-2">
                                    <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors text-sm font-medium">
                                        View More Similar Jobs →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout> 