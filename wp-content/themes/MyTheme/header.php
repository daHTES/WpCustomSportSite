<!DOCTYPE html>
<html <?= language_attributes(); ?>>
  <head>
    <meta charset="<?= bloginfo('charset');?>">
    <meta http-equiv='X-UA-Compatible' content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <?= wp_head();?>
  </head>
  <body>
    <header class="main-header">
      <div class="wrapper main-header__wrap">
        <a href="index.html" class="main-header__logolink" aria-label="Логотип-ссылка на Главную">
          <img src="img/logo.png" alt="">
        </a>
        <nav class="main-navigation">
          <ul class="main-navigation__list">
            <li>
              <a href="services.html">Услуги</a>
            </li>
            <li class="active">
              <a href="trainers.html">Тренеры</a>
            </li>
            <li>
              <a href="schedule.html">Расписание</a>
            </li>
            <li>
              <a href="prices.html">Цены</a>
            </li>
            <li>
              <a href="contacts.html">Контакты </a>
            </li>
          </ul>
        </nav>
        <address class="main-header__widget widget-contacts">
          <a href="tel:88007003030" class="widget-contacts__phone"> 8 800 700 30 30 </a>
          <p class="widget-contacts__address"> ул. Приречная 11 </p>
        </address>
        <button class="main-header__mobile">
          <span class="sr-only">Открыть мобильное меню</span>
        </button>
      </div>
    </header>