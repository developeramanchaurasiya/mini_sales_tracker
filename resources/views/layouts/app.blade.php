<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mini Sales Tracker</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Topbar -->
    <header class="bg-white shadow-sm py-3 px-4 d-flex justify-content-between align-items-center">
        <div class="fs-4 fw-bold">Mini Sales Tracker</div>
        
        <div class="d-flex align-items-center gap-3">
            <!-- Profile info -->
            <div>
                <span class="fw-semibold">{{ Auth()->user()->name }}</span>
            </div>

           <!-- Logout form -->
        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to logout?');">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>

        </div>
    </header>

    <!-- Main content area -->
    <main class="p-4" style="min-height: calc(100vh - 60px);">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
