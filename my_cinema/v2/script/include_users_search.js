//TODO: ici logiquement pas besoin de pagination.

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
        return +jourMois + " " + mois + " " + annee;
}

onClickShowModalForUpdateUser = (event, user) => {
        event.preventDefault();
        const firstnameElement = document.querySelector('#firstname');
        const lastnameElement = document.querySelector('#lastname');
        const emailElement = document.querySelector('#email');
        const birthdateElement = document.querySelector('#birthdate');
        const cityElement = document.querySelector('#city');
        const countryElement = document.querySelector('#country');
        const zipcodeElement = document.querySelector('#zipcode');
        const addressElement = document.querySelector('#address');

        // put user data in modal
        firstnameElement.value = user.firstname;
        lastnameElement.value = user.lastname;
        emailElement.value = user.email;
        birthdateElement.value = user.birthdate;
        cityElement.value = user.city;
        countryElement.value = user.country;
        zipcodeElement.value = user.zipcode;
        addressElement.value = user.address;

        setTimeout(() => {
                const modalElement = document.querySelector('#modal');
                modalElement.classList.remove('hidden');
        }, 1);
};
document.addEventListener('DOMContentLoaded', async function () {
        const showLoadingStateElement = document.querySelector('#show-loading-state');
        showLoadingStateElement.innerHTML = "<p class='text-bold py-3  text-xl font-black'>Chargement des utilisateurs...</p>";

        const users = await fetch('/pages/api/users/index.php')
            .then(response => {
                    return response.json()
            });

        if (users) {
                localStorage.setItem('users', JSON.stringify(users));
        }

        const tableElement = document.querySelector('#include_users_search');

        const pagesNumber = users.length / 30;

        const elementPagination = document.querySelector('#insert_number_of_pages');

        let currentPages = 1;
        let start = 0;
        let end = 30;

        for (let i = 0;  i < pagesNumber;  i++) {
                // insert element into pagination block
                elementPagination.innerHTML += `<li><a href="#" id="page-${i + 1}"
                class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i + 1}</a>
                </li>`;
        }

        for(let i = 0; i < pagesNumber; i++) {
                // add event listener on each page
                const pageElement = document.querySelector('#page-' + (i + 1));
                pageElement.addEventListener('click', event => {
                        event.preventDefault();
                        currentPages = i + 1;
                        start = i * 30;
                        end = start + 30;

                        // DOM TRICKS
                        setTimeout(() => {
                                const showStartStatementElement = document.querySelector('#start');
                                const showEndStatementElement = document.querySelector('#total');
                                showStartStatementElement.innerHTML = start + 1;
                                showEndStatementElement.innerHTML = users.length;
                        }, 1)


                        tableElement.innerHTML = "";

                        const data = users.slice(start, end);
                        data.forEach(user => {
                                const id = user.id;
                                tableElement.innerHTML += `
                                        <tr class="bg-white dark:bg-gray-800">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            ${user.firstname}
                                        </th>
                                        <td class="px-6 py-4">
                                            ${user.lastname}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${user.email}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${formaterDate(user.birthdate)}
                                        </td>
                                      <td class="px-6 py-4">
                                            ${user.city}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${user.country}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button  id="user-${user.id}" type="button" class="text-white text-xs bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                                                Modifier
                                            </button>
                                            <button  id="user-history-${user.id}" type="button" class="text-white text-xs bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                                                Historique
                                            </button>
                                        </td>
                                    </tr>`;

                                // DOM TRICKS
                                setTimeout(() => {
                                        const buttonElement = document.getElementById('user-' + id);
                                        buttonElement.addEventListener('click', event => {
                                                onClickShowModalForUpdateUser(event, user);
                                        });
                                        const historyElement = document.getElementById('user-history-' + id);
                                        historyElement.addEventListener('click', event => {
                                                event.preventDefault();
                                                window.location.href = "http://localhost:8000/pages/history.php?email=" + user.email;
                                        });
                                }, 1);
                        });
                })
        }

        const data = users.slice(start, end);

        // DOM TRICKS
        setTimeout(() => {
                const showStartStatementElement = document.querySelector('#start');
                const showEndStatementElement = document.querySelector('#total');
                showStartStatementElement.innerHTML = start + 1;
                showEndStatementElement.innerHTML = users.length;
        }, 1)


        data.forEach(user => {
                const id = user.id;
                tableElement.innerHTML += `
                        <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${user.firstname}
                        </th>
                        <td class="px-6 py-4">
                            ${user.lastname}
                        </td>
                        <td class="px-6 py-4">
                            ${user.email}
                        </td>
                        <td class="px-6 py-4">
                            ${formaterDate(user.birthdate)}
                        </td>
                      <td class="px-6 py-4">
                            ${user.city}
                        </td>
                        <td class="px-6 py-4">
                            ${user.country}
                        </td>
                        <td class="px-6 py-4">
                            <button  id="user-${user.id}" type="button" class="text-white text-xs bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                                Modifier
                            </button>
                            <button  id="user-history-${user.id}" type="button" class="text-white text-xs bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                                Historique
                            </button>
                        </td>
                    </tr>`;

                // DOM TRICKS
                setTimeout(() => {
                        const buttonElement = document.getElementById('user-' + id);
                        buttonElement.addEventListener('click', event => {
                                onClickShowModalForUpdateUser(event, user);
                        });
                        const historyElement = document.getElementById('user-history-' + id);
                        historyElement.addEventListener('click', event => {
                                event.preventDefault();
                                window.location.href = "http://localhost:8000/pages/history.php?email=" + user.email;
                        });
                }, 1);
        });

        showLoadingStateElement.innerHTML = "";
});