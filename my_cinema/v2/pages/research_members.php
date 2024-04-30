<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <title>My Cinema Rechercher un membre</title>
</head>
<body>

<?php include "partials/navbar.php"?>

<main class="mx-3">
    <div>
        <h1 class="text-bold py-3 text-4xl  font-black">Rechercher un membre !</h1>
    </div>
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://placehold.co/600x400" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://placehold.co/600x400" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://placehold.co/600x400" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://placehold.co/600x400" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://placehold.co/600x400" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
        </button>
    </div>

    <div>
        <h3 class="text-bold py-3  text-xl font-black">Rechercher un membre</h3>
    </div>
    <div class="py-5 mb-5">
        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Rechercher</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher un membre." required>
                <button type="submit" id="form-button" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rechercher</button>
            </div>
        </form>
    </div>

    <h3 class="text-bold py-3 text-4xl  font-black text-center">Liste des utilisateurs</h3>
    <div id="show-loading-state">

    </div>
    <div class="fixed overflow-y-auto top-0 w-full left-0 hidden" id="modal" style="z-index: 9999999999">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <label for="firstname" class="font-medium text-gray-800">Prénom du membre</label>
                    <input id="firstname" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="lastname" class="font-medium text-gray-800">Nom du  membre</label>
                    <input id="lastname" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="email" class="font-medium text-gray-800">Email du membre</label>
                    <input id="email" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="birthdate" class="font-medium text-gray-800">Date d'anniversaire du membre</label>
                    <input id="birthdate" type="date" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="city" class="font-medium text-gray-800">Ville du membre</label>
                    <input id="city" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="country" class="font-medium text-gray-800">Pays du membre</label>
                    <input id="country" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="zipcode" class="font-medium text-gray-800">Code postal du membre</label>
                    <input id="zipcode" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    <label for="address" class="font-medium text-gray-800">Adresse du membre</label>
                    <input id="address" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button"  id="close-modal" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" ><i class="fas fa-times"></i> Annuler</button>
                    <button type="button" id="update-user-button" class="py-2 px-4 bg-blue-500 text-white rounded font-medium hover:bg-blue-700 mr-2 transition duration-500"><i class="fas fa-plus"></i> Modifier</button>
                    <button type="button" id="delete-user-button" class="py-2 px-4 bg-red-500 text-white rounded font-medium hover:bg-red-700 mr-2 transition duration-500"><i class="fas fa-plus"></i> Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Prénom
            </th>
            <th scope="col" class="px-6 py-3">
                Nom
            </th>
            <th scope="col" class="px-6 py-3">
                Email
            </th>
            <th scope="col" class="px-6 py-3">
                Date d'anniversaire
            </th>
            <th scope="col" class="px-6 py-3">
                Ville
            </th>
            <th scope="col" class="px-6 py-3">
                Pays
            </th>
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
        </thead>
        <tbody id="include_users_search">
        </tbody>
    </table>
    <section>
        <div class="w-full max-w-screen-xl px-4 mx-auto lg:px-12 p-5">
            <!-- Start coding here -->
            <div class="relative overflow-hidden bg-white rounded-b-lg shadow-md dark:bg-gray-800">
                <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                     aria-label="Table navigation">
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Affichage de <span
                      class="font-semibold text-gray-900 dark:text-white" id="start"></span> sur <span
                      class="font-semibold text-gray-900 dark:text-white" id="total"></span></span>
                    <ul id="insert_number_of_pages" class="inline-flex items-stretch -space-x-px">

                    </ul>
                </nav>
            </div>
        </div>
    </section>
</main>
<footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="https://flowbite.com/" class="hover:underline">My Cinema™</a>. All Rights Reserved.
    </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="/" class="hover:underline me-4 md:me-6">Accueil</a>
            </li>
            <li>
                <a href="/pages/research_members.php" class="hover:underline me-4 md:me-6">Rechercher un membre</a>
            </li>
            <li>
                <a href="/pages/my_subscription.php" class="hover:underline me-4 md:me-6">Mon abonnement</a>
            </li>
            <li>
                <a href="/pages/schedule.php" class="hover:underline">Programmer une séance</a>
            </li>
        </ul>
    </div>
</footer>
</body>
<script src="http://localhost:8000/script/index.js"></script>
<script src="http://localhost:8000/script/include_users_search.js"></script>
<script src="http://localhost:8000/script/user_search.js"></script>
</html>
