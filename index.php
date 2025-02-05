<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .movie-card { cursor: pointer; transition: transform 0.2s; }
        .movie-card:hover { transform: scale(1.05); }
        .loader { display: none; text-align: center; font-size: 20px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Movie Search 🎬</h1>

    <!-- Search Bar -->
    <div class="input-group my-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Enter movie title...">
        <button class="btn btn-primary" id="searchButton">Search</button>
    </div>

    <!-- Loader -->
    <div class="loader" id="loader">Loading...</div>

    <!-- Results -->
    <div class="row" id="results"></div>
</div>

<!-- Movie Details Modal -->
<div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="movieTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="movieDetails"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
