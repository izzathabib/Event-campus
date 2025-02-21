<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventUSM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex">
    <aside id="sidebar" class="h-screen bg-gray-900 text-white w-64 transition-all">
        <div class="flex items-center justify-between p-4">
            <span class="text-xl font-bold" id="dashboard-text">Dashboard</span>
            <button id="toggle-btn">
                <span id="toggle-icon">✖</span>
            </button>
        </div>
        <nav class="mt-4">
            <ul>
                <li class="p-4 flex items-center space-x-4 hover:bg-gray-800 cursor-pointer">
                    <span>🏠</span>
                    <span class="menu-text">Home</span>
                </li>
                <li class="p-4 flex items-center space-x-4 hover:bg-gray-800 cursor-pointer">
                    <span>⚙</span>
                    <span class="menu-text">Settings</span>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="flex-1 p-6">Content goes here</main>

</body>
</html>
