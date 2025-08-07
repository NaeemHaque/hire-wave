<x-layout>
    <div class="space-y-8">
        <x-success-message />
        <!-- Profile Header -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Edit Profile</h1>
                    <p class="text-gray-400">Update your company information</p>
                </div>
                <a href="/dashboard" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center space-x-6 mb-8">
                <div class="w-24 h-24 bg-white/10 rounded-xl flex items-center justify-center overflow-hidden">
                    @if($employer->logo)
                        <img src="{{ Storage::disk('public')->url($employer->logo) }}" alt="{{ $employer->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-white text-2xl font-bold">{{ substr($employer->name, 0, 2) }}</span>
                    @endif
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $employer->name }}</h2>
                    <p class="text-gray-400">Current company logo</p>
                </div>
            </div>

            <x-forms.form method="PUT" action="/dashboard/profile" enctype="multipart/form-data">
                <x-forms.input name="name" label="Company Name" :value="$employer->name" />
                
                <x-forms.divider />
                
                <x-forms.input name="logo" label="Company Logo" type="file" />
                <p class="text-gray-400 text-sm mt-2">Upload a new logo to replace the current one. Supported formats: JPEG, PNG, JPG, GIF, SVG, WEBP (max 2MB)</p>

                <x-forms.divider />

                <div class="flex space-x-4">
                    <x-forms.button>Update Profile</x-forms.button>
                    <a href="/dashboard" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                        Cancel
                    </a>
                </div>
            </x-forms.form>
        </div>

        <!-- Account Information -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Account Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">User Details</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-400 text-sm">Name</p>
                            <p class="text-white font-medium">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Email</p>
                            <p class="text-white font-medium">{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Member Since</p>
                            <p class="text-white font-medium">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Company Details</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-400 text-sm">Company Name</p>
                            <p class="text-white font-medium">{{ $employer->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Total Jobs Posted</p>
                            <p class="text-white font-medium">{{ $employer->jobs->count() }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Profile Created</p>
                            <p class="text-white font-medium">{{ $employer->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout> 