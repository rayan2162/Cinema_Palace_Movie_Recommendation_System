# Cinema Palace - Movie Recommendation System

This project is a **two-part AI-powered movie recommendation system**.
The **Laravel** part serves as the **frontend and user management system**, while the **Python FastAPI** service (available [here](https://github.com/rayan2162/Ai_Movie_Recommendation_API.git)) handles the **recommendation logic** using the **MovieLens dataset** and **TF-IDF cosine similarity**.

## How It Works

1. Users search for movies using the OMDB API from the Laravel interface.
2. They can "like" movies, which are stored in a local database (by session).
3. When users click **“View Recommendations”**, Laravel sends the liked movie titles as a JSON payload to the Python API (`/recommend` endpoint).
4. The Python API responds with a list of recommended movies.
5. Laravel displays these results in a clean, TailwindCSS-styled interface.

This design separates the **frontend/user flow (Laravel)** from the **machine learning logic (Python)** for modularity, scalability, and maintainability.


## Features

- Search movies via OMDB API
- Like and save movies (session-based)
- AI-powered movie recommendations via FastAPI
- Responsive TailwindCSS UI
- Laravel 12 + PHP 8.2
- Python FastAPI backend integration

## Functionality Overview

| Component           | Function                                                                  |
| ------------------- | ------------------------------------------------------------------------- |
| **Search Page**     | Fetch movies by title from OMDB API                                       |
| **Like System**     | Save liked movies in database (as JSON)                                   |
| **Recommendations** | Send liked titles to FastAPI, get recommendations                         |
| **Python API**      | Processes the data, finds similar movies using TF-IDF & cosine similarity |
| **UI Layer**        | Displays recommended movies neatly with poster and details                |

## 1. Clone & Setup

```bash
git clone https://github.com/yourusername/laravel_movie_recommender.git
cd laravel_movie_recommender
composer install
cp .env.example .env
php artisan key:generate
```

## 2. Database Setup

Make sure your `.env` file has proper database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movie_db
DB_USERNAME=root
DB_PASSWORD=
```

Then migrate:

```bash
php artisan migrate
```

## 3. OMDB API Setup

Get your free OMDB API key from [https://www.omdbapi.com/apikey.aspx](https://www.omdbapi.com/apikey.aspx)
and add it to `.env`:

```env
OMDB_API_KEY=your_omdb_api_key_here
```

## 4. Run Python API

Clone the backend API and start the FastAPI server:

```bash
git clone https://github.com/rayan2162/Ai_Movie_Recommendation_API.git
cd Ai_Movie_Recommendation_API
pip install -r requirements.txt
python recomender_api.py
```

This will start the server on:

```
http://127.0.0.1:3000
```

## 5. Run Laravel Server

In your Laravel project folder:

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

## Example Workflow

1. Open `http://127.0.0.1:8000`
2. Search for any movie (e.g., “Batman”)
3. Like one or more movies
4. Click **“View Recommendations”**
5. Laravel sends your liked movie list to FastAPI
6. Recommended movies are displayed instantly 🎥

---

## Technologies Used

* **Laravel 12**
* **PHP 8.2**
* **TailwindCSS**
* **MySQL**
* **OMDB API**
* **FastAPI (Python)**
* **Pandas, scikit-learn (for ML)**

---

## Related Repository

Ai_Movie_Recommendation_API: [rayan2162/Ai_Movie_Recommendation_API](https://github.com/rayan2162/Ai_Movie_Recommendation_API.git)