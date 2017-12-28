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

if (isset($_POST['showForm'])) {
    $horario = new Horario();
    if ($_POST['showForm'] > 0) {
        $horario->get($_POST['showForm']);
    }
    echo $horario->showForm();
    die();
}
if (isset($_POST['showFormDel'])) {
    $horario = new Horario();
    $horario->get($_POST['showFormDel']);
    echo $horario->showFormDel();
    die();
}

if (isset($_POST['salvar'])) {
    //Salvar ou editar uma unidade
    $horario = new Horario();
    if ($_POST['id'] > 0) {
        $horario->get($_POST['id']);
    }
    $horario->settipo_id($_POST['tipo_id']);
    $horario->setinicio_hora($_POST['hora']);
    $horario->setinicio_minuto($_POST['minuto']);
    $horario->setduracao($_POST['duracao']);
    if ($_POST['id'] > 0) {
        $horario->update();
    } else {
        $horario->insert();
    }
    $_SESSION['msg'] = '<b>Feito!</b> Horario salvo com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/horario');
    die();
}

if (isset($_POST['remover'])) {
    //Salvar ou editar uma unidade
    $horario = new Horario();
    $horario->get($_POST['id']);
    $horario->delete();
    
    $_SESSION['msg'] = '<b>Feito!</b> Horario removido com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/horario');
    die();
}