<?php
/**
 * Tabs shortcode
 *
 * Forked from Simple Shortcodes Plugin
 * (http://www.simplethemes.com)
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_tabgroup($params, $content = null){
    if (!has_shortcode($content, 'tab')) {
        return;
    }
    $GLOBALS['tab_count'] = 0;
    $GLOBALS['tabs'] = '';
    do_shortcode( $content );
    if( is_array( $GLOBALS['tabs'] ) ){
        foreach( $GLOBALS['tabs'] as $tab ){
            $tabs[] = '<li role="presentation" CLASS="'.$tab['active'].'"><a href="#'.$tab['id'].'" aria-controls="'.$tab['id'].'" role="tab" data-toggle="tab">'.$tab['title'].'</a></li>';
            $panes[] = '<div role="tabpanel" class="tab-pane'.$tab['active'].'" id="'.$tab['id'].'">'.$tab['content'].'</div>';
        }

    $return = '<div role="tabpanel">'
            . '    <!-- Nav tabs -->'
            . '    <ul class="nav nav-tabs nav-justified" role="tablist">'
            .          implode( "\n", $tabs )
            . '    </ul>'
            . '    <!-- Tab panes -->'
            . '    <div class="tab-content">'
            .          implode( "\n", $panes )
            . '    </div>'
            . '</div>';
    }
    return $return;
}
add_shortcode( 'tabs', 'shortcode_tabgroup' );

function shortcode_tab($params, $content = null){
    extract(shortcode_atts(array(
        'title' => '%d',
        'id' => uniqid('tab_'. rand())
                    ), $params));
    $content = preg_replace( '/<br class="nc".\/>/', '', $content );

    $x = $GLOBALS['tab_count'];

    $GLOBALS['tabs'][$x] = array(
        'title' => sprintf( $title, $GLOBALS['tab_count']),
        'content' =>  $content,
        'id' =>  $id,
        'active' => ($GLOBALS['tab_count'] == 0) ? ' active' : ''
    );

    $GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'shortcode_tab' );