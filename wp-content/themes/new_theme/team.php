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
