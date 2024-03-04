<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            height: 100vh;
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
            border: 1px solid #d1d5db;
            /* Add border */
            border-radius: 0.25rem;
            /* Add border radius */
        }

        .form-container button[type="submit"] {
            width: 94%;
            padding: 0.75rem;
        }

        .error-message {
            color: #e53e3e;
            /* Error message color */
            font-size: 0.875rem;
            /* Adjust font size */
            margin-top: 0.25rem;
            /* Add margin top */
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container">
        <div class="bg-white p-6 rounded-lg shadow-md form-container">
            <img src="{{ asset('images/logo-main.png') }}" alt="TheHookUp Logo" class="mx-auto mb-4"
                style="max-width: 200px; height: auto;" />
            <h2 class="text-2xl font-bold mb-4 text-center">Welcome back</h2>
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-4">
                    <input id="username" type="text" class="rounded-md w-full" name="username"
                        value="{{ old('username') }}" required autocomplete="username"
                        placeholder="Enter your username">
                    @error('username')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('login')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <input id="password" type="password" class="rounded-md w-full" name="password" required
                        autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>



                <div>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Login</button>
                </div>
            </form>
            <p class="text-center mt-4">Don't have an account? <a href="{{ route('register') }}"
                    class="text-blue-500">Register</a></p>
        </div>
    </div>
</body>

</html>
