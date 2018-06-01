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
 * Table Definition for quadra
 */

require_once 'DB/DataObject.php';

class Quadra extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'quadra';              // table name
    public $id;                              // int(4)  primary_key not_null
    public $unidade_id;                      // int(4)   not_null
    public $nome;                            // varchar(45)  
    public $descricao;                       // text  

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    public static function showQuadra($id) {
        $quadra = new Quadra();
        $quadra->get($id);
        return Unidade::showUnidade($quadra->unidade_id).' - '.utf8_encode($quadra->nome);
    }
    
    public function showAll() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/quadra");
        $tpl->loadTemplateFile('lista.tpl.html');
        $tpl->setVariable('HOME', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('IMAGE_URL', IMAGE_URL);
        
        if ($this->count() == 0) {
            $tpl->touchBlock('table_none');
        }
        
        while ($this->fetch()) {
            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('Nome', utf8_encode($this->nome));
            $tpl->setVariable('Unidade', Unidade::showUnidade($this->unidade_id));
            $tpl->parse('table_row');
        }
        
        return $tpl->get();
    }
    
    public function showForm() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/quadra");
        $tpl->loadTemplateFile('form.tpl.html');
        
        $tpl->setVariable('ID', (empty($this->id)) ? 0 : $this->id);
        $tpl->setVariable('Unidade', Unidade::showSelect($this->unidade_id));
        $tpl->setVariable('Nome', utf8_encode($this->nome));
        $tpl->setVariable('Descricao', utf8_encode($this->descricao));
        
        return $tpl->get();
    }
    
    public function showFormDel() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/quadra");
        $tpl->loadTemplateFile('formDel.tpl.html');
        
        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('Nome', utf8_encode($this->nome).' - '.Unidade::showUnidade($this->unidade_id));
        
        return $tpl->get();
    }
    
    public static function showSelect($id = null) {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/quadra");
        $tpl->loadTemplateFile('select.tpl.html');
        
        $quadra = new Quadra();
        $quadra->find();
        while ($quadra->fetch()) {
            $tpl->setVariable('Nome', $quadra->showQuadra($quadra->id));
            $tpl->setVariable('ID', $quadra->id);
            $tpl->setVariable('Selected', ($quadra->id == $id) ? ' selected="selected"' : '');
            $tpl->parse('table_row');
        }
        
        return $tpl->get();
    }
}
