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

function getEmailParameter() {
        // Use URLSearchParams to parse the query parameters
        const urlSearchParams = new URLSearchParams(window.location.search);

        if(urlSearchParams.has('email')) {
                return urlSearchParams.get('email');
        } else {
                return false;
        }
}

(async () => {
        if(getEmailParameter()) {
                const params =  getEmailParameter();
                document.querySelector('#default-search').value = params;
                await makeOperation();
        }
})()

async function makeOperation() {
        const searchValue = document.querySelector('#default-search').value;
        const email = encodeURI(searchValue);
        const request = await fetch(`http://localhost:8000/pages/api/subscription/index.php?email=${email}`);
        const response = await request.json();
        if (response.length === 0) {
                return alert("L'utilisateur n'a pas d'abonnement");
        }

        alert("L'abonnement de l'utilisateur: " + response[0].name + " description: " + response[0].description + " prix: " + response[0].price + "€");

        const tableElement = document.querySelector('#history-table');
        response.map((item) => {
                tableElement.innerHTML += `
                        <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${item.firstname}
                        </th>
                        <td class="px-6 py-4">
                            ${item.lastname}
                        </td>
                        <td class="px-6 py-4">
                            ${item.title}
                        </td>
                        <td class="px-6 py-4">
                            ${formaterDuree(item.duration)}
                        </td>
                      <td class="px-6 py-4">
                            ${item.name}
                        </td>
                        <td class="px-6 py-4">
                            ${item.city}
                        </td>
                        <td class="px-6 py-4">
                            ${item.country}
                        </td>
                    </tr>
                        `
        });
}

document.addEventListener('DOMContentLoaded', async function() {
        const buttonForm = document.querySelector('#search-button');

        buttonForm.addEventListener('click', async function(e) {
                e.preventDefault();
                await makeOperation();
        });
});