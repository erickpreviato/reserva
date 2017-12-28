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
    $cliente = new Cliente();
    if ($_POST['showForm'] > 0) {
        $cliente->get($_POST['showForm']);
    }
    echo $cliente->showForm();
    die();
}
if (isset($_POST['showFormDel'])) {
    $cliente = new Cliente();
    $cliente->get($_POST['showFormDel']);
    echo $cliente->showFormDel();
    die();
}

if (isset($_POST['salvar'])) {
    //Salvar ou editar uma unidade
    $cliente = new Cliente();
    if ($_POST['id'] > 0) {
        $cliente->get($_POST['id']);
    }
    $cliente->setnome(utf8_decode($_POST['nome']));
    $cliente->setemail($_POST['email']);
    $cliente->settelefone($_POST['telefone']);
    $cliente->setobservacoes(utf8_decode($_POST['observacoes']));
    if ($_POST['id'] > 0) {
        $cliente->update();
    } else {
        $cliente->insert();
    }
    $_SESSION['msg'] = '<b>Feito!</b> Cliente salvo com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/cliente');
    die();
}

if (isset($_POST['remover'])) {
    //Salvar ou editar uma unidade
    $cliente = new Cliente();
    $cliente->get($_POST['id']);
    $cliente->delete();
    
    $_SESSION['msg'] = '<b>Feito!</b> Cliente removido com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/cliente');
    die();
}