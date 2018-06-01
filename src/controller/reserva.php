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
    $reserva = new Reserva();
    if ($_POST['showForm'] > 0) {
        $reserva->get($_POST['showForm']);
    }
    echo $reserva->showForm();
    die();
}
if (isset($_POST['showFormDel'])) {
    $reserva = new Reserva();
    $reserva->get($_POST['showFormDel']);
    echo $reserva->showFormDel();
    die();
}
if (isset($_POST['showFormCancel'])) {
    $reserva = new Reserva();
    $reserva->get($_POST['showFormCancel']);
    echo $reserva->showFormCancel();
    die();
}

if (isset($_POST['salvar'])) {
    //Salvar ou editar uma unidade
    $reserva = new Reserva();
    if ($_POST['id'] > 0) {
        $reserva->get($_POST['id']);
    }
    $reserva->setcliente_id($_POST['cliente_id']);
    $reserva->setquadra_id($_POST['quadra_id']);
    $reserva->setdata(date2save($_POST['data']));
    $reserva->sethorario_id($_POST['horario_id']);
    $mensal = (isset($_POST['mensal'])) ? 'S' : 'N';
    $reserva->setmensal($mensal);
    if ($_POST['id'] > 0) {
        $reserva->update();
    } else {
        $reserva->insert();
    }
    $_SESSION['msg'] = '<b>Feito!</b> Reserva salva com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/reserva');
    die();
}

if (isset($_POST['remover'])) {
    //Salvar ou editar uma unidade
    $reserva = new Reserva();
    $reserva->get($_POST['id']);
    $reserva->delete();
    
    $_SESSION['msg'] = '<b>Feito!</b> Reserva removida com sucesso.';
    $_SESSION['tipo-msg'] = 'success';
    header('Location: '.URL.'/reserva');
    die();
}

if (isset($_POST['cancelarMensal'])) {
    $reserva = new Reserva();
    $reserva->get($_POST['id']);
    
    if ($reserva->data > date2save($_POST['dataFim'])) {
        $_SESSION['msg'] = '<b>Erro!</b> Não foi possível cancelar a inscrição mensal pois a data de cancelamento é anterior ao início da reserva. Caso queira cancelar essa inscrição, remova a reserva.';
        $_SESSION['tipo-msg'] = 'error';
    } else {
        $reserva->setdata_fim(date2save($_POST['dataFim']));
        $reserva->update();
        $_SESSION['msg'] = '<b>Feito!</b> Inscrição mensal cancelada com sucesso.';
        $_SESSION['tipo-msg'] = 'success';
        echo 'Feito';
    }
    
    header('Location: '.URL.'/reserva');
    die();
}

if (isset($_POST['salvarCliente'])) {
    $cliente = new Cliente();
    $cliente->setnome(utf8_decode($_POST['nome']));
    $cliente->settelefone($_POST['telefone']);
    $cliente->insert();
    echo '<option selected="selected" value="'.$cliente->getid().'">'.utf8_encode($cliente->getnome()).'</option>';
    die();
}