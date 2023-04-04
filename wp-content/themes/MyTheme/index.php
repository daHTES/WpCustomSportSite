<?php
 get_header();
 if(is_home()):
?>
    <main class="main-content">
      <h1 class="sr-only">Страница категорий блога на сайте спорт-клуба SportIsland</h1>
      <div class="wrapper">
      <?php get_template_part('template/breadcrumps');?>
      </div>
      <section class="last-posts">
        <div class="wrapper">
          <h2 class="main-heading last-posts__h"> последние записи </h2>
          <ul class="posts-list">
            <?php
            while( have_posts() ):
              the_post();
            ?>
            <li class="last-post">
              <a 
              href="<?php the_permalink(); ?>" 
              class="last-post__link" 
              aria-label="Читать текст статьи: <?php the_title(); ?>">

                <figure class="last-post__thumb">
                  <?php the_post_thumbnail('full', ['class' => 'last-post__img']); ?>
                </figure>
              <div class="last-post__wrap">
                  <h3 class="last-post__h"> 
                    <?php the_title(); ?>
                  </h3>
                  <p class="last-post__text"> 
                    <?php echo get_the_excerpt(); ?>
                  </p>
                  <span class="last-post__more link-more">Подробнее</span>
                </div>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </section>
      <?php 
      $catts = get_categories();
      if($catts)""
      ?>
      <section class="categories">
        <div class="wrapper">
          <h2 class="categories__h main-heading"> категории </h2>
          <ul class="categories-list">
            <?php foreach($catts as $cat):
            $cat_link = get_category_link($cat->cat_ID);
            $img = get_field('cat_samp', 'category_' . $cat->cat_ID);
            $img_url = $img['url'];
              ?>
            <li class="category">
              <a href="<?php echo $cat_link; ?>" class="category__link">
                <img src="<?php echo $img_url; ?>" alt ="" class="category__thumb">
                <span class="category__name"><?php echo $cat->name; ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </section>
      <?php endif; ?>
    </main>
    <main class="main-content">
      <h1 class="sr-only">Страница на сайте спорт-клуба SportIsland</h1>
      <div class="wrapper">
        <ul class="breadcrumbs">
          <li class="breadcrumbs__item breadcrumbs__item_home">
            <a href="index.html" class="breadcrumbs__link">Главная</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="blog.html" class="breadcrumbs__link">Блог</a>
          </li>
        </ul>
      </div>
      <?php 
      if(have_posts()):  
      ?>
      <section class="last-posts">
        <div class="wrapper">
          <h2 class="main-heading last-posts__h"> Записи </h2>
          <ul class="posts-list">
            <?php 
            while( have_posts() ):
              the_post();
            ?>
            <li class="last-post">
              <a 
              href="<?php the_permalink(); ?>" 
              class="last-post__link" 
              aria-label="Читать текст статьи: <?php the_title(); ?>">

                <figure class="last-post__thumb">
                  <?php the_post_thumbnail('full', ['class' => 'last-post__img']); ?>
                </figure>
              <div class="last-post__wrap">
                  <h3 class="last-post__h"> 
                    <?php the_title(); ?>
                  </h3>
                  <p class="last-post__text"> 
                    <?php echo get_the_excerpt(); ?>
                  </p>
                  <span class="last-post__more link-more">Подробнее</span>
                </div>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </section>
      <?php
      else:     
        get_template_part('template/no-posts');
      endif; ?>
      
    </main>

<?php
        get_footer();
?>