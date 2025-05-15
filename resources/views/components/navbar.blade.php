<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/app.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('../app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>NOC</title>
</head>

<body class="h-full">
    <header class="text-gray-600 body-font fixed flex justify-between w-full bg-black z-10">
        <div class="container mx-auto flex flex-wrap p-5 md:flex-row items-center justify-between">
            <a class="flex title-font font-medium items-center mb-4 md:mb-0">
                <img src="{{ asset('images/logo-desktop.png') }}" alt="Descrição da Imagem" class="h-10 bg-black">
            </a>

            {{-- Menu de navegação para desktop --}}
            <nav id="desktop-menu" class="hidden lg:flex md:ml-auto md:mr-auto flex-wrap items-center text-base justify-center w-full md:w-auto">
                <a class="mr-5 hover:text-gray-500 text-gray-300" href="/">Incidentes</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-500 text-gray-300" href="#">Solicitação de Mudanças</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-500 text-gray-300" href="#">Investigação de Problemas</a><span class="mr-5 text-gray-300 font-thin">|</span>
                <a class="mr-5 hover:text-gray-500 text-gray-300" href="#">Ordens de Trabalho</a>
            </nav>

            {{-- Ícone de hambúrguer para telas pequenas --}}
            <button id="menu-toggle" class="block lg:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            {{-- Menu de navegação para mobile --}}
            <nav id="mobile-menu" class="hidden lg:hidden flex-wrap items-center text-base justify-center w-full lg:w-auto dropdown">
                <ul>
                    <li><a class="mr-5 hover:text-gray-500 text-gray-100" href="/">Incidente</a></li>
                    <li><a class="mr-5 hover:text-gray-500 text-gray-100" href="#">Solicitação de Mudança</a></li>
                    <li><a class="mr-5 hover:text-gray-500 text-gray-100" href="#">Investigação de Problema</a></li>
                    <li><a class="mr-5 hover:text-gray-500 text-gray-100" href="#">Ordem de Trabalho</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        // Script para alternar a visibilidade do menu no modo mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>