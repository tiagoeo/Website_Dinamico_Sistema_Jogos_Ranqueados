<?php

    function sec_session_start() {
        $secure = true;
        $httponly = true;

        ini_set('session.use_only_cookies', 1);
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name('Website_Dinamico');
        session_start();
    }

?>
        <?php include_once(__DIR__.'/static/main/cabecalho.php');?>

        <title> Website Dinamico com sistema de jogo ranqueado </title>
        <meta name="description" content="Website dinâmico com sistema de jogo multiplataforma ranqueado">
        <meta name="keywords" content="Website, Dinamico, jogo, game, multiplataforma, ranqueado">
        </head>

    <body>
        <header>
            <?php include_once(__DIR__.'/static/main/menu.php');?>			
		</header>
        <!-- Main -->
        <main>

        </main>
        <!-- // Main -->

        <!-- Modal -->
        <div id="modal">
            <?php include(__DIR__.'/static/main/modal.php'); ?>
        </div>
        <!-- // Modal -->

        <!-- Rodapé -->
        <div id="footer">
            <?php include(__DIR__.'/static/main/rodape.php'); ?>
        </div>
        <!-- // Rodapé -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha512-dqw6X88iGgZlTsONxZK9ePmJEFrmHwpuMrsUChjAw1mRUhUITE5QU9pkcSox+ynfLhL15Sv2al5A0LVyDCmtUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('.ui.dropdown')
                .dropdown()
            ;
        </script>
    </body>
</html>