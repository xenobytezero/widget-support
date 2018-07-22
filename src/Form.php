<?php

namespace WidgetSupport;

class Form {

    // --------------------------------------------------------------------

    public static function render_form_option($widget, $field_id, $field_title, $opts) {

        $context = [
            'field_id' => $widget->get_field_id($field_id),
            'field_name' => $widget->get_field_name($field_id),
            'field_title' => $field_title,
            'val' => $opts[$field_id]
        ];

        \Timber\Timber::render('templates\option.twig', $context);

    }


    // --------------------------------------------------------------------

    public static function render_form_text_box($widget, $field_id, $field_title, $opts) {

        $context = [
            'field_id' => $widget->get_field_id($field_id),
            'field_name' => $widget->get_field_name($field_id),
            'field_title' => $field_title,
            'val' => $opts[$field_id]
        ];

        \Timber\Timber::render('templates\textbox.twig', $context);

    }

    // --------------------------------------------------------------------


    public static function render_form_checkbox($widget, $field_id, $field_title, $opts) {

        $context = [
            'field_id' => $widget->get_field_id($field_id),
            'field_name' => $widget->get_field_name($field_id),
            'field_title' => $field_title,
            'checked' => (bool)$opts[$field_id]
        ];

        \Timber\Timber::render('templates\checkbox.twig', $context);
        
    }


    // --------------------------------------------------------------------

    public static function save_options($new_instance, $old_nstance, $ids){

        $instance = $old_instance;

        foreach($ids as $id){
            $instance[$id] = strip_tags($new_instance[$id]);
        }
            
        return $instance;
    }



}





?>