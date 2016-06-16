/* Author: 
	
*/

			jQuery(function($){
				
				$('#bazingaContent').jScrollPane({
            	    verticalDragMaxHeight:24,
	                verticalDragMinHeight:24,
                	verticalDragMinWidth:24,
                	verticalDragMaxWidth:24,
                	verticalGutter:0,
                	autoReinitialise: true,
            	});

				var apiJsScrollPane = $('#bazingaContent').data('jsp');
				var throttleTimeout;
				$(window).bind(
					'resize',
					function()
					{
						if ($.browser.msie) {
							if (!throttleTimeout) {
								throttleTimeout = setTimeout(
									function()
									{
										apiJsScrollPane.reinitialise();
										throttleTimeout = null;
									},
									50
								);
							}
						} else {
							apiJsScrollPane.reinitialise();
						}
					}
				);

				
				
		    });

$(window).load(function(){
	
	/*var t=setTimeout(function(){
	
		$('#bazingaMenuContainer').fadeIn(300);
			
	},1000);
	*/
	
	/*
	function animateLogo() {
	
		$('#bazingaLogoContainer').animate({'background-position-y': '-=20'},1000,'linear',function(){ animateLogo();});	
	}

	$('#bazingaLogoContainer').mouseenter(function(){
		
		animateLogo();	
		
	}).mouseleave(function(){ 
		
		$('#bazingaLogoContainer').css('background-position','0px 0px');
		$('#bazingaLogoContainer').stop();
		 
	});
	
	*/
	
});
