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

$PHP_SELF = $_SERVER['PHP_SELF'];
define('TEMPO_QUADRA', 75);

function show_message() {
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        $t   = $_SESSION['tipo-msg'];
        
        unset($_SESSION['msg']);
        unset($_SESSION['tipo-msg']);
        
        $tipo = ($t == 'success') ? ' alert-success' : ' alert-danger';
        $msg = '<br /><div class="alert'.$tipo.'">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            '.$msg.' </div>';
    } else {
        $msg = '';
    }
    return $msg;
}

function date2save($date) {
    $data = new DateTime($date);
    return $data->format("Y-m-d H:i:s");
}

function date2show($date) {
    $data = new DateTime($date);
    return $data->format("d-m-Y");
}

function verificaLoginAtivo() {
    if (isset($_SESSION['login'])) {
        header("Location: ".URL.'/meus-anuncios');
        die();
    }
}

function verificaLoginInativo() {
    if (!isset($_SESSION['login'])) {
        header("Location: ".URL.'/login');
        die();
    }
}