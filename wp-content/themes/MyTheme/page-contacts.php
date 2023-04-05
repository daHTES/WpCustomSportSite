<?php
/*
Template Name: Шаблон для Страницы Контактов.
*/

        get_header();
?>
<main class="main-content">
      <div class="wrapper">
      <?php get_template_part('template/breadcrumps');?>
      </div>
      <section class="contacts">
        <?php 
              if(have_posts()):
        while(have_posts()): 
          the_post();
          ?>
        <div class="wrapper">
          <h1 class="contacts__h main-heading"><?php the_title(); ?></h1>
          <div class="map">
            <a href="#" class="map__fallback">
              <img src="<?php echo _si_assets_path('./img/map.jpg')?>" alt="Карта клуба SportIsland">
              <span class="sr-only"> Карта </span>
            </a>
            <?php
            if(is_active_sidebar('si-map')){
              dynamic_sidebar('si-map');
            }
            ?>
          </div>
          <p class="contacts__info">
              <?php
              if(is_active_sidebar('si-footer-map')){
                dynamic_sidebar('si-footer-map');
              }
              ?>
          </p>
          <?php the_content(); ?>
        </div>
        <?php endwhile; endif;?>
      </section>
    </main>



<?php

        get_footer();
?>

