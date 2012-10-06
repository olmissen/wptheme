<?php get_header(); ?>
    

  <div id="main">
  	<div id="category">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php		    
	$image_url = gallery_first_image();
	if($image_url)
	{
	?>
	<div class="category-gallery">
		<a href="<?php the_permalink(); ?>">
			 <img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo $image_url; ?>&amp;w=200&amp;h=200&amp;q=100&amp;zc=1" alt="<?php the_title();?>" />
		</a>
		<p class="category-gallery-thumb-info"><?php the_title(); ?></p>
	</div><!--category-gallery-->
	<?php
	}
	?>
		<?php endwhile; else: ?>
		    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	    <?php endif; ?>
	</div><!-- category -->
  </div><!-- main-->
<?php get_footer(); ?>