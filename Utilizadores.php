<?php
// ===================================================================================
// PARTE 1: CONFIGURAÇÃO E LÓGICA PHP
// ===================================================================================
session_start(); // Iniciar a sessão para podermos usar mensagens de feedback

// --- 1.1: Conexão com a Base de Dados ---
$servidor = "localhost";
$utilizador_bd = "root";
$password_bd = ""; // Deixe em branco se for a configuração padrão do XAMPP/WAMP
$nome_base_dados = "gestao_desportiva_db"; // <<< COLOQUE AQUI O NOME DA SUA BASE DE DADOS

// Tenta conectar
$conn = mysqli_connect($servidor, $utilizador_bd, $password_bd, $nome_base_dados);

// Verifica a conexão
if (!$conn) {
    die("Falha CRÍTICA na ligação à base de dados: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8"); // Garante que acentos e caracteres especiais funcionem bem


// --- 1.2: Lógica para Processar o Formulário (Quando for submetido) ---
$mensagem_erro = '';
$mensagem_sucesso = '';

// Verificar se o formulário foi submetido (se os dados chegaram via POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ação de ADICIONAR um novo utilizador
    if (isset($_POST['acao']) && $_POST['acao'] == 'novo') {
        // Obter e limpar os dados do formulário
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password']; // Password em texto simples
        $perfil = mysqli_real_escape_string($conn, $_POST['perfil']);
        $estado = mysqli_real_escape_string($conn, $_POST['estado']);

        // Validações
        if (empty($nome) || empty($email) || empty($password) || empty($perfil)) {
            $mensagem_erro = "Por favor, preencha todos os campos obrigatórios.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagem_erro = "O formato do email é inválido.";
        } else {
            // Verificar se o email já existe
            $sql_check_email = "SELECT id FROM utilizadores WHERE email = ?";
            $stmt_check = mysqli_prepare($conn, $sql_check_email);
            mysqli_stmt_bind_param($stmt_check, "s", $email);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);

            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                $mensagem_erro = "Este email já está registado.";
            } else {
                // Se tudo estiver OK, fazer o hash da password por segurança
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                // Preparar a query SQL para INSERIR os dados (usando Prepared Statements para segurança)
                $sql_insert = "INSERT INTO utilizadores (nome, email, password_hash, perfil, estado) VALUES (?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $sql_insert);

                if ($stmt_insert) {
                    mysqli_stmt_bind_param($stmt_insert, "sssss", $nome, $email, $password_hash, $perfil, $estado);
                    if (mysqli_stmt_execute($stmt_insert)) {
                        $mensagem_sucesso = "Utilizador adicionado com sucesso!";
                        // Não redirecionamos, a mensagem será mostrada na própria página
                    } else {
                        $mensagem_erro = "Erro ao guardar na base de dados: " . mysqli_error($conn);
                    }
                    mysqli_stmt_close($stmt_insert);
                } else {
                    $mensagem_erro = "Erro na preparação da query.";
                }
            }
            mysqli_stmt_close($stmt_check);
        }
    }
    // (AQUI PODERIA ADICIONAR LÓGICA PARA 'editar' ou 'apagar' num futuro)
}

