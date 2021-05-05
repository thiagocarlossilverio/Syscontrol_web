<?php

class ComumController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function topoAction(){
    
    	
    }
    
    public function topoMinhaAreaAction(){
     $login = new Zend_Session_Namespace("login");
     $this->view->dados = $login;
    	
    }
    
    public function rodapeAction(){
     
    	
    }
    
    public function rodapeMinhaAreaAction(){
     
    	
    }

    


}

