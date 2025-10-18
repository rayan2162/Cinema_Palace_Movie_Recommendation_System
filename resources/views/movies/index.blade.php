<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinema Palace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Cinema Palace</h1>

        <form method="GET" action="/" class="mb-6 flex flex-col md:flex-row gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                class="border px-4 py-2 rounded shadow w-full md:w-1/2"
                placeholder="Search for a movie..."
            >
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
        </form>

        <a href="{{ route('movies.recommendations') }}" class="bg-purple-500 text-white px-4 py-2 rounded mb-4 inline-block">View Recommendations</a>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($movies as $movie)
                <div class="bg-white rounded shadow overflow-hidden">
                    <img src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x445?text=No+Image' }}" alt="{{ $movie['Title'] }}" class="w-full h-72 object-cover">
                    <div class="p-4 space-y-2">
                        <h2 class="text-xl font-semibold">{{ $movie['Title'] }} ({{ $movie['Year'] }})</h2>
                        <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
                        <p><strong>Director:</strong> {{ $movie['Director'] }}</p>
                        <p><strong>IMDB Rating:</strong> ⭐ {{ $movie['imdbRating'] }}</p>

<form method="POST" action="{{ route('movies.like') }}">
    @csrf
    <input type="hidden" name="title" value="{{ $movie['Title'] }}">
    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">❤️ Like</button>
</form>


                    </div>
                </div>
            @empty
                <p class="text-red-500">No movies found.</p>
            @endforelse
        </div>
    </div>
</body>
</html>