// --- 1.3: Lógica para Buscar os Dados a Serem Exibidos na Página ---
$utilizadores_data = []; // Array para guardar os utilizadores vindos da BD
$sql_select_users = "SELECT id, nome, email, perfil, estado FROM utilizadores ORDER BY nome ASC";
$resultado = mysqli_query($conn, $sql_select_users);
if ($resultado) {
    $utilizadores_data = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

// --- 1.4: Lógica para decidir qual "view" mostrar ---
$view = $_GET['view'] ?? 'dashboard'; // Por padrão, mostra o dashboard
?>

<!DOCTYPE html>
<html lang="pt" class="light">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Gestão Desportiva</title>
    <link rel="stylesheet" href="dist/css/app.css" />
    <style>
        body.app { background-color: #F1F5F9; } /* Cor de fundo cinza claro para o body */
        .content { background-color: transparent; } /* O conteúdo não precisa de cor de fundo separada */
    </style>
</head>

<body class="app"> <div class="mobile-menu md:hidden">
        </div>
    <div class="border-b border-gray-200 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
        </div>
    <nav class="top-nav">
       <ul>
           <li><a href="index.php?view=dashboard" class="top-menu <?php if ($view == 'dashboard') echo 'top-menu--active'; ?>"> <div class="top-menu__icon"> <i data-feather="home"></i> </div><div class="top-menu__title"> Início </div></a></li>
           <li>
               <a href="javascript:;" class="top-menu <?php if (strpos($view, 'lista_') === 0 || strpos($view, 'form_') === 0) echo 'top-menu--active'; ?>">
                   <div class="top-menu__icon"> <i data-feather="settings"></i> </div>
                   <div class="top-menu__title"> Administração <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
               </a>
               <ul class="">
                   <li><a href="index.php?view=lista_utilizadores" class="top-menu <?php if ($view == 'lista_utilizadores' || $view == 'form_utilizador') echo 'top-menu--active'; ?>"><div class="top-menu__icon"><i data-feather="users"></i></div><div class="top-menu__title">Utilizadores</div></a></li>
                   </ul>
           </li>
       </ul>
    </nav>
    
    <div class="content">

        <?php if (!empty($mensagem_sucesso)): ?>
            <div class="alert alert-success show mb-2" role="alert"><?php echo $mensagem_sucesso; ?></div>
        <?php endif; ?>
        <?php if (!empty($mensagem_erro)): ?>
            <div class="alert alert-danger show mb-2" role="alert"><?php echo $mensagem_erro; ?></div>
        <?php endif; ?>

        <?php if ($view == 'dashboard'): ?>
            <div id="view-dashboard">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10"><h2 class="text-lg font-medium truncate mr-5 text-theme-2">Visão Geral do Sistema (Admin)</h2><a href="" class="ml-auto flex text-theme-2 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Recarregar Dados </a></div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"><div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="users" class="report-box__icon text-theme-10"></i></div><div class="text-3xl font-bold leading-8 mt-6"><?php echo count($utilizadores_data); ?></div><div class="text-base text-gray-600 mt-1">Total de Utilizadores</div></div></div></div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"><div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="award" class="report-box__icon text-theme-11"></i></div><div class="text-3xl font-bold leading-8 mt-6">12</div><div class="text-base text-gray-600 mt-1">Modalidades Ativas</div></div></div></div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"><div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="clipboard" class="report-box__icon text-theme-12"></i></div><div class="text-3xl font-bold leading-8 mt-6">30</div><div class="text-base text-gray-600 mt-1">Treinadores Registados</div></div></div></div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y"><div class="report-box zoom-in"><div class="box p-5"><div class="flex"><i data-feather="activity" class="report-box__icon text-theme-9"></i></div><div class="text-3xl font-bold leading-8 mt-6">85</div><div class="text-base text-gray-600 mt-1">Atletas Inscritos</div></div></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                         <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                                <div class="intro-y flex items-center h-10"><h2 class="text-lg font-medium truncate mr-5">Atividades Recentes (Logs)</h2><a href="index.php?view=logs" class="ml-auto text-theme-1 dark:text-theme-10 truncate">Ver Tudo</a></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($view == 'lista_utilizadores'): ?>
            <div id="view-lista-utilizadores">
                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10"><h2 class="text-lg font-medium truncate mr-5"> Lista de Utilizadores </h2><div class="flex items-center sm:ml-auto mt-3 sm:mt-0"><a href="index.php?view=form_utilizador&acao=novo" class="button box flex items-center text-gray-700 dark:text-gray-300"><i data-feather="plus-square" class="hidden sm:block w-4 h-4 mr-2"></i> Adicionar Utilizador </a></div></div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                        <table class="table table-report sm:mt-2">
                            <thead><tr><th class="whitespace-no-wrap">NOME</th><th class="whitespace-no-wrap">EMAIL</th><th class="text-center whitespace-no-wrap">PERFIL</th><th class="text-center whitespace-no-wrap">ESTADO</th><th class="text-center whitespace-no-wrap">AÇÕES</th></tr></thead>
                            <tbody>
                                <?php if (!empty($utilizadores_data)): ?>
                                    <?php foreach ($utilizadores_data as $utilizador): ?>
                                        <tr class="intro-x">
                                            <td><a href="index.php?view=perfil&id=<?php echo $utilizador['id']; ?>" class="font-medium whitespace-no-wrap"><?php echo htmlspecialchars($utilizador['nome']); ?></a><div class="text-gray-600 text-xs whitespace-no-wrap">ID: <?php echo $utilizador['id']; ?></div></td>
                                            <td><div class="font-medium whitespace-no-wrap"><?php echo htmlspecialchars($utilizador['email']); ?></div></td>
                                            <td class="text-center"><?php echo htmlspecialchars($utilizador['perfil']); ?></td>
                                            <td class="w-40"><div class="flex items-center justify-center <?php echo ($utilizador['estado'] == 'Ativo') ? 'text-theme-9' : 'text-theme-6'; ?>"><i data-feather="check-square" class="w-4 h-4 mr-2"></i> <?php echo $utilizador['estado']; ?></div></td>
                                            <td class="table-report__action w-56"><div class="flex justify-center items-center"><a class="flex items-center mr-3" href="index.php?view=form_utilizador&acao=editar&id=<?php echo $utilizador['id']; ?>"><i data-feather="edit" class="w-4 h-4 mr-1"></i> Editar</a><a class="flex items-center text-theme-6" href="javascript:;" onclick="confirmarApagar(<?php echo $utilizador['id']; ?>)"><i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Apagar</a></div></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-4">Nenhum utilizador encontrado.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ($view == 'form_utilizador'): ?>
            <div id="view-form-utilizador">
                 <div class="grid grid-cols-12 gap-6"><div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6"><div class="col-span-12 mt-8">
                    <div class="intro-y items-center h-10"><h2 class="text-lg font-medium truncate mr-5 text-theme-2">Adicionar Novo Utilizador</h2></div>
                    <form id="user-form" action="index.php?view=lista_utilizadores" method="POST" class="intro-y box p-5 mt-5"> <input type="hidden" name="acao" value="novo">
                        <div class="mt-3"><label for="nome" class="form-label">Nome Completo</label><input id="nome" name="nome" type="text" class="input w-full border mt-2" placeholder="Insira o nome completo" required></div>
                        <div class="mt-3"><label for="email" class="form-label">Email</label><input id="email" name="email" type="email" class="input w-full border mt-2" placeholder="email@exemplo.com" required></div>
                        <div class="mt-3"><label for="password" class="form-label">Password</label><input id="password" name="password" type="password" class="input w-full border mt-2" required></div>
                        <div class="mt-3"><label for="perfil" class="form-label">Perfil</label><select id="perfil" name="perfil" class="input w-full border mt-2"><option value="Atleta">Atleta</option><option value="Treinador">Treinador</option><option value="Administrador">Administrador</option></select></div>
                        <div class="mt-3"><label for="estado" class="form-label">Estado</label><select id="estado" name="estado" class="input w-full border mt-2"><option value="Ativo">Ativo</option><option value="Inativo">Inativo</option></select></div>
                        <div class="text-right mt-5"><a href="index.php?view=lista_utilizadores" class="button w-24 border text-gray-700 mr-1">Cancelar</a><button type="submit" class="button w-24 bg-theme-1 text-white">Guardar</button></div>
                    </form>
                </div></div></div>
            </div>
        <?php else: ?>
            <div class="col-span-12 mt-6">
                <div class="alert alert-danger show mb-2" role="alert">A secção que tentou aceder não foi encontrada.</div>
            </div>
        <?php endif; ?>
    </div>
    <div data-url="top-menu-dark-dashboard.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
        <div class="dark-mode-switcher__toggle border"></div>
    </div>
    <script src="dist/js/app.js"></script>
    <script>
        function confirmarApagar(idUtilizador) {
            if (confirm("Tem a certeza que deseja apagar este utilizador? ID: " + idUtilizador)) {
                // Para apagar, você pode fazer um link para:
                // window.location.href = 'index.php?view=apagar_utilizador&id=' + idUtilizador;
                console.log("Apagar utilizador: " + idUtilizador);
            }
        }
    </script>
</body>
</html>