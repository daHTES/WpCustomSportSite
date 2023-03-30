<?php


class SI_Widget_HelpUs extends WP_Widget{

        public function __construct()
        {
            parent::__construct(
                'si_widget_helpus',
                'Вставить емеил и данные в подвал - текстовый виджет', 
                [
                    'name' => 'Вставить емеил и данные в подвал - текстовый виджет',
                    'description' => 'Вывод email в подвале'
                ]);
        }

        public function form($instance){
?>
    <p>
        <label for="<?php echo $this->get_field_id('id-text') ?>">
            Введите текст:
        </label>
        <textarea
            id="<?php echo $this->get_field_id('id-text') ?>"
            type="text"
            name="<?php echo $this->get_field_name('text') ?>"
            value="<?php echo $instance['text']; ?>"
        >
                <?php echo $instance['text']; ?>
        </textarea>
    </p>

<?php
        }

        public function widget($args, $instance){
            echo apply_filters('si_widget_text', $instance['text']);
        }

        public function update($new_instance, $old_instance){
            return $new_instance;
        }
}
?>