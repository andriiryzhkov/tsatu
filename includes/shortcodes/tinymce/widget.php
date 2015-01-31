<?php
/**
 * Widget admin page
 * 
 * @package tsatu
 */

require_once(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))) . '/wp-load.php');
header('Content-Type: text/html; charset=' . get_bloginfo('charset'));
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/admin.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.widget-title').click(function() {
            var widget_id = $(this).attr('id');
            top.tinymce.activeEditor.execCommand('mceInsertContent', false, '[widget id="' + widget_id + '"/]<br class="nc"/>');
            top.tinymce.activeEditor.windowManager.close();
        });
    });
    </script>
    <style type="text/css">
        .widget-title h4 {
            margin: 10px 0;
            padding: 15px;
            line-height: 1;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-family: "Open Sans", sans-serif;
            font-size: 13px;
            font-weight: bold;
            background: #fafafa;
            color: #222;
            border: 1px solid #e5e5e5;
            -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.04);
            box-shadow: 0 1px 1px rgba(0,0,0,0.04);
        }
        .in-widget-title {
            color: #666;
        }

    </style>
</head>

<body>
    <div id="tsatu-wrapper" class="widgets">
        <p><?php _e('Choose widget you want to insert.', 'tsatu'); ?></p>
        <?php $widgets = get_option('sidebars_widgets');
        foreach($widgets['arbitrary'] as $id) {
            $widget_options = get_option('widget_' . preg_replace( '/-[0-9]+$/', '', $id ));
            $widget_number = $wp_registered_widgets[$id]['params'][0]['number'];
            $widget_title = $widget_options[$widget_number]['title'];
            $widget_title = $widget_title != '' ? ': ' . $widget_title : '';
            echo '<div id="' . $id . '" class="widget-title"><h4>' . $wp_registered_widgets[$id]['name']
                . '<span class="in-widget-title">' . $widget_title . '</span></h4></div>';
        } ?>
    </div>
</body>

</html>
