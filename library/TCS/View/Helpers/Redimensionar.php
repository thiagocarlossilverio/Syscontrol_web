<?php
class TCS_View_Helpers_Redimensionar {
   public function Redimensionar($img, $lar_maxima = NULL, $alt_maxima = NULL, $qualidade = 80) {
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->init();
        $this->view = $viewRenderer->view;
		
		$pastaDestino 	= 'MiniaturaTMP/';
		$caminhoCompleto= ROOT_DIR.'/imagens';
		
		if(!is_file($caminhoCompleto.$this->view->BaseUrl($img))){
			return false;
		}
		
		$arquivoOriginal = $caminhoCompleto.$this->view->BaseUrl($img);
		$dimensao		 = getimagesize($arquivoOriginal);
		$widthOriginal	 = $dimensao[0];
		$heightOriginal	 = $dimensao[1];
		
		
		if(!is_numeric($lar_maxima) or $lar_maxima <= 0){
			$lar_maxima 	= $widthOriginal;
		}
	
	
		if(!is_numeric($alt_maxima) or $alt_maxima <= 0){
			$alt_maxima 	= $heightOriginal;
		}
		if(!is_numeric($qualidade) or $qualidade <= 0){
			$qualidade		= 100;
			
		}
		
		if(($widthOriginal == $lar_maxima and $heightOriginal == $alt_maxima) and $qualidade == 100){
			return $this->view->BaseUrl($img);
		}
	
		$imagem 		= explode('/', $img); 
		$qnt			= count($imagem)-1;	  
		$extensao		= explode('.', $imagem[$qnt]);    		  
		$extensao		= $extensao[count($extensao)-1]; 		 
		$imagem			= substr($imagem[$qnt], 0, (strlen($imagem[$qnt])-(strlen($extensao)+1))); 	 
		$imgFinal		= 'l'.$lar_maxima.'a'.$alt_maxima.'q'.$qualidade.'_'.$imagem;	  			
		
		if(file_exists($pastaDestino.$imgFinal.'.'.$extensao)){
			return $this->view->BaseUrl($pastaDestino.$imgFinal.'.'.$extensao);
		}
		
		$file    = $this->view->BaseUrl($img);
		$file	 = substr($file, 1, strlen($file));
		
		
		$handle =  Zend_Controller_Action_HelperBroker::getStaticHelper('ClassUpload');
		$handle -> Upload($file);
		
		
		if (!$handle->uploaded){
			return false;
		}
				$handle->image_resize= true;	 
				$handle->image_ratio= true; 	 	
				$handle->image_x = $lar_maxima;	
				$handle	->image_y = $alt_maxima; 
				$handle->file_overwrite = true;
				$handle->jpeg_quality = $qualidade.'%';
				$handle->file_new_name_body = $imgFinal ;	
				$handle->process($pastaDestino);				
			
			$imgFinal		= 'l'.$lar_maxima.'a'.$alt_maxima.'q'.$qualidade.'_'.$imagem;
			return $retorna = $this->view->BaseUrl('MiniaturaTMP/'.$imgFinal.'.'.$extensao);
	}
}
