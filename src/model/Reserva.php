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

/**
 * Table Definition for reserva
 */

require_once 'DB/DataObject.php';

class Reserva extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'reserva';             // table name
    public $id;                              // int(4)  primary_key not_null
    public $quadra_id;                       // int(4)   not_null
    public $horario_id;                      // int(4)   not_null
    public $cliente_id;                      // int(4)   not_null
    public $mensal;                          // varchar(1)  
    public $data;                            // datetime  

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
