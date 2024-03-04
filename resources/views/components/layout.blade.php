<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TheHookUp')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="images/logo-main.png" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-800 py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Logo -->
            <a href="/" class="text-white text-xl font-bold flex items-center">
                <i class="fas fa-hook text-white mr-2"></i>
                <img src="{{ asset('images/logo-white.png') }}" alt="TheHookUp Logo"
                    style="max-width: 200px; height: auto;" />
            </a>


            <!-- Navbar Links -->
            <ul class="flex space-x-4">
                <li><a href="/" class="text-white flex items-center"><i class="fas fa-rss mr-1"></i> Feed</a></li>
                <li><a href="/friends" class="text-white flex items-center"><i class="fas fa-user-friends mr-1"></i>
                        Friends</a></li>
                <li><a href="/profile" class="text-white flex items-center"><i class="fas fa-user mr-1"></i> Profile</a>
                </li>
                <li><a href="/notifications" class="text-white flex items-center"><i class="fas fa-bell mr-1"></i>
                        Notifications</a></li>

                <!-- Optional rendering for logout -->
                @auth
                    <li>
                        <div class="relative">
                            <div class="text-white cursor-pointer flex items-center" id="logoutButton">
                                <i class="fas fa-user-circle mr-1"></i>
                                Welcome back, {{ ucfirst(auth()->user()->username) }}
                            </div>
                            <div class="absolute hidden bg-gray-800 p-2 rounded-lg right-0 mt-2 w-48" id="logoutDropdown">
                                <a href="{{ route('logout') }}" class="block text-white">Logout</a>
                            </div>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->


    <!-- Content -->
    <div class="container mx-auto mt-8">
        <main>
            @yield('content')
        </main>
        <x-flash-message />
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            &copy; 2024 TheHookUp. All rights reserved.
        </div>
    </footer>

    <!-- Script for logout dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var timeout;

            document.getElementById('logoutButton').addEventListener('mouseenter', function() {
                clearTimeout(timeout); // Clear any existing timeout
                document.getElementById('logoutDropdown').classList.remove('hidden');
                document.getElementById('logoutDropdown').classList.add(
                    'bg-gray-900'); // Change background color
            });

            document.getElementById('logoutButton').addEventListener('mouseleave', function() {
                // Add a small delay before hiding the dropdown
                timeout = setTimeout(function() {
                    document.getElementById('logoutDropdown').classList.add('hidden');
                    document.getElementById('logoutDropdown').classList.remove(
                        'bg-gray-900'); // Remove background color
                }, 200); // Adjust this value as needed
            });

            // Keep the dropdown visible when the mouse enters it
            document.getElementById('logoutDropdown').addEventListener('mouseenter', function() {
                clearTimeout(timeout); // Clear the timeout to keep the dropdown visible
            });

            // Hide the dropdown when the mouse leaves it
            document.getElementById('logoutDropdown').addEventListener('mouseleave', function() {
                document.getElementById('logoutDropdown').classList.add('hidden');
                document.getElementById('logoutDropdown').classList.remove(
                    'bg-gray-900'); // Remove background color
            });
        });
    </script>
</body>

</html>
