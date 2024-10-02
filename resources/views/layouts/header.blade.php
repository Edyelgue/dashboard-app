<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="resources/css/app.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('../app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>NOC</title>
</head>

<body class="h-full">
    <header class="text-gray-600 body-font fixed flex justify-between w-full bg-black z-10">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center justify-between">
            <a class="flex title-font font-medium items-center mb-4 md:mb-0">
                <img src="{{ asset('images/logo-desktop.png') }}" alt="Descrição da Imagem" class="h-10 bg-black">
            </a>


            <!-- Menu de navegação -->
            <nav id="menu" class="hidden lg:flex md:ml-auto md:mr-auto flex-wrap items-center text-base justify-center w-full md:w-auto">
                <a class="mr-5 hover:text-gray-900" href="/">Incidente</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-900" href="#">Solicitação de Mudança</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-900" href="#">Investigação de Problema</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-900" href="#">Ordem de Trabalho</a>
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
                            aria-label="Light"
                            value="cupcake"
                            checked />
                    </li>
                    <li>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            class="theme-controller btn btn-sm btn-block btn-ghost justify-start"
                            aria-label="Dark"
                            value="dark" />
                    </li>
                </ul>
            </div>
            <!-- Ícone de hambúrguer para telas pequenas -->
            <button id="menu-toggle" class="block lg:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <!-- Menu de navegação -->
            <nav id="menu" class="hidden lg:flex md:ml-auto md:mr-auto flex-wrap items-center text-base justify-center w-full md:w-auto">
                <a class="mr-5 hover:text-gray-900" href="/">Incidente</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-900" href="#">Solicitação de Mudança</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-900" href="#">Investigação de Problema</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-900" href="#">Ordem de Trabalho</a>
            </nav>
        </div>
    </header>
    <script>
        // Script para alternar a visibilidade do menu no modo mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>