
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

function formatToYYYYMMDD(date) {
        date = new Date(date);
        const year = date.getUTCFullYear();
        const month = String(date.getUTCMonth() + 1).padStart(2, '0'); // Months are zero-based
        const day = String(date.getUTCDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
}

onClickShowModalForUpdateUser = (event, user) => {
        event.preventDefault();
        const modalElement = document.querySelector('#modal');
        modalElement.classList.remove('hidden');

        const cancelButtonElement = document.querySelector('#close-modal');
        cancelButtonElement.addEventListener('click', event => {
                event.preventDefault();
                modalElement.classList.add('hidden');
        });

        setTimeout(() => {
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
                birthdateElement.value = formatToYYYYMMDD(user.birthdate);
                cityElement.value = user.city;
                countryElement.value = user.country;
                zipcodeElement.value = user.zipcode;
                addressElement.value = user.address;

                const id = event.target.id.split('-')[1];

                const updateButtonElement = document.querySelector('#update-user-button');
                const deleteButtonElement = document.querySelector('#delete-user-button');

                deleteButtonElement.addEventListener('click',  event => {
                        event.preventDefault();
                        if(window.confirm("Attention vous vous appreter a supprimer l'utilisateur: " + user.firstname + " " + user.lastname)) {
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', '/pages/api/users/delete.php');
                                xhr.setRequestHeader('Content-Type', 'application/json');
                                xhr.onload = () => {
                                        if (xhr.status === 200) {
                                                alert('Utilisateur supprimé avec succès');
                                                setTimeout(() => {
                                                        window.location.reload();
                                                }, 1500);
                                        } else {
                                                alert('Une erreur est survenue, veuillez réessayer plus tard');
                                        }
                                };
                                xhr.send(JSON.stringify({
                                        id: id
                                }));
                        }
                });

                updateButtonElement.addEventListener('click', async event => {
                        event.preventDefault();
                        // make the same but in XMLHTTPREQUEST
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '/pages/api/users/update.php');
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.onload = () => {
                                if (xhr.status === 200) {
                                        alert('Utilisateur modifié avec succès');
                                } else {
                                        alert('Une erreur est survenue, veuillez réessayer plus tard');
                                }
                        };
                        xhr.send(JSON.stringify({
                                id: id,
                                firstname: firstnameElement.value,
                                lastname: lastnameElement.value,
                                email: emailElement.value,
                                birthdate: birthdateElement.value,
                                city: cityElement.value,
                                country: countryElement.value,
                                zipcode: zipcodeElement.value,
                                address: addressElement.value
                        }));
                });
        }, 1);
};

document.addEventListener('DOMContentLoaded', function () {
        const buttonElement = document.querySelector('#form-button');
        buttonElement.addEventListener('click', async function (event) {
                event.preventDefault();
                const inputValue = document.querySelector('#default-search').value;

                // récupère les datas
                const data = localStorage.getItem('users')
                    ? JSON.parse(localStorage.getItem('users'))
                    : await fetch('/pages/api/users/index.php')
                        .then(response => response.json())

                if (data.length > 0) {
                        // filtre les datas
                        const filteredData = data.filter(user => {
                                return user.firstname.toLowerCase().includes(inputValue.toLowerCase())
                                        || user.lastname.toLowerCase().includes(inputValue.toLowerCase())
                                        || user.email.toLowerCase().includes(inputValue.toLowerCase())
                                        || user.birthdate.toLowerCase().includes(inputValue.toLowerCase())
                                        || user.city.toLowerCase().includes(inputValue.toLowerCase())
                                        || user.country.toLowerCase().includes(inputValue.toLowerCase())
                        });
                        const tableElement = document.querySelector('#include_users_search');
                        // clear le tableau par les data de la recherche
                        tableElement.innerHTML = "";
                        if(filteredData.length > 0) {
                                filteredData.map((user) => {
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
                    </tr>
                        `;
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
                        } else {
                                window.alert('Aucun utilisateur trouvé avec votre recherche: ' + inputValue );
                        }
                } else {
                        window.alert('Aucun utilisateur chargé');
                }
        });
});