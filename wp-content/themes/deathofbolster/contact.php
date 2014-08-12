<div id="contact-form" class="contact">
	<?php
	//init variables
		$cf = array();
		$sr = false;	
		if(isset($_SESSION['cf_returndata'])){
			$cf = $_SESSION['cf_returndata'];
			$sr = true;
		}
    ?>
    <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
    	<li id="info">There were some problems with your form complition:</li>
            <?php 
	        	if(isset($cf['errors']) && count($cf['errors']) > 0) :
				foreach($cf['errors'] as $error) :
			?>
        	<li><?php echo $error ?></li>
                <?php
					endforeach;
				endif;
				?>  
				<p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Thanks for your message!</p>
    </ul>
				<form method="post" action="<?php echo get_template_directory_uri(); ?>/talktome.php">  
					<label for="name">Name:<span class="required">*</span></label>  
					<input type="text" id="name" name="name" value="" required="required" />  
					<label for="email">Email Address:<span class="required">*</span></label>  
					<input type="email" id="email" name="email" value="" required="required" />  
					<label for="telephone">Telephone: </label>  
					<input type="tel" id="telephone" name="telephone" value="" />   
					<label for="message">Message: (at least 20 characters)<span class="required">*</span></label>  
					<textarea id="message" name="message" required="required" data-minlength="20" id="styled" onfocus="this.value=''; setbg('#e5fff3');" onblur="setbg('white')"></textarea>
					<span id="loading"></span>  
					<input  type="submit" value="Send Message" id="submit-button" /> 
					<p id="req-field-desc"><span class="required">*</span> indicates a required field</p>  
				</form>
</div>
