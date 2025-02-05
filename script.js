document.getElementById('searchButton').addEventListener('click', function () {
    let query = document.getElementById('searchInput').value.trim();
    if (query === '') {
        alert('Please enter a movie title');
        return;
    }

    document.getElementById('results').innerHTML = '';
    document.getElementById('loader').style.display = 'block';

    fetch(`movies.php?query=${query}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('loader').style.display = 'none';

            if (data.results.length === 0) {
                document.getElementById('results').innerHTML = '<p class="text-center">No movies found.</p>';
                return;
            }

            let output = '';
            data.results.forEach(movie => {
                let poster = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'no-image.jpg';
                output += `
                    <div class="col-md-3 mb-4">
                        <div class="card movie-card" onclick="showMovieDetails(${movie.id})">
                            <img src="${poster}" class="card-img-top" alt="${movie.title}">
                            <div class="card-body">
                                <h5 class="card-title">${movie.title}</h5>
                                <p class="card-text"><strong>Year:</strong> ${movie.release_date ? movie.release_date.split('-')[0] : 'N/A'}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            document.getElementById('results').innerHTML = output;
        })
        .catch(error => {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('results').innerHTML = '<p class="text-danger">Error fetching data.</p>';
        });
});

function showMovieDetails(movieId) {
    fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=70627ccdd6de8f42816d575f8bd604e5&language=en-US`)
        .then(response => response.json())
        .then(movie => {
            let details = `
                <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" class="img-fluid mb-3">
                <p><strong>Rating:</strong> ${movie.vote_average}</p>
                <p><strong>Genres:</strong> ${movie.genres.map(g => g.name).join(', ')}</p>
                <p><strong>Runtime:</strong> ${movie.runtime} min</p>
                <p>${movie.overview}</p>
            `;
            document.getElementById('movieTitle').innerText = movie.title;
            document.getElementById('movieDetails').innerHTML = details;
            new bootstrap.Modal(document.getElementById('movieModal')).show();
        })
        .catch(error => {
            document.getElementById('movieDetails').innerHTML = '<p class="text-danger">Error loading movie details.</p>';
        });
}
