<?php

add_action('after_setup_theme', 'sport_setup');
add_action('wp_enqueue_scripts', '_si_scripts');
add_action('widgets_init', 'si_register_widgets');
// настройка основных функций темы
function sport_setup(){
    // добавляем лого
    add_theme_support('custom-logo');
    // добав. тайтл
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    //регистрация меню
    register_nav_menu('menu_header', 'Меню в шапке');
    // регист. футер
    register_nav_menu('menu_footer', 'Меню в футере');
}

// функция вывода картинок
function _si_assets_path($path){
        return get_template_directory_uri() . '/assets/' . $path;
}

// регис. виджет
function si_register_widgets(){
        register_sidebar([
                'name' => 'Сайдбар в шапке',
                'id' => 'si-header',
                'before_widget' => null,
                'after_widget' => null
        ]);
        register_sidebar([
            'name' => 'Сайдбар в подвале',
            'id' => 'si-footer',
            'before_widget' => null,
            'after_widget' => null,
        ]);
        register_sidebar([
            'name' => 'Сайдбар в подвале второй',
            'id' => 'si-footer-2',
            'before_widget' => null,
            'after_widget' => null
        ]);
        register_sidebar([
            'name' => 'Сайдбар для карты',
            'id' => 'si-map',
            'before_widget' => null,
            'after_widget' => null
        ]);
        register_sidebar([
            'name' => 'Сайдбар под картой',
            'id' => 'si-footer-map',
            'before_widget' => null,
            'after_widget' => null
        ]);
}

// подключение скриптов
function _si_scripts(){
    wp_enqueue_script('js', get_template_directory_uri() . '/assets/js/js.js', [], '1.0', true);
    wp_enqueue_style('si-style', get_template_directory_uri() . '/assets/css/styles.css', [], '1.0', 'all');
}




?>