<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DesigntheSite | Website Development & Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO SPACE -->
            <div class="flex items-center space-x-2">
                <!-- Replace with your logo image later -->
                <div class="w-10 h-10 bg-blue-600 rounded flex items-center justify-center text-white font-bold">
                    YB
                </div>
                <span class="text-xl font-semibold text-gray-800">
                    DesigntheSite
                </span>
            </div>

            <!-- LOGIN BUTTON -->
            <a href="{{ route('login') }}"
               class="text-sm font-medium text-white bg-blue-600 px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </a>
        </div>
    </header>

    <!-- HERO SECTION -->
    <main class="flex-1">
        <section class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Professional Website Development & Billing Management
            </h1>

            <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-10">
                We build, manage, and maintain websites for businesses.
                Track your website renewals, expiry dates, and billing details
                from a single secure dashboard.
            </p>

            <a href="{{ route('login') }}"
               class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-blue-700 transition">
                Client Login
            </a>
        </section>

        <!-- FEATURES -->
        <section class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">

                <div class="p-6 border rounded-xl bg-gray-50">
                    <h3 class="text-lg font-semibold mb-2">Website Development</h3>
                    <p class="text-gray-600">
                        Modern, fast, and responsive websites tailored to your business needs.
                    </p>
                </div>

                <div class="p-6 border rounded-xl bg-gray-50">
                    <h3 class="text-lg font-semibold mb-2">Billing & Renewals</h3>
                    <p class="text-gray-600">
                        Never miss an expiry date. Track renewals and billing history easily.
                    </p>
                </div>

                <div class="p-6 border rounded-xl bg-gray-50">
                    <h3 class="text-lg font-semibold mb-2">Automated Reminders</h3>
                    <p class="text-gray-600">
                        WhatsApp reminders before website expiry so nothing stops your business.
                    </p>
                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center text-sm">
        © {{ date('Y') }} DesigntheSite. All rights reserved.
    </footer>

</body>
</html>
