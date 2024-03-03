<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .form-container {
            width: 400px;
            /* Adjust width as needed */
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: calc(100% - 1.5rem);
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .form-container button[type="submit"] {
            width: 94%;
            padding: 0.75rem;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container">
        <div class="bg-white p-6 rounded-lg shadow-md form-container mt-8 mb-8">
            <img src="{{ asset('images/logo-main.png') }}" alt="TheHookUp Logo" class="mx-auto mb-4"
                style="max-width: 200px; height: auto;" />
            <h2 class="text-2xl font-bold mb-4 text-center">Create Account</h2>
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="mb-4">
                    <input id="username" type="text" class="border border-gray-300 rounded-md w-full"
                        name="username" value="{{ old('username') }}" required autocomplete="username"
                        placeholder="Enter your username">
                    @error('username')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input id="password" type="password" class="border border-gray-300 rounded-md w-full"
                        name="password" required autocomplete="new-password" placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input id="password_confirmation" type="password" class="border border-gray-300 rounded-md w-full"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm your password">
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Register</button>
                </div>
            </form>
            <p class="text-center mt-4">Already have an account? <a href="{{ route('login') }}"
                    class="text-blue-500">Login</a></p>
        </div>
    </div>
</body>

</html>
