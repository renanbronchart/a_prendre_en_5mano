
<section id="home">
  <img src="wp-content/themes/new_theme/images/swipe.svg" alt="icon swipe" class='icon-scroll'>
  <div class="background scroll-list">
      <div class="paysage" >
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/00-paysage.png" alt="">
      </div>
      <div class="marche" >
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/01-marche.png" alt="">
      </div>
      <div class="eau-sale">
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/eausale.png" alt="">
      </div>
      <div class="marche2">
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/02-marche.png" alt="">
      </div>
      <div class="instalateur">
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/installation.png" alt="">
      </div>
      <div class="association">
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/association.png" alt="">
      </div>
      <div class="fin">
          <img src="<?= get_stylesheet_directory_uri(); ?>/images/slider/fin.png" alt="">
      </div>
      <?php
      $loopContexte = new WP_Query( array( 'post_type' => 'textPresentation', 'posts_per_page' => 10 ) );
      while ( $loopContexte->have_posts() ) : $loopContexte->the_post();
          ?>
            <p data-position='<?php the_field('position')?>'>
              <?php the_field('text-explicatif') ?>
            </p>
          <?php
      endwhile;
      ?>

  </div>
</section>

<section id="participation_don" class='brown'>
    <section class="welcome">
      <div class="ocean">
        <div class="wave"></div>
      </div>
    </section>
    <div class="block_don">
        <?php
        $loopContexte = new WP_Query( array( 'post_type' => 'contexte', 'posts_per_page' => 10 ) );
        while ( $loopContexte->have_posts() ) : $loopContexte->the_post();
            ?>
            <div class="title-bloc">
                <h4 class="section__title"><?php the_title(); ?></h4>
                <h3 class="section__subtitle">
                    <?php the_field('subtitle'); ?>
                </h3>
            </div>

                <div class="description_content <?php the_field('text-align'); ?>">
                    <?php the_content() ?>
                </div>

                <div class="<?php the_field('text-align'); ?>">
                    <a href="<?php the_field('link_button'); ?>" class="button ghost" target='_blank'><?php the_field('content_button'); ?></a>
                </div>
            <?php
        endwhile;
        ?>

    </div>
</section>

<section id="projet">
    <div class="block_projet">

        <?php
        $loopProjet = new WP_Query( array( 'post_type' => 'projet') );
        $index = -1;
        while ( $loopProjet->have_posts() ) : $loopProjet->the_post(); $index++;
        ?>
        <div class="title-bloc">
            <h4 class="section__title"><?php the_title(); ?></h4>
            <h3 class='section__subtitle'>
                <?php the_field('subtitle'); ?>
            </h3>
        </div>
            <div class='description_content <?php the_field('text-align'); ?>'>
                <?php the_content(); ?>
            </div>
    </div>
    <?php
    endwhile;
    ?>

</section>


<section id="objectifs">
    <div class="block_objectif">

        <?php
        $loopObjectif = new WP_Query( array( 'post_type' => 'objectif') );
        $index = -1;
        while ( $loopObjectif->have_posts() ) : $loopObjectif->the_post(); $index++;
            ?>
            <div class="title-bloc">
                <h4 class="section__title"><?php the_title(); ?></h4>
                <h3 class='section__subtitle'>
                    <?php the_field('subtitle'); ?>
                </h3>
            </div>
                <div class='description_content <?php the_field('text-align'); ?>'>
                    <?php the_content(); ?>
                </div>
            <?php
        endwhile;
        ?>

    </div>

    <div class="block_chiffre">


        <?php
        $loopChiffre = new WP_Query( array( 'post_type' => 'chiffre') );
        $index = -1;
        while ( $loopChiffre->have_posts() ) : $loopChiffre->the_post(); $index++;
            ?>
            <div class="content_chiffre">
                <h1 class='title_chiffre <?php the_field("text-align"); ?>'>
                    <?php the_title(); ?>
                </h1>
                <div class='description_content <?php the_field('text-align'); ?>'>
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
        endwhile;
        ?>

    </div>
</section>
