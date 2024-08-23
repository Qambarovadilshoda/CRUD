<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sample Form with Tailwind CSS</title>
    <!-- Tailwind CSS CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css"
        integrity="sha512-qGxS/N3qfA8gISWJlkLz4w4ERIkf4lYfbRdOFdw9Xr0xehN/jV0gFSTTat1NX7sHt0KcV7zYtLmkk/kXMEebiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 py-8">
    <div class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md">
        <div class="px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Add a new user</h2>
            <p class="text-gray-600 mb-6">Hymenaeos sunt pulvinar, nobis esse reiciendis animi blandit</p>
            <form action="/handleLogin" method="post">
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">Email</label>
                    <input
                        class="appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email" id="email" type="email" placeholder="dil@example.com">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">Password</label>
                    <input
                        class="appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="password" id="password" type="password" placeholder="********">
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">Login</button>
                    <a href="/register"
                        class="text-blue-500 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</a>

                </div>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-yellow-200 text-yellow-800 p-4 rounded-md shadow-md">
            <p class="font-bold">Warning!</p>
            <p><?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?></p>
        </div>
    <?php endif; ?>
</body>

</html>