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
    $quadra = new Quadra();
    if ($_POST['showForm'] > 0) {
        $quadra->get($_POST['showForm']);
    }
    echo $quadra->showForm();
    die();
}
if (isset($_POST['showFormDel'])) {
    $quadra = new Quadra();
    $quadra->get($_POST['showFormDel']);
    echo $quadra->showFormDel();
    die();
}

if (isset($_POST['salvar'])) {
    //Salvar ou editar uma unidade
    $quadra = new Quadra();
    if ($_POST['id'] > 0) {
        $quadra->get($_POST['id']);
    }
    $quadra->setnome(utf8_decode($_POST['nome']));
    $quadra->setdescricao(utf8_decode($_POST['descricao']));
    $quadra->setunidade_id($_POST['unidade_id']);
    if ($_POST['id'] > 0) {
        $quadra->update();
    } else {
        $quadra->insert();
    }
    $_SESSION['msg'] = '<b>Feito!</b> Quadra salva com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/quadra');
    die();
}

if (isset($_POST['remover'])) {
    //Salvar ou editar uma unidade
    $quadra = new Quadra();
    $quadra->get($_POST['id']);
    $quadra->delete();
    
    $_SESSION['msg'] = '<b>Feito!</b> Quadra removida com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/quadra');
    die();
}