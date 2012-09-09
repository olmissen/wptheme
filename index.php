<?php get_header(); ?>
    

  <div id="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <p><?php the_content(__('(more...)')); ?></p>
    <div id="post-info"><p><?php the_time('j. F Y') ?></p></div>
    <hr class="post-seperator"/>
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
  </div><!-- main-->
<?php get_footer(); ?>