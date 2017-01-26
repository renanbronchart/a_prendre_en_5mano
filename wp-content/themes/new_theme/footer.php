    <footer class='footer'>
      <ul class="footer__shareLink">
              <li><a href="#">link</a></li>
              <li><a href="#">link</a></li>
              <li><a href="#">link</a></li>
      </ul><ul class="footer__listLink">
        <?php
          $loop = new WP_Query( array( 'post_type' => 'listLinkFooter') );
          $index = -1;
          while ( $loop->have_posts() ) : $loop->the_post(); $index++;
        ?>

          <li class="footer__linkElement">
            <a href="<?php the_field('link'); ?>"><?php the_title(); ?></a>
          </li>

        <?php
          endwhile;
        ?>
      </ul><ul class="footer__credits">
        <?php
          $loop = new WP_Query( array( 'post_type' => 'credits') );
          $index = -1;
          while ( $loop->have_posts() ) : $loop->the_post(); $index++;
        ?>

          <li class="footer__creaditElement">
            <?php the_content() ?>
          </li>

        <?php
          endwhile;
        ?>
      </ul>
    </footer>

    <!-- <?php // wp_footer(); ?> -->
    </div>
  </div>
  <div class="overlayBlack"></div>
  <script src="<?php bloginfo( 'template_directory' ); ?>/bundle.js"></script>
</body>
</html>
