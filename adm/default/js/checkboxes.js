function setupLabel() {
	
		if ($(':checkbox').length)
		{
			$(this).parent('label').addClass('.label_check');
			
		    $(':checkbox').each(function(){
                $(this).parent('label').removeClass('c_on');
            });
            
			$(':checkbox:checked').each(function(){
                $(this).parent('label').addClass('c_on');
            });
			
        };
        
	
		if ($(':radio').length)
		{
			$(this).parent('label').addClass('.label_radio');
			
		    $(':radio').each(function(){
                $(this).parent('label').removeClass('r_on');
            });
            
			$(':radio:checked').each(function(){
                $(this).parent('label').addClass('r_on');
            });
			
        };
	}
	
    $(document).ready(function(){
    	
		setupLabel();
		
		$('.label_check, .label_radio').live('click', function(){
            setupLabel();
        });
        
    });