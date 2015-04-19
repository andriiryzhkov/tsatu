<?php
/**
 * Grid admin page
 * 
 * Forked from Bootstrap Shortcodes Plugin
 * (https://github.com/TheWebShop/bootstrap-shortcodes)
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
<?php //wp_admin_css( 'wp-admin', true ); ?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
(function($) {
    $(document).ready(function() {
        $('#btn_insert, h5.preview').fadeOut();

        setInterval(function() {
            //Set popup's width
            var pwidth = 800;
            parent.jQuery('#TB_window,#TB_iframeContent').width(pwidth);
            parent.jQuery('#TB_window').css('margin-left', -(pwidth / 2));
        }, 100);

        $('#frm_create').submit(function(e) {
            e.preventDefault();
            append_grid($('#quantity').val());
        });

        $('#quantity').bind('keyup change', function() {
            var lastQuantity = $(this).data('lastQuantity');
            var currentQuantity = $(this).val();

            if (currentQuantity === lastQuantity) {
                return 'no need to update'
            } else {
                $(this).data('lastQuantity', currentQuantity);
                append_grid(currentQuantity);
            }
        });

        $('#col-width').bind('change keyup', function() {
            var $active = $('#demo_grid div.active');
            var val = $(this).val();
            if (isNaN(val) || val > 12 || val < 1) return;
            var cw = $active.find('.grid').text().split(' ')[1];

            $active.removeClass('col-xs-' + cw).addClass('col-xs-' + $(this).val());
            $active.find('.grid').text('Grid ' + $(this).val());
        });

        $('#col-offset').bind('keyup change', function() {

            var val = $(this).val();
            if (isNaN(val) || val > 12 || val < 0) return;

            var $active = $('#demo_grid div.active');


            var cw = $active.find('.offset').text().split(' ')[1];

            if (isNaN(cw) || cw > 12) return;

            $active.removeClass('col-xs-offset-' + cw).addClass('col-xs-offset-' + $(this).val());
            $active.find('.offset').text('Offset ' + $(this).val());
        });


        $('#demo_grid').on('click', '.demo_col', function() {
            $('#demo_grid div').removeClass('active');
            $(this).addClass('active');
            var cw = $(this).find('.grid').text().split(' ')[1];
            var os = $(this).find('.offset').text().split(' ')[1];
            $('#col-width').val(cw);
            $('#col-offset').val(os);

            $('#col-edit').fadeIn();

        });

        $('#btn_insert').click(function() {

            var shortcodes = '[row]';
            $('#demo_grid > div').each(function() {
                $(this).removeClass('demo_col active');
                var clss = $(this).attr('class').replace("xs-", "md-");
                shortcodes += '<br class="nc"/>[col type="' + clss + '"]<?php _e("Text...", "tsatu"); ?>[/col]';

            });
            shortcodes += '<br class="nc"/>[/row]<br class="nc"/>';
            top.tinymce.activeEditor.execCommand('mceInsertContent', false, shortcodes);
            top.tinymce.activeEditor.windowManager.close();
        });

    });

    function append_grid(cols) {
        if (isNaN(cols) || cols > 12) return;

        $('#btn_insert, h5.preview').fadeIn();

        var basewidth = Math.floor(12 / cols);
        var extrawidth = 12 - (basewidth * cols);
        var offset = 0;

        $('#demo_grid').empty();

        for (i = 0; i < cols; i++) {
            var cwidth = (extrawidth > 0) ? 1 : 0;
            $('#demo_grid').append('<div class="col-xs-' + (basewidth + cwidth) + ' demo_col"><span class="grid">Grid ' + (basewidth + cwidth) + '</span> <span class="offset">Offset ' + offset + '</span><h5><?php _e("Click to edit", "tsatu"); ?></h5></div>');
            extrawidth--;
        }
    }
}(jQuery));

</script>

</head>
<body>
<div id="tsatu-wrapper">
    <div id="tsatu-grid">
        <form id="frm_create" class="form-horizontal">
            <div class="form-group">
                <label for="quantity" class="col-sm-4 control-label"><?php _e('Number of columns', 'tsatu'); ?></label>
                <div class="col-sm-8">
                    <input
                        id="quantity"
                        name="quantity"
                        type="number"
                        class="form-control"
                        required
                        pattern="\b([1-9]|1[0-2])\b"
                        min="1"
                        placeholder="<?php _e('Input number from 1 - 12', 'tsatu'); ?>">
                </div>
            </div>
        </form>
        <form id="col-edit" class="form-horizontal" style="display:none;">
            <div class="form-group">
                <label for="col-width" class="col-sm-4 control-label"><?php _e('Grid', 'tsatu'); ?></label>
                <div class="col-sm-8">
                    <input
                        id="col-width"
                        name="col-width"
                        type="number"
                        class="form-control"
                        value="1"
                        required
                        pattern="\b([1-9]|1[0-2])\b"
                        min="1"
                        max="12">
                </div>
            </div>
            <div class="form-group">
                <label for="col-offset" class="col-sm-4 control-label"><?php _e('Offset', 'tsatu'); ?></label>
                <div class="col-sm-8">
                    <input
                        id="col-offset"
                        name="col-offset"
                        type="number"
                        class="form-control"
                        value="0"
                        required
                        pattern="\b([0-9]|1[0-1])\b"
                        min="0"
                        max="11">
                </div>
            </div>
        </form>

        <h2 class="preview"><?php _e('Preview', 'tsatu'); ?></h2>
        <div id="demo_grid" class="row show-grid"></div>

        <div class="form-group">
            <button id="btn_insert" class="btn btn-primary" style="display: none;"><?php _e('Insert', 'tsatu'); ?></button>
        </div>
    </div>
</div>
</body>
</html>