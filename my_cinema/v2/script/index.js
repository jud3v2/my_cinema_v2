document.addEventListener('DOMContentLoaded', function () {
    const buttonFormElement = document.querySelector('#search-movie-by-name-or-distributor-or-genre');
    const loadingTextElement = document.querySelector('#loading_text');
    const limitElement = document.querySelector('#nbr_result');

    if(buttonFormElement) {
        buttonFormElement.addEventListener('click', function (event) {
            event.preventDefault();
            loadingTextElement.classList.remove('hidden');
            loadingTextElement.classList.add('block');

            const inputElement = document.querySelector("input[name='query']");
            const dateElement = document.querySelector("input[name='date']");
            const genre = document.querySelector("#search_type").value;
            const xhr = new XMLHttpRequest();

            xhr.open('POST', `http://localhost:8000/pages/api/movies/search.php?query=${inputElement.value}&date=${dateElement.value}&limit=${limitElement.value}&genre=${genre}`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onerror = function () {
                console.log('Error');
            };

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // si la réponse est un succès
                    // et que data n'est pas vide on va stocker dans le localStorage la réponse
                    // et rediriger l'utilisateur vers la page de recherche
                    const response = JSON.parse(xhr.response);
                    localStorage.setItem('search', JSON.stringify(response.data));
                    window.location.href = 'http://localhost:8000/pages/search.php?redirect=true&refresh=true';
                } else {
                    // La requête a échoué, gérer l'erreur ici
                    alert("La requête a échoué, avec le code status : " + xhr.status);
                }
            };
            const params = new URLSearchParams("?query=" + inputElement.value + "&date=" + dateElement.value + "&limit=" + limitElement.value);
            xhr.send(JSON.stringify({
                query: params.get('query'),
                date: dateElement.value
            }));

            // reset loading text
            loadingTextElement.classList.remove('block');
            loadingTextElement.classList.add('hidden');
        });
    }
});