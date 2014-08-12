jQuery(document).ready(function(){
	jQuery('#site').css('display', 'none').fadeIn(200);
	jQuery('a').click(function(event){
		event.preventDefault();
		linkLocation = this.href;
	function redirectPage() {
        window.location = linkLocation;
    }
	jQuery('#site').fadeOut(200, redirectPage);   
		 });
}); 

