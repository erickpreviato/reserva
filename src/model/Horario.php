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
 * Table Definition for horario
 */

require_once 'DB/DataObject.php';

class Horario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'horario';             // table name
    public $id;                              // int(4)  primary_key not_null
    public $tipo_id;                         // int(4)   not_null
    public $inicio_hora;                     // int(4)  
    public $inicio_minuto;                   // int(4)  
    public $duracao;                         // int(4)  

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    public static function showHorario($id) {
        $horario = new Horario();
        $horario->get($id);
        $hora = $horario->inicio_hora.':'.$horario->inicio_minuto;
        $horaFim = date("H:i", strtotime($hora.' + '.$horario->duracao.' minutes'));
        return Tipo::showTipo($horario->tipo_id).' (das '.$hora.' às '.$horaFim.')';
    }
    
    public function showAll() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/horario");
        $tpl->loadTemplateFile('lista.tpl.html');
        $tpl->setVariable('HOME', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('IMAGE_URL', IMAGE_URL);
        
        if ($this->count() == 0) {
            $tpl->touchBlock('table_none');
        }
        
        while ($this->fetch()) {
            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('Tipo', Tipo::showTipo($this->tipo_id));
            
            $hora = $this->inicio_hora.':'.str_pad($this->inicio_minuto, 2, '0');
            $horaFim = date("H:i", strtotime($hora.' + '.$this->duracao.' minutes'));
            $tpl->setVariable('Horario', 'Das '.$hora.' às '.$horaFim);
            $tpl->parse('table_row');
        }
        
        return $tpl->get();
    }
    
    public function showForm() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/horario");
        $tpl->loadTemplateFile('form.tpl.html');
        
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('ID', (empty($this->id)) ? 0 : $this->id);
        $tpl->setVariable('Tipo', Tipo::showSelect($this->tipo_id));
        $tpl->setVariable('Hora', $this->inicio_hora);
        $tpl->setVariable('Minuto', str_pad($this->inicio_minuto, 2, '0'));
        $tpl->setVariable('Duracao', (empty($this->duracao)) ? TEMPO_QUADRA : $this->duracao);
        
        return $tpl->get();
    }
    
    public function showFormDel() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/horario");
        $tpl->loadTemplateFile('formDel.tpl.html');
        
        $tpl->setVariable('ID', $this->id);
        $hora = $this->inicio_hora.':'.$this->inicio_minuto;
        $horaFim = date("H:i", strtotime($hora.' + '.$this->duracao.' minutes'));
        $tpl->setVariable('Horario', Tipo::showTipo($this->tipo_id).' (das '.$hora.' às '.$horaFim.')');
        
        return $tpl->get();
    }
    
    public static function showSelect($id = null) {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/horario");
        $tpl->loadTemplateFile('select.tpl.html');
        
        $horario = new Horario();
        $horario->find();
        while ($horario->fetch()) {
            $tpl->setVariable('Nome', $horario->showHorario($horario->id));
            $tpl->setVariable('ID', $horario->id);
            $tpl->setVariable('Selected', ($horario->id == $id) ? ' selected="selected"' : '');
            $tpl->parse('table_row');
        }
        
        return $tpl->get();
    }
}
