<?php get_header(); ?>

<?php include('debut.php'); ?>
<?php include('team.php') ?>



<section class="actusContainer brown">
  <div class="title-bloc">
    <h4 class='section__title'>NOS ACTUS</h4>
    <h3 class='section__subtitle'>LES DERNIERES NEWS</h3>
  </div>
  <ul class="listActus">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <li class="listActus__element">
        <div class='listActus__media'>
          <div class="image">
              <div class="img-center">
                  <?php the_post_thumbnail(); ?>
              </div>
          </div>
        </div>
        <div class="listActus__content">
          <h3 class='listActus__title'>
            <?php the_title(); ?>
          </h3>
          <div class='listActus__details'>
            <?php the_excerpt(); ?>

            <a class='listActus__link' href="<?php the_permalink(); ?>">Lire la suite</a>
          </div>
        </div>
      </li>

  <?php endwhile; endif; ?>
  </ul>
</section>


<section class='thanks white' >
  <div class="title-bloc">
    <h4 class='section__title'>NOS PARTENAIRES</h4>
    <h3 class='section__subtitle'>Remerciements particuliers</h3>
  </div>
  <ul class='thanks__list'>
    <?php
      $loop = new WP_Query( array( 'post_type' => 'partners') );
      $index = -1;
      while ( $loop->have_posts() ) : $loop->the_post(); $index++;
    ?>

    <li class='thanks__company'>
      <div class='thanks__companyMedia'>
        <?php the_post_thumbnail(); ?>
      </div>
    </li>

    <?php
      endwhile;
    ?>

  </ul>
</section>

<section class='contactForm brown'>
  <div class="container">
    <div class="title-bloc">
      <h4 class='section__title'>NOS PARTENAIRES</h4>
      <h3 class='section__subtitle'>Remerciements particuliers</h3>
    </div>
    <div class='contactForm__content'>
      <?php
        $loop = new WP_Query( array( 'post_type' => 'contactForm') );
        $index = -1;
        while ( $loop->have_posts() ) : $loop->the_post(); $index++;
      ?>

        <?php echo do_shortcode("[huge_it_forms id='1']"); ?>
        <?php ?>


      <?php
        endwhile;
      ?>

    </div>
  </div>
</section>


<?php get_footer(); ?>

