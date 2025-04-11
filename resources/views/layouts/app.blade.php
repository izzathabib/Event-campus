<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventUSM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite([
      'resources/css/app.css',
      'resources/css/sidebar.css', 
      'resources/css/botNav.css', 
      'resources/js/app.js'
      ])
</head>
<body class="flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar h-screen w-64 transition-all p-2 flex flex-col justify-between">
        <div id="top-sidebar">
            <div class="flex items-center gap-4 p-3">
                <button id="toggle-btn">
                    <span id="toggle-icon" class="text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </span>
                </button>
                <button id="x-icon" class="hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <span class="text-black text-lg font-extrabold" id="dashboard-text">EventUSM</span>
            </div>
            <nav id="sidebar-menu" class="mt-3">
                <ul>
                    <li class="{{ Route::is('society.dashboard')? 'active' : '' }} rounded-md p-3 hover:bg-slate-300 cursor-pointer ">
                        <a href="{{ route('society.dashboard') }}" class="flex items-center gap-4">
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                        </span>
                        <span class="menu-text text-sm">Dashboard</span>
                        </a>
                    </li>
                    <li class="rounded-md p-3 hover:bg-slate-300 cursor-pointer">
                        <a href="#" class="flex items-center gap-4">
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </span>
                        <span class="menu-text text-sm">Home</span>
                        </a>
                    </li>
                    <li class="">
                        <button class="cursor-pointer flex items-center gap-4 hover:bg-slate-300 p-3 rounded-md" id="event-management-toggle">
                            <span class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                </svg>
                            </span>
                            <span class="menu-text text-sm">Event Management</span>
                            <span>
                                <svg id="sidebar-dropdown-menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 ml-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>
                        <ul id="event-management-submenu" class="mt-2 hidden">
                            <li class="ml-12 p-2 border-l-2 border-purple-300 hover:border-purple-600 hover:font-semibold">
                                <a href="" class="cursor-pointer">
                                    <span class="text-sm">Application</span>
                                </a>
                            </li>
                            <li class="ml-12 p-2 cursor-pointer border-l-2 border-purple-300 hover:border-purple-600 hover:font-semibold">
                                <a href="#" class="">
                                    <span class="text-sm">Success Report</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
        </div>
        <div id="bottom-sidebar">
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-md p-3 hover:bg-slate-300 cursor-pointer w-full">
                        <div class="flex gap-4 items-center">
                                <span class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                </span>
                                <span class="menu-text text-sm">
                                    Logout
                                </span>
                        </div>
                    </button>
                </form>
            </div>
            </nav>
        </div>
    </aside>
    <!-- Main Content -->  
    <main id="main-section" class="flex-1 flex-col p-6">
        <!-- Top navigation for mobile screen -->
        <div id="mobile-top-nav" class="flex justify-between hidden mb-4">
            <button id="mobile-sidebar-button">
                <span id="toggle-icon" class="text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </span>
            </button>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                </svg>
            </div>
        </div>
        <!-- Notification and User Profile -->
        <div id="noti-profile" class="flex flex-wrap gap-7 mb-4 justify-end">
            <!-- Notification Icon -->
            <div class="flex">
                <div class="w-9 h-9 rounded-full bg-purple-600 flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </div>
                <span class="relative top-5 right-2 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">3</span>
            </div>
            <!-- User Profile -->
            <div class="flex items-center">
                <div class="mr-3">
                    <p class="font-semibold text-sm">{{ Auth::user()->name }}</p>
                </div>
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-9 h-9 rounded-full object-cover">
                    <div class="profile-status"></div>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
</body>
</html>
