<!DOCTYPE html>
<html <?= language_attributes(); ?>>
  <head>
    <meta charset="<?= bloginfo('charset');?>">
    <meta http-equiv='X-UA-Compatible' content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <?= wp_head();?>
  </head>
  <?= $body_class = ''; if(!is_front_page()){$body_class = 'inner';}?>
  <body class="<?php echo $body_class; ?>">
    <header class="main-header">
      <div class="wrapper main-header__wrap">
        <?= the_custom_logo(); ?>
        <?php
          wp_nav_menu([
              'theme_location' => 'menu_header',
              'container' => 'nav',
              'container_class' => 'main-navigation',
              'menu_class' => 'main-navigation__list',
              'items_wrap' => '<ul class="%2$s">%3$s</ul>'
          ]);
          ?>
          <?php if(is_active_sidebar('si-header')){
            dynamic_sidebar('si-header');
          }
          ?>
        <!-- <address class="main-header__widget widget-contacts">
          <a href="tel:88007003030" class="widget-contacts__phone"> 8 800 700 30 30 </a>
          <p class="widget-contacts__address"> ул. Приречная 11 </p>
        </address> -->
        <button class="main-header__mobile">
          <span class="sr-only">Открыть мобильное меню</span>
        </button>
      </div>
    </header>