<div id="rightsidebar" class="column">
<ul>
<?php
// enzo costantini 12/04/2015 inizio modifica
if ($sub_pages && get_option( 'pasw_submenu') == '4') {  
?>	   
    <li class="widget widget_nav_menu">		
      <h2 class="widgettitle">
        <a href="<?php echo get_permalink($root_post->ID); ?>">
          <?php echo $root_post->post_title; ?>
        </a>
      </h2>	  	
      <ul id="subpage-sidebar" class="menu">	 		
        <?php wp_list_pages('depth=1&title_li=&child_of='.$root_post->ID); // $root_post invece di $post ?>		
      </ul>	
    </li>
<?php 
// enzo costantini 12/04/2015 fine modifica 
}
if ( function_exists('generated_dynamic_sidebar')) {
    if ( function_exists('dynamic_sidebar') && generated_dynamic_sidebar() ) : endif;
} else {
    if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-2') ) : endif;
}
?>
</ul>
</div>
