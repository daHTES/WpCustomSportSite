<?php


class SI_Widget_Contacts extends WP_Widget{
    
    public function __construct(){
        parent::__construct(
            'si_widget_contacts', 
            'Вставить контакт - контактный виджет', 
            [
                'name' => 'Вставить контакт - контактный виджет',
                'description' => 'Выводит номер телефона и адресс'
            ]
        );
    }

    public function form($instance){
?>
    <p>
        <label for="<?php echo $this->get_field_id('id-phone') ?>">
            Введите номер телефона:
        </label>
        <input 
            id="<?php echo $this->get_field_id('id-phone') ?>"
            type="text"
            name="<?php echo $this->get_field_name('phone') ?>"
            value="<?php echo $instance['phone']; ?>"
        >
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('id-address') ?>">
            Введите адресс:
        </label>
        <input 
            id="<?php echo $this->get_field_id('id-address') ?>"
            type="text"
            name="<?php echo $this->get_field_name('address') ?>"
            value="<?php echo $instance['address']; ?>"
        >
    </p>
<?php

    }

    public function widget($args, $instance){
        $telephone = $instance['phone'];
        $regex = '/[^+0-9]/';
        $clear_telephone = preg_replace($regex, '', $telephone);
?>
        <address class="main-header__widget widget-contacts">
          <a href="tel:<?php echo $clear_telephone; ?>" class="widget-contacts__phone"> 
          <?php echo $instance['phone']; ?> 
        </a>
          <p class="widget-contacts__address">
            <?php echo $instance['address']; ?>
            </p>
        </address>


<?php
    }

    public function update($new_instance, $old_instance){
            return $new_instance;
    }

}


?>