<?php get_header(); ?>

<section class="actusContainer single">
  <h3 class='section__subtitle'><?php the_title(); ?></h3>
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <div class="actusContainer__element text-center">
      <div class="listActus__element">
        <div class='listActus__media'>
          <div class="image">
              <div class="img-center">
                  <?php the_post_thumbnail(); ?>
              </div>
          </div>
        </div>
        <div class="listActus__content">
          <div class='listActus__details'>
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>

