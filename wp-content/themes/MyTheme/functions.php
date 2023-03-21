<?php

add_action('after_setup_theme', 'sport_setup');

// настройка основных функций темы
function sport_setup(){
    // добавляем лого
    add_theme_support('custom-logo');
    // добав. тайтл
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

// функция вывода картинок
function _si_assets_path($path){
        return get_template_directory_uri() . '/assets/' . $path;
}




?>