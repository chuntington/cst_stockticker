<?php 
class cst_widget extends WP_Widget {
    function cst_widget() {
        $widget_ops = array('classname' => 'cst_widget', 'description' => 'GPS stock ticker widget.' );
        $this->WP_Widget('cst_widget', 'GPS Stock Ticker', $widget_ops);
    }
 
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'display' => '', 'background' => '' ) );
        $display = $instance['display'];
        $background = $instance['background'];
?>
    <p>
        <label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Background:', 'wp_widget_plugin'); ?></label>
        <input id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php echo $background; ?>" placeholder="hex or rgb(a)"/>
        <br><br>
        <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display type:', 'wp_widget_plugin'); ?></label>
        <select name="<?php echo $this->get_field_name('display'); ?>" id="<?php echo $this->get_field_id('display'); ?>" class="widefat">
            <?php $options = array('scroll', 'fade (wip)');
            foreach ($options as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', $display == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
        </select>
<?php }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['display'] = $new_instance['display'];
        $instance['background'] = $new_instance['background'];
        return $instance;
    }
 
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
 
        echo $before_widget;
        $display = esc_attr($instance['display']);
        $background = esc_attr($instance['background']);
 
        //Widget code
        wp_enqueue_script('scroll');
        wp_enqueue_script('cst-stocks-init');
        echo '<div class="stockContainer" data-array="';
        foreach (get_option('cst_options') as $key => $value) { echo $value.' '; };
        echo '" data-display="'. $display .'" style="background:'.$background.';"><ul class="stockTick" id="scroller"></ul></div>';

        echo $after_widget;
    }
}

add_action( 'widgets_init', create_function('', 'return register_widget("cst_widget");') );
?>