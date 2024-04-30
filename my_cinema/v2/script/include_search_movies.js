//TODO: faire la pagination pour la recherche des films.

function formaterDate(dateString) {
    // Création d'un objet Date à partir de la chaîne de caractères
    let dateObject = new Date(dateString);

    // Jours de la semaine en français
    let joursSemaine = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

    // Mois de l'année en français
    let moisAnnee = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

    // Récupération du jour de la semaine, du jour du mois et du mois
    let jourSemaine = joursSemaine[dateObject.getDay()];
    let jourMois = dateObject.getDate();
    let mois = moisAnnee[dateObject.getMonth()];
    let annee = dateObject.getFullYear();

    // Construction de la date au format souhaité
    return jourSemaine + " " + jourMois + " " + mois + " " + annee;
}

function formaterDureeEnHeuresMinutes(dureeEnMinutes) {
    // Calcul du nombre d'heures
    let heures = Math.floor(dureeEnMinutes / 60);

    // Calcul du nombre de minutes restantes
    let minutes = dureeEnMinutes % 60;

    // Construction de la durée au format souhaité
    return heures + " H " + minutes + " minutes";
}

document.addEventListener('DOMContentLoaded', function () {
        const myElemement = document.querySelector('#include_search_movies');
        if(localStorage.getItem('search') !== null) {
            const response = JSON.parse(localStorage.getItem('search'));
            response.map(function (movie) {
                myElemement.innerHTML += `
<a href="#" class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${movie.title}</h5>
<p class="text-gray-700 dark:text-gray-400 font-bold">Date de parution: ${formaterDate(movie.release_date)}</p>
<p class="font-normal text-gray-700 dark:text-gray-400">Directeur: ${movie.director}</p>
<p class="font-normal text-gray-700 dark:text-gray-400">
    Durée du film:
    <span class="font-black">
    ${formaterDureeEnHeuresMinutes(movie.duration)}
</span>
</p>
</a>`
            })
        }
});