<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Recommendations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Recommended Movies</h1>

        <a href="/" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">← Back to Movies</a>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
@forelse ($recommendations as $movie)
    <div class="bg-white rounded shadow overflow-hidden">
        <div class="p-4 space-y-2">
            <h2 class="text-xl font-semibold">{{ $movie['title'] }}</h2>
            <p><strong>Genre:</strong> {{ $movie['genres'] ?? 'N/A' }}</p>
        </div>
    </div>
@empty
    <p class="text-red-500">No recommendations available.</p>
@endforelse
        </div>
    </div>
</body>
</html>
