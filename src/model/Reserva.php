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
    public $data_fim;                        // datetime  
    public $status;                          // varchar(1)   not_null default_1

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    public function showAll() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/reserva");
        $tpl->loadTemplateFile('lista.tpl.html');
        $tpl->setVariable('HOME', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['REQUEST_URI']);
        $tpl->setVariable('IMAGE_URL', IMAGE_URL);
        
        if ($this->count() == 0) {
            $tpl->touchBlock('table_none');
        }
        
        $i = 0;
        while ($this->fetch()) {
            $tpl->setVariable('ID', $this->id);
            $tpl->setVariable('Cliente', Cliente::showCliente($this->cliente_id));
            $tpl->setVariable('Quadra', Quadra::showQuadra($this->quadra_id));
            $tpl->setVariable('Horario', Horario::showHorario($this->horario_id));
            
            $data = new DateTime($this->data);
            $mensalFim = ($this->data_fim) ? ' <small>[até '.date2show($this->data_fim).']</small>' : '';
            $mensal = ($this->mensal == 'S') ? 'Mensalista ('.diaSemana($data->format('w')).')'.$mensalFim : date2show($this->data);
            
            $event = new HTML_Template_Sigma(VIEW_DIR . "/reserva");
            $event->loadTemplateFile('event.tpl.html');
            $event->setVariable('Titulo', Quadra::showQuadra($this->quadra_id));
            
            $horario = new Horario();
            $horario->get($this->horario_id);
            $hora = $horario->inicio_hora.':'.$horario->inicio_minuto;
            $horaFim = date("H:i", strtotime($hora.' + '.$horario->duracao.' minutes'));
            
            $event->setVariable('URL', 'javascript:;');
            $virgula = ($i > 0) ? ',' : '';
            
            if ($this->mensal == 'S') {
                $event->touchBlock('mensal');
                $tpl->touchBlock('mensal');
                if (!$this->data_fim) {
                    $tpl->touchBlock('cancelar');
                }
                $inicio = $hora;
                $fim = $horaFim;
                $event->setVariable('InicioData', $data->format('Y-m-d'));
                $event->setVariable('FimData', $data->format('Y-m-d'));
                $event->setVariable('Dia', $data->format('w'));
                $event->setVariable('Cor', '#f56954');
                if (empty($this->data_fim) || !$this->data_fim) {
                    $event->setVariable('End', "moment('".$data->format('Y-m-d')."','YYYY-MM-DD').endOf('year')");
                } else {
                    $dataFim = new DateTime($this->data_fim);
                    $event->setVariable('End', "moment('".$dataFim->format('Y-m-d')."','YYYY-MM-DD')");
                }
            } else {
                $event->hideBlock('mensal');
                $tpl->hideBlock('mensal');
                $inicio = $data->format('Y-m-d').'T'.$hora.':00';
                $fim = $data->format('Y-m-d').'T'.$horaFim.':00';
                $event->setVariable('Cor', '#3c8dbc');
            }
            $event->setVariable('Inicio', $inicio);
            $event->setVariable('Fim', $fim);
            
            $tpl->setVariable('Data', $mensal);
            $tpl->parse('table_row');
            $tpl->setVariable('Eventos', $virgula.$event->get());
            $tpl->parse('events');
            $i++;
        }
        
        return $tpl->get();
    }
    
    public function showForm() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/reserva");
        $tpl->loadTemplateFile('form.tpl.html');
        
        $tpl->setVariable('ID', (empty($this->id)) ? 0 : $this->id);
        $tpl->setVariable('Clientes', Cliente::showSelect($this->cliente_id));
        $tpl->setVariable('Quadras', Quadra::showSelect($this->quadra_id));
        $tpl->setVariable('Horarios', Horario::showSelect($this->horario_id));
        $tpl->setVariable('Data', date2show($this->data));
        $tpl->setVariable('Mensal', ($this->mensal == 'S') ? ' checked="checked"' : '');
        
        return $tpl->get();
    }
    
    public function showFormDel() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/reserva");
        $tpl->loadTemplateFile('formDel.tpl.html');
        
        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('Cliente', Cliente::showCliente($this->cliente_id));
        $tpl->setVariable('Quadra', Quadra::showQuadra($this->quadra_id));
        $tpl->setVariable('Horario', Horario::showHorario($this->horario_id));
        $data = new DateTime($this->data);
        $mensal = ($this->mensal == 'S') ? 'Mensalista ('.diaSemana($data->format('w')).')' : date2show($this->data);
        $tpl->setVariable('Data', $mensal);
        
        return $tpl->get();
    }
    
    public function showFormCancel() {
        $tpl = new HTML_Template_Sigma(VIEW_DIR . "/reserva");
        $tpl->loadTemplateFile('formCancel.tpl.html');
        
        $tpl->setVariable('ID', $this->id);
        $tpl->setVariable('Cliente', Cliente::showCliente($this->cliente_id));
        $tpl->setVariable('Quadra', Quadra::showQuadra($this->quadra_id));
        $tpl->setVariable('Horario', Horario::showHorario($this->horario_id));
        $data = new DateTime($this->data);
        $mensal = ($this->mensal == 'S') ? 'Mensalista ('.diaSemana($data->format('w')).')' : date2show($this->data);
        $tpl->setVariable('Data', $mensal);
        $tpl->setVariable('DataFim', date('d/m/Y'));
        
        return $tpl->get();
    }
    
    public function delete() {
        $this->status = 0;
        return $this->update();
    }
}
