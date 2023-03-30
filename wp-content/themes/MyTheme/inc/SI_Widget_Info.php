<?php

class SI_Widget_Info extends WP_Widget{
    
    public function __construct(){
        parent::__construct(
            'si_widget_info', 
            'Вставить информацию - Информация на странице Контакты', 
            [
                'name' => 'Вставить информацию - Информация на странице Контакты',
                'description' => 'Вывод информации на странице Контакты'
            ]);
    }

    public function form($instance){
        $vars = [
            'position' => 'Адрес',
            'time' => 'Время',
            'phone' => 'Телефон',
            'email' => 'Емеил'
        ];
?>
  <p>
        <label for="<?php echo $this->get_field_id('id-info') ?>">
           Выберите вариант отображения:
        </label>
        <input 
            id="<?php echo $this->get_field_id('id-info') ?>"
            type="text"
            name="<?php echo $this->get_field_name('info') ?>"
            value="<?php echo $instance['info']; ?>"
        >
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('id-var') ?>">
            Выберите вариант отображения:
        </label>
        <select 
            id="<?php echo $this->get_field_id('id-var') ?>"
            name="<?php echo $this->get_field_name('var') ?>"
        >
            <?php 
            foreach($vars as $var => $desc):          
?>
            <option value="<?php echo $var; ?>"
            <?php selected($instance['var'], $var, true); ?>
            >
                <?php echo $desc; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </p>

<?php
    }

    public function widget($args, $instance){
            switch($instance['var']){
                case 'position': 
?>
                <span class="widget-address">
                    <?php echo $instance['info']; ?>
                </span>
<?php
                    break;
                case 'time':
?>
                <span class="widget-working-time"> 
                    <?php echo $instance['info']; ?>
                </span>
<?php
                    break;
                case 'phone':
                    $regex = '/[^+0-9]/';
                    $clear_telephone = preg_replace($regex, '', $instance['info']);
?>
                <a href="<?php echo $clear_telephone?>" class="widget-phone">
                    <?php echo $instance['info']; ?>
                </a>
<?php
                    break;
                case 'mail':
?>
                <a href="mailto:<?php echo $instance['info']; ?>" class="widget-email">
                    <?php echo $instance['info']; ?>
                </a>
<?php
                    break;
                default: echo $instance['info'];
                break;

            }
    }

    public function update($new_instance, $old_instance){
            return $new_instance;
    }

}


?>