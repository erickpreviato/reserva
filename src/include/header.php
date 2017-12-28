<?php
/**
 * 
 * Copyright © 2017 Erick Vansim Previato <erick.previato@gmail.com>
 * 
 * Este arquivo é parte do programa "Reserva de Quadra"
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * 
 */
?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Escola de Futebol e Locações de campos">
        <meta name="author" content="Erick Previato">
        <!--<link rel="icon" href="<?php echo IMAGE_URL ?>/favicon.ico">-->

        <title>Multi Sport Escola de Futebol e Locação de Campos</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo CSS_URL ?>/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL ?>/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL ?>/ionicons.min.css">


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="<?php echo CSS_URL ?>/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo CSS_URL ?>/reserva.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo JS_URL ?>/jquery.min.js"></script>
    </head>

    <body>
        
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" id="form-modal" method="POST">
            <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="addModalLabel">Titulo</h4>
                        </div>
                        <div class="modal-body">
                            Conteudo
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="salvar" id="salvar" value="Enviar" />
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <nav class="barra-superior">
            <div class="container">
                <div class="row">
                    <div class=col-xs-12>
                        <a href="<?php echo URL ?>"><img src="<?php echo IMAGE_URL ?>/logo.png" class="logotipo" /></a>
                        <div class="caixa-banner"></div>
                    </div>
                </div>
            </div>
        </nav>

        <section class="barra-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="nav nav-justified">
                            <li role="presentation"><a href="<?php echo URL ?>/sobre">Sobre nós</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/categorias">Locação de campos</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/anuncie">Outros serviços</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/meus-anuncios">Minha área</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/fale-conosco">Fale conosco</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="barra-menu2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="nav nav-justified">
                            <li role="presentation"><h4><i class="fa fa-lock"></i> Menu restrito</h4></li>
                            <li role="presentation"><a href="<?php echo URL ?>/unidade">Unidades</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/quadra">Quadras</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/horario">Horários</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/cliente">Clientes</a></li>
                            <li role="presentation"><a href="<?php echo URL ?>/reserva">Reservas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    <?php echo show_message(); ?>
