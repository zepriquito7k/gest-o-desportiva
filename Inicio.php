<!DOCTYPE html>
<html lang="pt" class="light">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Dashboard Gestão Desportiva - Midone Template</title>
    <link rel="stylesheet" href="dist/css/app.css" />
    <style>
        /* DICA HORIZONTAL: Para ajudar a depurar overflows, pode adicionar temporariamente: */
        /* * {
            outline: 1px solid red !important;
        }
        */
    </style>
</head>

<body class="app flex flex-col min-h-screen">

    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.png">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-theme-24 py-5 hidden">
            <li><a href="dashboard.html" class="menu menu--active"><div class="menu__icon"> <i data-feather="home"></i> </div><div class="menu__title"> Início </div></a></li>
            <li><a href="admin-utilizadores.html" class="menu"><div class="menu__icon"> <i data-feather="users"></i> </div><div class="menu__title"> Utilizadores </div></a></li>
            <li><a href="admin-modalidades.html" class="menu"><div class="menu__icon"> <i data-feather="award"></i> </div> <div class="menu__title"> Modalidades </div></a></li>
            <li><a href="admin-treinadores.html" class="menu"><div class="menu__icon"> <i data-feather="clipboard"></i> </div> <div class="menu__title"> Treinadores </div></a></li>
            <li><a href="admin-atletas.html" class="menu"><div class="menu__icon"> <i data-feather="activity"></i> </div> <div class="menu__title"> Atletas </div></a></li>
            <li><a href="admin-logs.html" class="menu"><div class="menu__icon"> <i data-feather="file-text"></i> </div><div class="menu__title"> Logs do Sistema </div></a></li>
            <li><a href="meu-perfil.html" class="menu"><div class="menu__icon"> <i data-feather="user"></i> </div><div class="menu__title"> Meu Perfil </div></a></li>
        </ul>
    </div>
    <div class="border-b border-gray-200 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
        <div class="top-bar-boxed flex items-center">
            <a href="dashboard.html" class="-intro-x hidden md:flex"> <img alt="Logo Gestão Desportiva" class="w-6" src="dist/images/logo.png">
                <span class="text-white text-lg ml-3"> Gestão <span class="font-medium">Desportiva</span> </span>
            </a>
            <div class="-intro-x breadcrumb breadcrumb--light mr-auto">
                <a href="" class="">Aplicação</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                <a href="" class="breadcrumb--active">Início</a> </div>
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                    <img alt="Foto Perfil" src="dist/images/profile-13.png"> </div>
                <div class="dropdown-box w-56">
                    <div class="dropdown-box__content box bg-dark-1 dark:bg-dark-6 text-white">
                        <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                            <div class="font-medium">NOME DO UTILIZADOR</div> <div class="text-xs text-theme-41 dark:text-gray-600">PERFIL</div> </div>
                        <div class="p-2" style="background-color: #373636;">
                            <a href="meu-perfil.html" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="user" class="w-4 h-4 mr-2"></i> Perfil
                            </a>
                            <a href="alterar-password.html" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="lock" class="w-4 h-4 mr-2"></i> Alterar Password
                            </a>
                        </div>
                        <div class="p-2" style="background-color: #373636;">
                            <a href="login-light-login.html" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="top-nav">
        <ul>
            <li><a href="dashboard.html" class="top-menu top-menu--active"> <div class="top-menu__icon"> <i data-feather="home"></i> </div><div class="top-menu__title"> Início </div></a></li>
            <li>
                <a href="javascript:;" class="top-menu">
                    <div class="top-menu__icon"> <i data-feather="settings"></i> </div>
                    <div class="top-menu__title"> Administração <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                </a>
                <ul class="">
                    <li><a href="admin-utilizadores.html" class="top-menu"><div class="top-menu__icon"><i data-feather="users"></i></div><div class="top-menu__title">Utilizadores</div></a></li>
                    <li><a href="admin-modalidades.html" class="top-menu"><div class="top-menu__icon"><i data-feather="award"></i></div><div class="top-menu__title">Modalidades</div></a></li>
                    <li><a href="admin-treinadores.html" class="top-menu"><div class="top-menu__icon"><i data-feather="clipboard"></i></div><div class="top-menu__title">Treinadores</div></a></li>
                    <li><a href="admin-atletas.html" class="top-menu"><div class="top-menu__icon"><i data-feather="activity"></i></div><div class="top-menu__title">Atletas</div></a></li>
                    <li><a href="admin-logs.html" class="top-menu"><div class="top-menu__icon"><i data-feather="file-text"></i></div><div class="top-menu__title">Logs</div></a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="content flex-grow w-full">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5 text-theme-2">
                            Visão Geral do Sistema (Admin)
                        </h2>
                        <a href="" class="ml-auto flex text-theme-2 dark:text-theme-10"> <i
                                data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Recarregar Dados </a>
                    </div>
                    <div class="grid grid-cols-1 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="users" class="report-box__icon text-theme-10"></i></div><div class="text-3xl font-bold leading-8 mt-6">150</div><div class="text-base text-gray-600 mt-1">Total de Utilizadores</div></div></div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="award" class="report-box__icon text-theme-11"></i></div><div class="text-3xl font-bold leading-8 mt-6">12</div><div class="text-base text-gray-600 mt-1">Modalidades Ativas</div></div></div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="clipboard" class="report-box__icon text-theme-12"></i></div><div class="text-3xl font-bold leading-8 mt-6">30</div><div class="text-base text-gray-600 mt-1">Treinadores Registados</div></div></div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="activity" class="report-box__icon text-theme-9"></i></div><div class="text-3xl font-bold leading-8 mt-6">85</div><div class="text-base text-gray-600 mt-1">Atletas Inscritos</div></div></div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5"> Lista de Utilizadores </h2>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <a href="admin-form-utilizador.html" class="button box flex items-center text-gray-700 dark:text-gray-300"> 
                                <i data-feather="plus-square" class="hidden sm:block w-4 h-4 mr-2"></i> Adicionar Utilizador 
                            </a>
                        </div>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                        <table class="table table-report sm:mt-2">
                            <thead><tr><th class="whitespace-no-wrap">NOME</th><th class="whitespace-no-wrap">EMAIL</th><th class="text-center whitespace-no-wrap">PERFIL</th><th class="text-center whitespace-no-wrap">ESTADO</th><th class="text-center whitespace-no-wrap">AÇÕES</th></tr></thead>
                            <tbody>
                                <tr class="intro-x"><td><a href="" class="font-medium whitespace-no-wrap">Ana Silva</a><div class="text-gray-600 text-xs whitespace-no-wrap">ID: 1</div></td><td><div class="font-medium whitespace-no-wrap">ana.silva@exemplo.com</div></td><td class="text-center">Atleta</td><td class="w-40"><div class="flex items-center justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Ativo </div></td><td class="table-report__action w-56"><div class="flex justify-center items-center"><a class="flex items-center mr-3" href="admin-form-utilizador.php?id=1"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Editar</a><a class="flex items-center text-theme-6" href="javascript:;" onclick="confirmarApagar(1)"><i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Apagar</a></div></td></tr>
                                <tr class="intro-x"><td><a href="" class="font-medium whitespace-no-wrap">Carlos Moura</a><div class="text-gray-600 text-xs whitespace-no-wrap">ID: 2</div></td><td><div class="font-medium whitespace-no-wrap">carlos.moura@exemplo.com</div></td><td class="text-center">Treinador</td><td class="w-40"><div class="flex items-center justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Ativo </div></td><td class="table-report__action w-56"><div class="flex justify-center items-center"><a class="flex items-center mr-3" href="admin-form-utilizador.php?id=2"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Editar</a><a class="flex items-center text-theme-6" href="javascript:;" onclick="confirmarApagar(2)"><i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Apagar</a></div></td></tr>
                                <tr><td colspan="5" class="text-center py-4">Nenhum utilizador encontrado. (Exemplo estático)</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-3">
                        <ul class="pagination"><li><a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a></li><li><a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-left"></i> </a></li><li> <a class="pagination__link" href="">...</a> </li><li> <a class="pagination__link" href="">1</a> </li><li> <a class="pagination__link pagination__link--active" href="">2</a> </li><li> <a class="pagination__link" href="">3</a> </li><li> <a class="pagination__link" href="">...</a> </li><li><a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-right"></i> </a></li><li><a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a></li></ul>
                        <select class="w-20 input box mt-3 sm:mt-0"><option>10</option><option>25</option><option>50</option></select>
                    </div>
                </div>
                
            </div>

            <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Atividades Recentes (Logs)</h2>
                            <a href="admin-logs.html" class="ml-auto text-theme-1 dark:text-theme-10 truncate">Ver Tudo</a>
                        </div>
                        <div class="mt-5 report-timeline">
                            <div class="intro-x relative flex items-center mb-3"> <div class="report-timeline__image"><div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"><img alt="Foto Utilizador Log" src="dist/images/profile-4.jpg"> </div></div><div class="box px-5 py-3 ml-4 flex-1 zoom-in"><div class="flex items-center"><div class="font-medium">Admin</div> <div class="text-xs text-gray-500 ml-auto">10:00 AM</div> </div><div class="text-gray-600 mt-1">Criou novo utilizador: Carlos Moura</div> </div></div>
                            <div class="intro-x relative flex items-center mb-3"> <div class="report-timeline__image"><div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"><img alt="Foto Utilizador Log" src="dist/images/profile-3.jpg"></div></div><div class="box px-5 py-3 ml-4 flex-1 zoom-in"><div class="flex items-center"><div class="font-medium">Treinador Silva</div><div class="text-xs text-gray-500 ml-auto">09:30 AM</div></div><div class="text-gray-600 mt-1">Atualizou dados do atleta: João P.</div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="dist/js/app.js"></script>
    <script>
        function confirmarApagar(idUtilizador) {
            if (confirm("Tem a certeza que deseja apagar este utilizador? ID: " + idUtilizador)) {
                console.log("Apagar utilizador: " + idUtilizador);
            }
        }
    </script>
    
</body>
</html>