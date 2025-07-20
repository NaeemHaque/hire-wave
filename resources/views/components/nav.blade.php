<nav class="flex justify-between items-center pt-4 pb-2 border-b border-b-white/10 relative">
    <div class="mx-2">
        <a href="/">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="logo" class="h-8 w-auto">
        </a>
    </div>

    <!-- Desktop view -->
    <div class="hidden md:flex space-x-6 font-semibold">
        <a href="/" class="hover:text-gray-300 transition-colors">Jobs</a>
        <a href="/careers" class="hover:text-gray-300 transition-colors">Careers</a>
        <a href="/employers" class="hover:text-gray-300 transition-colors">Companies</a>
    </div>

    @auth
        <div class="hidden md:flex space-x-4 font-semibold">
            <a href="/jobs" class="hover:text-gray-300 transition-colors">Post a job</a>
            <form action="/logout" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button class="cursor-pointer hover:text-gray-300 transition-colors">Logout</button>
            </form>
        </div>
    @endauth

    @guest
        <div class="hidden md:flex space-x-4 font-semibold">
            <a href="/register" class="hover:text-gray-300 transition-colors">Sign Up</a>
            <a href="/login" class="hover:text-gray-300 transition-colors">Login</a>
        </div>
    @endguest

    <!-- Mobile view -->
    <div class="md:hidden">
        <button id="mobile-menu-toggle" class="p-2 rounded-md hover:bg-white/10 transition-colors">
            <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
         class="absolute top-full left-0 right-0 bg-[#101915] border-t border-white/10 shadow-lg hidden md:hidden z-50">
        <div class="px-4 py-4 space-y-4">
            <div class="space-y-3">
                <a href="/" class="block font-semibold hover:text-gray-300 transition-colors">Jobs</a>
                <a href="/careers" class="block font-semibold hover:text-gray-300 transition-colors">Careers</a>
                <a href="/employers" class="block font-semibold hover:text-gray-300 transition-colors">Companies</a>
            </div>

            <div class="pt-4 border-t border-white/10">
                @auth
                    <div class="space-y-3">
                        <a href="/jobs" class="block font-semibold hover:text-gray-300 transition-colors">Post a job</a>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="block w-full text-left font-semibold hover:text-gray-300 transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class="space-y-3">
                        <a href="/register" class="block font-semibold hover:text-gray-300 transition-colors">Sign
                            Up</a>
                        <a href="/login" class="block font-semibold hover:text-gray-300 transition-colors">Login</a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuToggle.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');

            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });


        document.addEventListener('click', function(event) {
            const isClickInsideNav = event.target.closest('nav');
            if (!isClickInsideNav && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });


        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) { // md breakpoint
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
    });
</script>

