<?php
        get_header();
?>
<main class="main-content">
      <h1 class="sr-only">Услуги</h1>
      <div class="wrapper">
        <ul class="breadcrumbs">
          <li class="breadcrumbs__item breadcrumbs__item_home">
            <a href="index.html" class="breadcrumbs__link">Главная</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="services.html" class="breadcrumbs__link">Услуги</a>
          </li>
        </ul>
        <?php 
        if(have_posts()):
        ?>
        <ul class="services-list">
          <?php while(have_posts()):
              the_post();      
            ?>
          <li class="services-list__item service">
            <h2 class="service__name main-heading"> <?php the_title(); ?> </h2>
            <p class="service__text"> 
              <?php the_field('services_description');?> 
            </p>
            <p class="service__action">
              <a data-post-id="<?php echo $id; ?>" href="#modal-form" class="service__subscribe btn btn_modal">записаться</a>
              <strong class="service__price price"> <?php the_field('services_price'); ?> 
              <span class="price__unit">р./мес.</span>
              </strong>
            </p>
            <figure class="service__thumb">
              <?php ?>
              <img src="<?php echo get_field('services_img')['url']; ?>" alt="" class="service__img">
            </figure>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php 
        else:
          get_template_part('template/no-posts.php');
        endif;
        ?>
      </div>
    </main>

<?php
        get_footer();
?>