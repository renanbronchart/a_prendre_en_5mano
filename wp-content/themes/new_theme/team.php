<!-- <section class='team' data-target-parallax='.team__member' speed-parallax='10'>
  <div class='team__title'>
    <h2>Team member</h2>
    <p>Voici notre équipe</p>
  </div>
  <div class='team__members'>
    <?php
      // $loop = new WP_Query( array( 'post_type' => 'team_member') );
      // $index = -1;
      // while ( $loop->have_posts() ) : $loop->the_post(); $index++;
    ?>

    <div class='team__member' data-parallax='true' data-scroll='<?php // the_field('parallax-speed'); ?>'>
      <div class='team__memberPhoto'>
        // <?php // the_post_thumbnail(); ?>
        <?php ?>
      </div>
      <div class="team__details">
        <h3 class='team__memberName'>
          // <?php // the_field('nom'); ?>
          // <?php // the_field('prenom'); ?>
        </h3>
        <div class='team__memberDescription'>
          <?php // the_content(); ?>
        </div>
      </div>
    </div>

    <?php
      // endwhile;
    ?>

  </div>
</section> -->




<section class='team' >
  <div class='title-bloc'>
    <h4 class='section__title'>Notre equipe </h4>
    <h3 class='section__subtitle'>Les visages derriere ce projet</h3>
  </div>
  <ul class='team__members'><?php
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
