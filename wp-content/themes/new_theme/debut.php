
<div id="home">
    <img src="" alt="">
</div>

<section id="participation_don">
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
                    <a href="#" class="button ghost">Faire un don</a>
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


