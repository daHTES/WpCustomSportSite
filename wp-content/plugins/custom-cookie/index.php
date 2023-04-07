<?php
/*
Plugin Name: Кастомный плагин для куки

*/
register_activation_hook(__FILE__, 'si_activation');
register_deactivation_hook(__FILE__, 'si_deactivation');
add_action('admin_menu', 'si_register_menu');
add_action('wp_footer', 'si_footer_page_view');
add_action('wp_ajax_nopriv_si_cookie_ajax', 'si_ajax_handler');
add_action('wp_ajax_si_cookie_ajax', 'si_ajax_handler');

function si_options(){
    return [
        'si_bg' => '#000',
        'si_color' => '#fff',
        'si_text' => 'Мы используем куки',
        'si_position' => 'bottom'
    ];
}

function si_activation(){
    $options = si_options();
    foreach($options as $key => $value){
        update_option($key, $value);
    }

}

function si_deactivation(){
    $options = si_options();
    foreach($options as $key => $value){
            delete_option($key);
    }
}

function si_register_menu(){
    add_menu_page(
        'Cookie уведомление',
        'Cookie уведомление',
        'manage_options',
        'si_setting',
        'si_admin_page_view',
        'dashicons-welcome-view-site'
    );
}

function si_admin_page_view(){
    if(!empty($_POST)){
        update_option('si_bg', $_POST['si_bg']);
        update_option('si_colo', $_POST['si_color']);
        update_option('si_text', $_POST['si_text']);
        update_option('si_position', $_POST['si_position']);
    }
   $bg = get_option('si_bg');
   $color = get_option('si_color');
   $text = get_option('si_text');
   $position = get_option('si_position');

?>
    <h2>Настройки уведомления</h2>
    <form method="POST">
        <p>
            <label>
                Введите значения для фона:
                <input type="text" name="si_bg" value="<?php echo $bg; ?>">
            </label>
        </p>
        <p>
            <label>
                Значение для цвета текста:
                <input type="text" name="si_color" value="<?php echo $color; ?>">
            </label>
        </p>
        <p>
            <label>
                Введите текст уведомления:
                <input type="text" name="si_text" value="<?php echo $text; ?>">
            </label>
        </p>
        <fieldset>
            <legend>
                Выберите положение для уведомления:
            </legend>
            <label>
                Сверху
                <input 
                type="radio" 
                name="si_position" 
                value="top"
                <?php checked('top', $position, true); ?>
                >
            </label>
            <label>
                Снизу
                <input 
                type="radio" 
                name="si_position" 
                value="bottom"
                <?php checked('bottom', $position, true); ?>
                >
            </label>
        </fieldset>
        <br>
        <button type="submit">Сохранить настройки</button>
    </form>

<?php
}

function si_footer_page_view(){
    if($_COOKIE['si_cookie_agreement'] !== 'agreed'):
    $bg = get_option('si_bg');
    $color = get_option('si_color');
    $text = get_option('si_text');
    $position = get_option('si_position');
    $css = $position . ': 0;'; 
?>
        <div class="alert">
            <div class="wrapper">
                <?php echo $text; ?>
                <br>
                <button class="alert_btn">Я согласен</button>
            </div>
            <style>
                .alert{
                    color: <?php echo $color; ?>;
                    background-color: <?php echo $bg; ?>;
                    position: fixed;
                    <?php echo $css; ?>;
                    left: 0;
                    z-index: 9999999;
                    text-align: center;
                    font-size: 30px;
                    padding: 20px 10px;
                    width: 100%;
                }
                .alert button{
                    border: 1px solid <?php echo $color; ?>;
                    background-color: transparent;
                    font: inherit;
                    font-size: 14px;
                    color: <?php echo $color; ?>;
                    padding: 10px 20px;
                    cursor: pointer;
                }
                .alert button:hover,
                .alert button:active,
                .alert button:focus{
                    background-color: <?php echo $color; ?>;
                    color: <?php echo $bg; ?>;
                    transition: 0.3s;
                }
            </style>
            <script>
                const url = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";
                const btn = document.querySelector('.alert_btn');
                btn.addEventListener('click', function(e){
                        const data = new FormData();
                        data.append('action', 'si_cookie_ajax');
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', url);
                        xhr.send(data);
                        xhr.addEventListener('readystatechange', function(){
                            if(xhr.readyState !== 4) return;
                            if(xhr.status === 200){
                                btn.parentElement.parentElement.remove();
                            }
                        })
                })
            </script>
        </div>
<?php
    endif;
function si_ajax_handler(){
    setcookie('si_cookie_agreement', 'agreed', time()+60*60*24*30, '/');
    echo 'OK';
    wp_die();
}

}