<?php

    class websiteDAO{
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $banco = 'websitedinamicogamesdb';
        private $pdo;
        
        private function conectar(){
            try{
                $this->pdo = new PDO('mysql:dbname='.$this->banco.'; charset=utf8; host='.$this->host, $this->user, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return true;
            }catch(PDOException $e){
                $novoCriarBanco = $this->criarBancoSQL();
                if ($novoCriarBanco == true){
                    try{
                        $this->pdo = new PDO('mysql:dbname='.$this->banco.'; charset=utf8; host='.$this->host, $this->user, $this->password);
                        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        return true;
                    }catch(PDOException $e){
                        return false;
                    }
                }else{
                    return false;
                }   
            }
        }

        private function desconectar(){
            try{
                $this->pdo = null;

            }catch(PDOException $e){
                return false;
            }
        }

        private function criarBancoSQL(){
            try{
                $this->pdo = new PDO('mysql:charset=utf8; host='.$this->host, $this->user, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $criarBanco = "CREATE SCHEMA IF NOT EXISTS `websitedinamicogamesdb` DEFAULT CHARACTER SET utf8;
                                USE `websitedinamicogamesdb`;                
                                CREATE TABLE IF NOT EXISTS `websitedinamicogamesdb`.`website` (`idwebsite` INT NOT NULL AUTO_INCREMENT, `nome` VARCHAR(100) NULL, `telefone` VARCHAR(50) NULL, `manutencao` CHAR(1) NULL, PRIMARY KEY (`idwebsite`));
                                CREATE TABLE IF NOT EXISTS `websitedinamicogamesdb`.`paginas` (`idpagina` INT NOT NULL AUTO_INCREMENT, `nome` VARCHAR(50) NULL, `descricao` VARCHAR(250) NULL, `palavraschave` VARCHAR(200) NULL, PRIMARY KEY (`idpagina`));
                                CREATE TABLE IF NOT EXISTS `websitedinamicogamesdb`.`grids` (`idgrid` INT NOT NULL AUTO_INCREMENT, `idpagina` INT NULL, `titulo` VARCHAR(50) NULL, `descricao` TEXT(600) NULL, `img` VARCHAR(300) NULL, `botaoNome` VARCHAR(50) NULL, `botaoLink` VARCHAR(300) NULL, PRIMARY KEY (`idgrid`), INDEX `idpaginaref_idx` (`idpagina` ASC), CONSTRAINT `idpaginaref` FOREIGN KEY (`idpagina`) REFERENCES `websitedinamicogamesdb`.`paginas` (`idpagina`) ON DELETE CASCADE ON UPDATE CASCADE);
                                CREATE TABLE IF NOT EXISTS `websitedinamicogamesdb`.`usuarios` (`idusuario` INT NOT NULL AUTO_INCREMENT, `nome` VARCHAR(50) NULL, `email` VARCHAR(256) NULL, `senha` VARCHAR(128) NULL, `situacao` CHAR(1) NULL, PRIMARY KEY (`idusuario`));
                                CREATE TABLE IF NOT EXISTS `websitedinamicogamesdb`.`games` (`idgame` INT NOT NULL AUTO_INCREMENT, `nome` VARCHAR(50) NULL, `bonus` INT NULL, PRIMARY KEY (`idgame`));
                                CREATE TABLE IF NOT EXISTS `websitedinamicogamesdb`.`pontuacoes` (`idpontuacoes` INT NOT NULL AUTO_INCREMENT, `idusuario` INT NULL, `idgame` INT NULL, `pontos` INT NULL, `extras` TEXT(500) NULL, PRIMARY KEY (`idpontuacoes`), INDEX `idusuarioref_idx` (`idusuario` ASC), INDEX `idgameref_idx` (`idgame` ASC), CONSTRAINT `idusuarioref` FOREIGN KEY (`idusuario`) REFERENCES `websitedinamicogamesdb`.`usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE, CONSTRAINT `idgameref` FOREIGN KEY (`idgame`) REFERENCES `websitedinamicogamesdb`.`games` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE);
                                INSERT INTO `websitedinamicogamesdb`.`website`(`nome`,`telefone`,`manutencao`) VALUES ('Website Dinamico com sistema de jogos ranqueados', 91999999999, 0);
                                INSERT INTO `websitedinamicogamesdb`.`paginas`(`nome`,`descricao`,`palavraschave`) VALUES ('Website dinâmico com jogos ranqueados', 'Website dinâmico com sistema de jogo multiplataforma ranqueado', 'Website, Dinamico, jogo, game, multiplataforma, ranqueado');
                                INSERT INTO `websitedinamicogamesdb`.`paginas`(`nome`,`descricao`,`palavraschave`) VALUES ('Jogo da memória com icones', 'Melhore a concentração, o raciocínio lógico e estimule a memória.', 'Jogo, mental, memorização, icones');
                                INSERT INTO `websitedinamicogamesdb`.`grids` (`idpagina`, `titulo`, `descricao`, `img`, `botaoNome`, `botaoLink`) VALUES ('1', 'Game da memória com icones', 'Melhore a concentração, raciocínio lógico e estimule a sua memória', '/static/img/game_memoria.png', 'Acesso', 'game_memoria.php');
                                INSERT INTO `websitedinamicogamesdb`.`usuarios` (`nome`, `email`, `senha`, `situacao`) VALUES ('admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '1');
                                INSERT INTO `websitedinamicogamesdb`.`games` (`nome`, `bonus`) VALUES ('Game da memória com icones', '5');
                                INSERT INTO `websitedinamicogamesdb`.`pontuacoes` (`idusuario`, `idgame`, `pontos`, `extras`) VALUES ('1', '1', '0', '[0]');";

                $criarBanco = $this->pdo->prepare($criarBanco);

                $criarBanco->execute();

                if ($criarBanco){
                    return true;
                }else{
                    return false;
                }

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function dadosWebsiteDAO(){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT website.nome, website.telefone, website.manutencao FROM website";
                
                $pesquisar = $this->pdo->prepare($pesquisar);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetch();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function dadosPaginaDAO($valorParam){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT paginas.idpagina, paginas.nome, paginas.descricao, paginas.palavraschave FROM paginas WHERE idpagina = :param1 LIMIT 1;";
                
                $pesquisar = $this->pdo->prepare($pesquisar);

                $pesquisar->bindValue("param1", $valorParam);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetch();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function dadosGridsDAO($valorParam){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT grids.titulo, grids.descricao, grids.img, grids.botaoNome, grids.botaoLink FROM grids WHERE idpagina = :param1;";

                $pesquisar = $this->pdo->prepare($pesquisar);
                
                $pesquisar->bindValue("param1", $valorParam);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetchAll();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function loginDAO($valorParam1, $valorParam2){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT usuarios.idusuario, usuarios.nome, usuarios.email, usuarios.situacao FROM usuarios WHERE nome = :param1 && senha = :param2;";

                $pesquisar = $this->pdo->prepare($pesquisar);
                
                $pesquisar->bindValue("param1", $valorParam1);

                $pesquisar->bindValue("param2", $valorParam2);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetch();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function buscaUsuarioEmailDAO($valorParam1){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT usuarios.idusuario, usuarios.nome, usuarios.situacao FROM usuarios WHERE email = :param1 LIMIT 1;";

                $pesquisar = $this->pdo->prepare($pesquisar);
                
                $pesquisar->bindValue("param1", $valorParam1);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetch();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function buscaUsuarioNomeDAO($valorParam1){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT usuarios.idusuario, usuarios.email, usuarios.situacao FROM usuarios WHERE nome = :param1 LIMIT 1;";

                $pesquisar = $this->pdo->prepare($pesquisar);
                
                $pesquisar->bindValue("param1", $valorParam1);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetch();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function pontuacoesDAO($valorParam1){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT usuarios.idusuario, pontuacoes.idpontuacoes, pontuacoes.idgame, pontuacoes.pontos, pontuacoes.extras, games.nome FROM usuarios INNER JOIN pontuacoes ON usuarios.idusuario = pontuacoes.idusuario INNER JOIN games ON pontuacoes.idgame = games.idgame WHERE email = :param1;";

                $pesquisar = $this->pdo->prepare($pesquisar);
                
                $pesquisar->bindValue("param1", $valorParam1);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetchAll();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function ranqueGeralDAO($valorParam1){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $pesquisar = "SELECT usuarios.nome, pontuacoes.pontos FROM usuarios INNER JOIN pontuacoes ON usuarios.idusuario = pontuacoes.idusuario INNER JOIN games ON pontuacoes.idgame = games.idgame WHERE games.nome = :param1 ORDER BY pontuacoes.pontos DESC;";

                $pesquisar = $this->pdo->prepare($pesquisar);

                $pesquisar->bindValue("param1", $valorParam1);

                $pesquisar->execute();

                $pesquisar = $pesquisar->fetchAll();

                if (isset($pesquisar) and $pesquisar != false){
                    return $pesquisar;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        # CADASTRO
        function cadastroUsuarioDAO($valorParam1, $valorParam2, $valorParam3, $valorParam4){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $cadastrar = "INSERT INTO usuarios (nome, email, senha, situacao) VALUES (:param1, :param2, :param3, :param4);";
                
                $cadastrar = $this->pdo->prepare($cadastrar);

                $cadastrar->bindValue("param1", $valorParam1);
                $cadastrar->bindValue("param2", $valorParam2);
                $cadastrar->bindValue("param3", $valorParam3);
                $cadastrar->bindValue("param4", $valorParam4);

                $cadastrar->execute();

                if (isset($cadastrar) and $cadastrar != false){
                    return true;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        function vincularUsuarioGameDAO($valorParam1, $valorParam2, $valorParam3, $valorParam4){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $cadastrar = "INSERT INTO pontuacoes (idusuario, idgame, pontos, extras) VALUES (:param1, :param2, :param3, :param4);";
                
                $cadastrar = $this->pdo->prepare($cadastrar);

                $cadastrar->bindValue("param1", $valorParam1);
                $cadastrar->bindValue("param2", $valorParam2);
                $cadastrar->bindValue("param3", $valorParam3);
                $cadastrar->bindValue("param4", $valorParam4);

                $cadastrar->execute();

                if (isset($cadastrar) and $cadastrar != false){
                    return true;
                }else{    
                    return false;
                }

                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        # ATUALIZAR

        function atualizarPontosDAO($valorParam1, $valorParam2, $valorParam3, $valorParam4){
            try{              
                if ($this->conectar() == false){
                    return false;
                }

                $update = "UPDATE pontuacoes SET pontos = :param3, extras = :param4 WHERE idusuario = :param1 && idgame = :param2;";

                $update = $this->pdo->prepare($pesquisar);

                $update->bindValue("param1", $valorParam1);
                $update->bindValue("param2", $valorParam2);
                $update->bindValue("param3", $valorParam3);
                $update->bindValue("param4", $valorParam4);

                $update->execute();

                if (isset($update) and $update != false){
                    return true;
                }else{    
                    return false;
                }
                
                $this->desconectar();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
?>
