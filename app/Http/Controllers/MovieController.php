<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\LikedMovie;

class MovieController extends Controller
{
    // --- Show movie search page ---
    public function index(Request $request)
    {
        $search = $request->input('search', 'batman');

        $searchResponse = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            's' => $search,
            'type' => 'movie',
            'r' => 'json',
            'page' => 1
        ]);

        $searchResults = $searchResponse->json();
        $movies = [];

        if (!empty($searchResults['Search'])) {
            foreach ($searchResults['Search'] as $movie) {
                $details = Http::get('http://www.omdbapi.com/', [
                    'apikey' => env('OMDB_API_KEY'),
                    'i' => $movie['imdbID'],
                    'plot' => 'short',
                    'r' => 'json'
                ])->json();

                if (!empty($details) && $details['Response'] === "True") {
                    $movies[] = $details;
                }
            }
        }

        return view('movies.index', compact('movies', 'search'));
    }

    // --- Like a movie ---
    public function likeMovie(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $sessionId = session()->getId();

        // Check if this session already has a record
        $liked = LikedMovie::where('session_id', $sessionId)->first();

        if ($liked) {
            // Add new title if not already liked
            $titles = $liked->titles ?? [];
            if (!in_array($request->title, $titles)) {
                $titles[] = $request->title;
                $liked->update(['titles' => $titles]);
            }
        } else {
            // Create a new record for this session
            LikedMovie::create([
                'session_id' => $sessionId,
                'titles' => [$request->title],
            ]);
        }

        return back()->with('success', 'Movie added to your liked list!');
    }

    // --- Get AI Recommendations ---
public function recommendations()
{
    $movies = LikedMovie::pluck('titles')->first();

    if (!$movies) {
        return back()->with('error', 'No liked movies found.');
    }

    // ✅ Decode only if not already an array
    $likedMovies = is_array($movies) ? $movies : json_decode($movies, true);

    if (empty($likedMovies)) {
        return back()->with('error', 'No liked movies found.');
    }

    // ✅ Python recommender API URL
    $apiUrl = 'http://127.0.0.1:3000/recommend';

    // ✅ Send JSON correctly
    $response = \Illuminate\Support\Facades\Http::asJson()->post($apiUrl, [
        'liked_movies' => $likedMovies,
        'n' => 5,
    ]);

    if ($response->failed()) {
        \Log::error('Python API failed', ['status' => $response->status(), 'body' => $response->body()]);
        return back()->with('error', 'Failed to connect to the recommendation server.');
    }

    $data = $response->json();
    $recommendations = $data['recommendations'] ?? [];

    if (empty($recommendations)) {
        return back()->with('error', 'No recommendations available.');
    }

    return view('movies.recommendations', compact('recommendations'));
}

}
