<?php
class Redux_Options_fontawesome {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        echo '<p class="description" style="color:red;">' . __('The icons provided below are free to use custom icons from the <a href="http://fontawesome.io/" target="_blank">Font Awesome icons</a>', Redux_TEXT_DOMAIN) . '</p>';
        echo '<input type="text" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" class="iconselect"  ' . 'value="' . esc_attr($this->value) . '" />';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {
        wp_enqueue_style(
            'redux-opts-fontawesome-css',
            '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css',
            false,
            '',
            'all'
        );
        wp_enqueue_script(
            'redux-opts-fontawesome-js',
            Redux_OPTIONS_URL . 'fields/fontawesome/jquery.iconselect.js',
            array('jquery'),
            time(),
            true
        );
    }
}
