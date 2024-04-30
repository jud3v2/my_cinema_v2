function formaterDuree(minutes) {
        if (isNaN(minutes) || minutes < 0) {
                return "Veuillez fournir un nombre de minutes valide.";
        }

        const heures = Math.floor(minutes / 60);
        const minutesRestantes = minutes % 60;

        const heuresTexte = heures > 0 ? heures + "h" : "";
        const minutesTexte = minutesRestantes > 0 ? minutesRestantes + "min" : "";

        return heuresTexte + (heures > 0 && minutesRestantes > 0 ? " " : "") + minutesTexte;
}

function formaterDate(dateString) {
        // Création d'un objet Date à partir de la chaîne de caractères
        let dateObject = new Date(dateString);

        // Mois de l'année en français
        let moisAnnee = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

        // Récupération du jour de la semaine, du jour du mois et du mois
        let jourMois = dateObject.getDate();
        let mois = moisAnnee[dateObject.getMonth()];
        let annee = dateObject.getFullYear();

        // Construction de la date au format souhaité
        return  + jourMois + " " + mois + " " + annee;
}


document.addEventListener('DOMContentLoaded', async function() {
        let elements = document.querySelector('#submit-schedule-button');
        const response = await fetch("/pages/api/schedule/index.php");
        let data = await response.json();
        localStorage.setItem('schedule', JSON.stringify(data));

        let start = 0;
        let perPage = 100;
        let end = perPage;
        let nbrOfPages = Math.ceil(data.length / perPage);
        let filteredData = data.slice(start, end);

        elements.onclick = async function(e) {
                e.preventDefault();
                const search = document.querySelector('#default-search').value;
                console.log(search);
                filteredData = filteredData.filter(schedule => schedule.title.toLowerCase().includes(search.toLowerCase()));

                const tableElement = document.querySelector('#include_schedule');
                tableElement.innerHTML = "";
                filteredData.map(schedule => {
                        tableElement.innerHTML += `
                        <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            ${schedule.title}
                                        </th>
                                        <td class="px-6 py-4">
                                            ${schedule.director}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${formaterDuree(schedule.duration)}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${formaterDate(schedule.date_begin)}
                                        </td>
                                      <td class="px-6 py-4">
                                            ${formaterDate(schedule.release_date)}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${schedule.name}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${schedule.seats}
                                        </td>
                                    </tr>
                        `;
                });
        }

        const tableElement = document.querySelector('#include_schedule');

        filteredData.map(schedule => {
                tableElement.innerHTML += `
                <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            ${schedule.title}
                                        </th>
                                        <td class="px-6 py-4">
                                            ${schedule.director}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${formaterDuree(schedule.duration)}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${formaterDate(schedule.date_begin)}
                                        </td>
                                      <td class="px-6 py-4">
                                            ${formaterDate(schedule.release_date)}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${schedule.name}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${schedule.seats}
                                        </td>
                                    </tr>
                `;
        });

        const paginationElement = document.querySelector('#insert_number_of_pages');

        for (let i = 0; i < nbrOfPages; i++) {
                paginationElement.innerHTML += `
                       <li><a href="#" id="page-${i + 1}"
                class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i + 1}</a>
                </li>`;

                // Dom tricks
                // Need to wait for the link up into the dom before adding each listener
                setTimeout(() => {
                        document.querySelector('#page-' + (i + 1 )).addEventListener('click', function(e) {
                                e.preventDefault();
                                start = i * perPage;
                                end = start + perPage;
                                const filteredData = data.slice(start, end);
                                const tableElement = document.querySelector('#include_schedule');
                                tableElement.innerHTML = "";
                                filteredData.map(schedule => {
                                        tableElement.innerHTML += `
                                <tr class="bg-white dark:bg-gray-800">
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            ${schedule.title}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            ${schedule.director}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${formaterDuree(schedule.duration)}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${formaterDate(schedule.date_begin)}
                                                        </td>
                                                      <td class="px-6 py-4">
                                                            ${formaterDate(schedule.release_date)}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${schedule.name}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${schedule.seats}
                                                        </td>
                                                    </tr>
                                `;
                                });
                        });
                }, 1);
        }
});