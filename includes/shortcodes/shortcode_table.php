<?php
/**
 * Table shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_table($params, $content = null) {
    extract(shortcode_atts(array(
        'type' => 'default',
        'delimiter' => ',',
        'thead' => 1
                    ), $params));

    $type = (in_array($type, array('striped', 'bordered', 'hover', 'condensed'))) ? $placement : 'default';
    //$content = preg_replace('/<br class="nc".\/>/', '', $content);
    $result = '<div class="table-responsive"><table class="table table-' . $type . '"><tbody>';
    
    $content = str_replace(array('<br />', '<br/>', '<br>'), array('', '', ''), $content);
    //$content = str_replace('<p>', '<tr>', $content);
    //$content = str_replace('</p>', '</tr>', $content);
    
    //$content = str_replace('<p>', '<tr>', $content);
    //preg_match_all('/<p>(.+?)<\/p>/', $content, $trs);
    //$content = preg_replace('/<p>(.+?)<\/p>/', '${1}#', $content);
    $content = str_replace(array('<p>', '</p>'), array('', '#'), $content);
    //$content = str_replace('\n', '', $content);
    //$content = rtrim($content, '#');
    $trs = explode('\n\r', $content);
    foreach( $trs as $tr ){
        $result .= '<tr>';
            $tds = explode($delimiter, $tr);
            foreach( $tds as $td ){
                $result .= '<td>' . $td . '</td>';
            }
        $result .= '</tr>';
    }
    //$result .= $content;
    $result .= '</tbody></table></div>';
    return force_balance_tags($result);
}

add_shortcode('table', 'shortcode_table');