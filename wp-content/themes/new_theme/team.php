<section class='team' id='team'>
  <?php
  $loopChiffre = new WP_Query( array( 'post_type' => 'title_team') );
  while ( $loopChiffre->have_posts() ) : $loopChiffre->the_post();
      ?>
      <div class="title-bloc">
          <h4 class="section__title"><?php the_title(); ?></h4>
          <h3 class='section__subtitle'>
              <?php the_field('subtitle'); ?>
          </h3>
      </div>

      <?php
  endwhile;
  ?>
  <img src="wp-content/themes/new_theme/images/swipe.svg" alt="icon swipe" class='icon-scroll'>
  <ul class='team__members scroll-list'><?php
      $loop = new WP_Query( array( 'post_type' => 'team_member') );
      while ( $loop->have_posts() ) : $loop->the_post();
    ?><li class='team__member'>
      <div class="team__memberPhoto">
        <?php the_post_thumbnail(); ?>
      </div>
      <div class="team__details">
        <h3 class='team__memberName'>
          <?php the_field('nom'); ?>
          <?php the_field('prenom'); ?>
        </h3>
        <div class='team__memberDescription'>
          <?php the_excerpt(); ?>
        </div>
      </div>
    </li><?php
      endwhile;
    ?></ul>
</section>
