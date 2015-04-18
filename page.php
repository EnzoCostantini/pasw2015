<?php get_header(); ?>
<?php get_sidebar(); ?>

<?php if (have_posts()){
        while (have_posts()) : the_post();
?>            <div class="post" id="post-<?php the_ID(); ?>">

            <div class="lastmodified">
            Ultima modifica: <?php the_modified_date('j F Y'); ?>
            </div>

                <h2 class="posttitle"><?php the_title(); ?></h2>

<?php 
// enzo costantini 17/04/2015 inizio modifica 
global $sub_pages;
global $root_post;
global $menu_depth;

$is_group_page = get_post_meta($post->ID, '_is_group_page', true);
$has_children = wp_list_pages("title_li=&echo=0&depth=1&child_of=".$post->ID) != false;
$has_parent =  ($post->post_parent != 0) && (!get_post_meta($post->post_parent, '_is_group_page', true));
$sub_pages = (($has_children) || ($has_parent)) && (!$is_group_page);

if($sub_pages) {                                                                                                                                                      
  
  $root_post = $post;
  $menu_depth = 1;

  if($has_parent) {
    
    $root_post = get_post($post->post_parent); 
    
    if($has_children) {
      $menu_depth = 2;
    }     
  }  
}

$pasw_submenu = get_option( 'pasw_submenu');  // visto che l'opzione viene usata più volte
                                              // vale la pena usare una variabile
if ($sub_pages && ($pasw_submenu < 3)) {
  //Genera CSS
  if ($pasw_submenu == 0) { //Verticale SX
  
  } 
  else 
  if ($pasw_submenu == 1) { //Verticale DX
      $subcss=' style="float:right;"';
  } 
  else 
  if ($pasw_submenu == 2) { // Orizzontale
      $subcss=' style="width:100%;"';
      echo '<style type="text/css">
              .sotto-pagine li { float:left; }
            </style>';       
  } ?>
                <div class="sotto-pagine" <?php echo $subcss; ?>>
                    <ul>
                        <?php wp_list_pages('depth=1&title_li=&child_of='.$root_post->ID); ?>   
                    </ul>
                </div>
<?php 
  if ($pasw_submenu == 2) { 
    echo '<div class="clear"></div>';
  }
}                                                                                                                 
// enzo costantini 17/04/2015 fine modifica                
?>     

                <div class="postentry">
                    <?php the_content(__('Leggi il resto &raquo;')); ?>
                </div>
            </div>
<?php   endwhile; } ?>
<?php
    $TitoloPagina=$post->post_title;
    if ( get_option('pasw_catpage') != 0 && get_post_meta($post->ID, 'usrlo_pagina_categoria', true)!=-1 ) {
        $categoria_pagina = get_post_meta($post->ID, 'usrlo_pagina_categoria', true);
        if(isset($categoria_pagina)){
            echo '<div class="clear"></div>
                    <div class="pagecat">';

            $category_link = get_category_link( $categoria_pagina );
            echo '<a style="float:right;padding: 20px;" href="' . esc_url( $category_link ) . '" title="Tutte le ' .  get_cat_name( $categoria_pagina) . '">Visualizza tutto &raquo;</a>';

            echo '<h3>Ultimi 5 articoli pubblicati in "' . strtolower ( get_cat_name( $categoria_pagina)) . '"</h3>';
            global $post;
                    $myposts = get_posts('numberposts=5&category='.$categoria_pagina);
                    foreach($myposts as $post) :
                            setup_postdata($post);
                            global $more;
                            $more = 0;
                    ?>
                        <h4><span class="hdate"><?php the_time('j M Y') ?></span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                  <?php the_excerpt();
                    endforeach;

            echo '</div>';
        }
    }
?>
</div>
<?php
get_sidebar('right');
get_footer();
?>
