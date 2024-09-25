<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" /> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>NOC</title>
</head>

<body>
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">NOC</span>
            </a>
            <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900">First Link</a>
                <a class="mr-5 hover:text-gray-900">Second Link</a>
                <a class="mr-5 hover:text-gray-900">Third Link</a>
                <a class="mr-5 hover:text-gray-900">Fourth Link</a>
            </nav>
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn m-1">
                    Theme
                    <svg
                        width="12px"
                        height="12px"
                        class="inline-block h-2 w-2 fill-current opacity-60"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 2048 2048">
                        <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                    </svg>
                </div>
                <ul tabindex="0" class="dropdown-content bg-base-300 rounded-box z-[1] w-52 p-2 shadow-2xl">
                    <li>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                            aria-label="Default"
                            value="light" />
                    </li>
                    <li>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                            aria-label="Night"
                            value="night" />
                    </li>
                    <li>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                            aria-label="Dracula"
                            value="dracula" />
                    </li>
                    <li>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                            aria-label="Dark"
                            value="dark" />
                    </li>
                    <li>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                            aria-label="Cupcake"
                            value="cupcake" />
                    </li>
                </ul>
            </div>
        </div>
    </header>