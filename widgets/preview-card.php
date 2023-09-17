<?php

namespace Elementor;

class MY_First_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'mew_id';
    }
    public function get_title()
    {
        return __('Example Widget', 'my-elementor-widget');
    }
    public function get_script_depends()
    {
        return [
            'my_script'
        ];
    }

    public function get_icon()
    {
        return '';
    }
    public function get_categories()
    {
        return [
            'myew-for-elementor'
        ];
    }

    public function _register_controls()
    {
        //Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content Settings', 'my-elementor-widget'),
                'tab'   =>  \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->end_controls_section();

        //Style tab
        $this->style_tab();
    }

    private function style_tab()
    {
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <h1>My first ELementor</h1>
<?php
    }

    protected function content_template()
    {
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new MY_First_Widget());
