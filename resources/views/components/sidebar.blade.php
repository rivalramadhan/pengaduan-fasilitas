<aside class="w-64 flex-shrink-0 bg-gray-800 text-white p-4">
    <div class="mb-10 text-center">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold">
            Pengaduan Desa
        </a>
    </div>
    <nav>
        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center p-2 mb-2 rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700' }}">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.995 5.995 0 0012 12a5.995 5.995 0 00-3-5.197m0 0A7.002 7.002 0 0012 21a7.002 7.002 0 003-14.197"></path></svg>
            <span>Manage Users</span>
        </a>
        <a href="#" 
           class="flex items-center p-2 mb-2 rounded-md text-gray-400 hover:bg-gray-700">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span>Manage Pengaduan</span>
        </a>
    </nav>
    
    <div class="absolute bottom-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left flex items-center p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>