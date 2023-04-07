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
// регистрация кастомных записей
add_action('init', 'si_register_custom_post_services');
add_action('init', 'si_register_custom_post_trainers');
add_action('init', 'si_register_custom_post_schedule');
add_action('init', 'si_register_custom_post_prices');
add_action('init', 'si_register_custom_post_clubs_cart');
add_action('init', 'si_register_custom_post_application');
//регистрация таксономий
add_action('init', 'si_register_custom_tax_days_for_schedule');
add_action('init', 'si_register_custom_tax_places_for_schedule');
//регистрация шорткода
add_shortcode('si-paste-link', 'si_paste_link');
//фильтр для шорткода
add_filter('si_widget_text', 'do_shortcode');
//мета поля для Заявок
add_action('add_meta_boxes', 'si_meta_boxes_for_application');
//добавл. пост-мета полей для записей
add_action('add_meta_boxes', 'si_meta_boxes');
add_action('save_post', 'si_likes_save_meta');
// добавление полей в админку
add_action('admin_init', 'si_register_custom_slogan');
// регистрация для отправки формы
add_action('admin_post_nopriv_si-modal-form', 'si_register_modal_form');
add_action('admin_post_si-modal-form', 'si_register_modal_form');
// регистрация для обработки лайков через ajax
add_action('wp_ajax_nopriv_post-likes', 'si_register_ajax_likes');
add_action('wp_ajax_post-likes', 'si_register_ajax_likes');
//регис. колонки количества лайков в админке
add_action('manage_posts_custom_column', 'si_register_likes_count_in_admin', 5, 2);
add_filter('manage_posts_columns', 'si_register_add_col_likes_count_in_admin');
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

function si_register_custom_post_services(){
    register_post_type('services', [
                'labels' => [
                    'name' => 'Услуги',
                    'singular_name' => 'Услуга',
                    'add_new' => 'Добавить новую услугу',
                    'add_new_item' => 'Добавить новые услуги',
                    'edit_item' => 'Редактировать услуги',
                    'new_item' => 'Новая услуга',
                    'update_item' => 'Обновить',
                    'view_item' => 'Смотреть услуги',
                    'search_items' => 'Искать',
                    'not_found' => 'Не найдено',
                    'not_found_in_trash' => 'Не найдено в корзине',
                    'parent_item_colon' => '',
                    'menu_name' => 'Услуги'
                ],
                'public' => true,
                'menu_position' => 20,
                'menu_icon' => 'dashicons-buddicons-groups',
                'hierarchical' =>  false,
                'supports' => ['title', 'editor', 'thumbnail'],
                'has_archive' => true
    ]);
}

function si_register_custom_post_trainers(){
    register_post_type('trainers', [
        'labels' => [
            'name' => 'Тренера',
            'singular_name' => 'Тренер',
            'add_new' => 'Добавить нового тренера',
            'add_new_item' => 'Добавить новых тренеров',
            'edit_item' => 'Редактировать тренера',
            'new_item' => 'Новый тренер',
            'update_item' => 'Обновить',
            'view_item' => 'Смотреть тренера',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Тренеры'
        ],
        'public' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-universal-access',
        'hierarchical' =>  false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true
]);
}

function si_register_custom_post_schedule(){
    register_post_type('schedule', [
        'labels' => [
            'name' => 'Занятия',
            'singular_name' => 'Занятие',
            'add_new' => 'Добавить новое занятие',
            'add_new_item' => 'Добавить новые занятия',
            'edit_item' => 'Редактировать занятие',
            'new_item' => 'Новое занятие',
            'update_item' => 'Обновить',
            'view_item' => 'Смотреть занятие',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Занятия'
        ],
        'public' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-universal-access-alt',
        'hierarchical' =>  false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true
]);
}

