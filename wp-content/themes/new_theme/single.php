<?php get_header(); ?>

<section class="actusContainer">
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

            <a class='listActus__link' href="<?php the_permalink(); ?>">Lire la suite</a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>

