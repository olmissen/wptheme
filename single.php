<?php get_header(); ?>
    

  <div id="main">
  	<div id="<?php echo get_the_ID(); ?>" class="single">
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	    <h1><?php the_title(); ?></h1>
	    <?php the_content(__('(more...)')); ?>
	    <div id="post-info"><p><?php the_time('j. F Y') ?></p></div>
	    <hr class="post-seperator"/>
	    <?php endwhile; else: ?>
	    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	    <?php endif; ?>
	</div><!-- id=postID class=single-->
  </div><!-- main-->
<?php get_footer(); ?>