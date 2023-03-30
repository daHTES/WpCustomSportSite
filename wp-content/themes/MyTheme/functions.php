<?php
// подключение кастомного виджета
$widgets = [
    'SI_Widget_Copyright.php',
    'SI_Widget_Contacts.php',
    'SI_Widget_HelpUs.php',
    'SI_Widget_Social.php',
    'SI_Widget_Iframe.php',
    'SI_Widget_Info.php'
];
foreach($widgets as $wd){
    require_once(__DIR__ . '/inc/' . $wd);
}

add_action('after_setup_theme', 'sport_setup');
add_action('wp_enqueue_scripts', '_si_scripts');
add_action('widgets_init', 'si_register_widgets');

//регистрация шорткода
add_shortcode('si-paste-link', 'si_paste_link');

//фильтр для шорткода
add_filter('si_widget_text', 'do_shortcode');

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
            'name' => 'Сайдбар в подвале-контакты',
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
            'name' => 'Сайдбар в подвале - Центр',
            'id' => 'si-footer-3',
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

        register_widget('si_widget_copyright');
        register_widget('si_widget_contacts');
        register_widget('si_widget_helpus');
        register_widget('si_widget_social');
        register_widget( 'si_widget_iframe' );
        register_widget('si_widget_info');
}

// подключение скриптов
function _si_scripts(){
    wp_enqueue_script('js', get_template_directory_uri() . '/assets/js/js.js', [], '1.0', true);
    wp_enqueue_style('si-style', get_template_directory_uri() . '/assets/css/styles.css', [], '1.0', 'all');
}

function si_paste_link ( $attr ){
    $params = shortcode_atts([
                'link' => '',
                'text' => '',
                'type' => 'link'
    ], $attr);

    $params['text'] = $params['text'] ? $params['text'] : $params['link'];
    if($params['link']){
        $protocol = '';
        switch($params['type']){
                case 'email':
                    $protocol = 'mailto:';
                    break;
                case 'phone':
                    $protocol = 'tel:';
                    $regex = '/[^+0-9]/';
                    $params['link'] = preg_replace($regex, '', $params['link']);
                    break;
                default:
                    $protocol = '';
                break;
        }
        $link = $protocol . $params['link'];
        $text = $params['text'];
        return "<a href=\"${link}\">${text}</a>";
    }else{
        return '';
    }
}




?>