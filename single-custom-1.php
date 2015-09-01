<?php
/*
Modello di pubblicazione: Carta intestata con barra dx
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

<div class="postentry">
<div class="avviso">
<?php the_content(); ?>
<?php wp_link_pages(); ?>

            <div class="footer">
            <hr>            
                        <?php if (!is_page()) { ?>
                        <p>Data di pubblicazione: <?php the_time('j F Y') ?><br />
                        <?php
                             if (get_post_type() == 'post') {
                               echo 'Contenuto in: '; the_category(', ');
                             } else { echo '<br/>'; }
                        ?>      
                        <?php $posttags = get_the_tags($post->ID);
                                        if ($posttags) { ?>
                                            <span><br />Tag:</span>
                                            <?php
                                            foreach($posttags as $tag) {
                                                echo '<a href="';
                                                echo get_tag_link($tag);
                                                echo '">';
                                                echo $tag->name . '';
                                                echo '</a> ';
                                            }
                                        }
                        ?>
                        <?php } ?></p>
            </div>
</div>
</div>

        </div>


    <?php endwhile; else : ?>
        <h2><?php _e('Non trovato'); ?></h2>
        <p><?php _e('Spiacenti, ma la pagina richiesta non � stata trovata.'); ?></p>
    <?php endif; ?>
</div>
<?php  
get_sidebar('right'); 
get_footer(); 
?>
