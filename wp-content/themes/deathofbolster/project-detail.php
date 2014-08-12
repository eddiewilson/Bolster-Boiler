<div class="hero">
	<img src="<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_project_hero_image', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?>"/>
</div>