function si_register_custom_post_prices(){
    register_post_type('prices', [
        'labels' => [
            'name' => 'Цены',
            'singular_name' => 'Цена',
            'add_new' => 'Добавить новую цену',
            'add_new_item' => 'Добавить новую цену',
            'edit_item' => 'Редактировать цену',
            'new_item' => 'Новая цена',
            'update_item' => 'Обновить',
            'view_item' => 'Смотреть цену',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Цены'
        ],
        'public' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-money-alt',
        'hierarchical' =>  false,
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'has_archive' => true
]);
}

function si_register_custom_post_clubs_cart(){
    register_post_type('cards', [
        'labels' => [
            'name' => 'Карты',
            'singular_name' => 'Карта',
            'add_new' => 'Добавить новую карту',
            'add_new_item' => 'Добавить новую карту',
            'edit_item' => 'Редактировать карту',
            'update_item' => 'Обновить',
            'new_item' => 'Новая карта',
            'view_item' => 'Смотреть карту',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Карты'
        ],
        'public' => true,
        'menu_position' => 19,
        'menu_icon' => 'dashicons-index-card',
        'hierarchical' =>  false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => false
]);
}

function si_register_custom_post_application(){
    register_post_type('applications', [
        'labels' => [
            'name' => 'Заявка',
            'singular_name' => 'Заявка',
            'add_new' => 'Добавить новую заявку',
            'add_new_item' => 'Добавить новую заявку',
            'edit_item' => 'Редактировать заявку',
            'update_item' => 'Обновить',
            'new_item' => 'Новая заявка',
            'view_item' => 'Смотреть заявку',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Заявки'
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 19,
        'menu_icon' => 'dashicons-text-page',
        'hierarchical' =>  false,
        'supports' => ['title'],
        'has_archive' => false
]);
}

function si_register_custom_tax_days_for_schedule(){
    register_taxonomy('schedule_days', ['schedule'], [
        'labels' => [
            'name' => 'Дни недели',
            'singular_name' => 'День недели',
            'add_new' => 'Добавить день недели',
            'add_new_item' => 'Добавить новый день недели',
            'edit_item' => 'Редактировать день недели',
            'update_item' => 'Обновить',
            'new_item' => 'Новый день недели',
            'view_item' => 'Смотреть день недели',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Дни недели'
        ],
        'description' => 'Дни недели для занятий с тренерами',
        'public' => true,
        'hierarchical' =>  true
]);
}

function si_register_custom_tax_places_for_schedule(){
    register_taxonomy('places', ['schedule'], [
        'labels' => [
            'name' => 'Залы',
            'singular_name' => 'Залы',
            'add_new' => 'Добавить Залы',
            'add_new_item' => 'Добавить новый зал',
            'edit_item' => 'Редактировать зал',
            'new_item' => 'Новый зал',
            'view_item' => 'Смотреть зали',
            'search_items' => 'Искать',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Залы'
        ],
        'description' => 'Залы занятий с тренерами',
        'public' => true,
        'hierarchical' =>  true
]);
}
/* Функции по выводу слогана сайта в админке*/
/******************************************************************* */
function si_register_custom_slogan(){
    add_settings_field(
        'si_option_field_slogan',
        'Слоган вашего сайта',
        'si_option_slogan_cb',
        'general',
        'default',
        ['label_for' => 'si_option_field_slogan']
    );
        register_setting(
        'general',
        'si_option_field_slogan',
        'strval'
        );
}
function si_option_slogan_cb($args){
    $slug = $args['label_for'];
?>
<input 
        type="text"
        id="<?php echo $slug; ?>"
        value="<?php echo get_option($slug); ?>"
        name="<?php echo $slug; ?>"
>
<?php       
}
/******************************************************************* */

/* Функции по выводу и обработке лайков*/
/******************************************************************* */
function si_meta_boxes(){
    add_meta_box(
        'si-like',
        'Количество лайков: ',
        'si_meta_like_cb',
        'post'
    );
}
function si_meta_like_cb($post_obj){
        $likes = get_post_meta($post_obj->ID, 'si-like', true);
        $likes = $likes ? $likes : 0;
        echo "<input type=\"text\" name=\"si-like\" value=\"${likes}\">";
}
function si_likes_save_meta($post_id){
        if(isset($_POST['si-like'])){
            update_post_meta($post_id, 'si-like', $_POST['si-like']);
        }
}
function si_register_ajax_likes(){
    $id = $_POST['id'];
    $todo = $_POST['todo'];
    $current_data = get_post_meta($id, 'si-like', true);
    $current_data = $current_data ? $current_data : 0;
    if($todo === 'plus'){
            $current_data++;
    }else{
        $current_data--;
    }
    $result = update_post_meta($id, 'si-like', $current_data);
    if($result){
        echo $current_data;
        wp_die();
    }else{
        wp_die('Лайк не сохранился. Попробуйте снова', 500);
    }

}
function si_register_likes_count_in_admin($column_name, $postId){
    if($column_name !== 'col_likes') return;
        $likes = get_post_meta($postId, 'si-like', true);
        echo $likes ? $likes : 0;
}
function si_register_add_col_likes_count_in_admin($default){
        $type = get_current_screen();
        if($type->post_type === 'post'){
        $default['col_likes'] = 'Лайки';
        }
        return $default;
}
/******************************************************************* */

/* Функции по выводу и обработке модального окна*/
/******************************************************************* */
function si_register_modal_form(){
    $name = $_POST['si-user-name'] ? $_POST['si-user-name'] : "Anonymus";
    $phone = $_POST['si-user-phone'] ? $_POST['si-user-phone'] : false;
    $choice = $_POST['form-post-id'] ? $_POST['form-post-id'] : 'empty';
    if($phone){
            $name = wp_strip_all_tags($name) ;
            $phone = wp_strip_all_tags($phone);
            $choice = wp_strip_all_tags($choice);
            $id = wp_insert_post(wp_slash([
                'post_title' => 'Заявка № ',
                'post_type' => 'applications',
                'post_status' => 'publish',
                'meta_input' => [
                    'si_application_name' => $name,
                    'si_application_phone' => $phone,
                    'si_application_choice' => $choice
                ]
            ]));
            if($id !== 0){
                wp_update_post([
                    'ID' => $id,
                    'post_title' => 'Заявка № ' . $id
                ]);
                update_field('applications_status', 'new', $id);
            }
    }
    header('Location: ' .  home_url());
}
/******************************************************************* */


/* Функции по метаполям Заявок и их отрисовки*/
/******************************************************************* */
function si_meta_boxes_for_application(){
            $fields = [
                'si_application_date' => 'Дата Заявки: ',
                'si_application_name' => 'Имя клиента: ',
                'si_application_phone' => 'Номер телефона: ',
                'si_application_choice' => 'Выбор клиента:'
            ];

            foreach($fields as $slug => $text){
                add_meta_box(
                    $slug,
                    $text,
                    'si_application_fields_cb',
                    'applications',
                    'advanced',
                    'default',
                    $slug
                );
            }
}

function si_application_fields_cb($post_obj, $slug){
        $slug = $slug['args'];
        $data = '';
        switch($slug){
            case 'si_application_date':
                $data = $post_obj->post_date;
                break;
            case 'si_application_choice':
                $id = get_post_meta($post_obj->ID, $slug, true);
                $title = get_the_title($id);
                $type = get_post_type_object(get_post_type($id))->labels->singular_name;
                $data = 'Клиент выбрал: <strong>' . $title . '</strong>' . '<br> Из раздела: <strong> ' . $type . '</strong>';
                break;
            default:
            $data = get_post_meta($post_obj->ID, $slug, true);
            $data = $data ? $data : 'Нет данных';
            break;
        }
        echo '<p>' . $data . '</p>';
}

// function si_application_date_cb($post_obj){
//     $date = get_post_meta($post_obj->ID, 'si_application_date', true);
//     $date = $date ? $date : '';
//     echo '<span>' . $date . '</span>';
// }

/******************************************************************* */
?>