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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.glyphicons').on('click', 'li', function() {
            var iclass = $(this).find('.glyphicon').attr('class');

            top.tinymce.activeEditor.execCommand('mceInsertContent', false, '[icon name="' + iclass + '"/]<br class="nc"/>');
            top.tinymce.activeEditor.windowManager.close();
        });
    });
    </script>
    <style type="text/css">
    .glyphicons {
        padding-left: 0;
        list-style: none;
    }
    .glyphicons li {
        cursor: pointer;
        float: left;
        width: 12.5%;
        height: 100px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #DDD;
    }
    .glyphicons .glyphicon {
        display: block;
        margin: 5px auto 10px;
        font-size: 24px;
    }
    </style>
</head>

<body>
    <div id="tsatu-wrapper">
        <ul class="glyphicons">
            <li><span class="glyphicon glyphicon-adjust"></span>adjust</li>
            <li><span class="glyphicon glyphicon-align-center"></span>align-center</li>
            <li><span class="glyphicon glyphicon-align-justify"></span>align-justify</li>
            <li><span class="glyphicon glyphicon-align-left"></span>align-left</li>
            <li><span class="glyphicon glyphicon-align-right"></span>align-right</li>
            <li><span class="glyphicon glyphicon-arrow-down"></span>arrow-down</li>
            <li><span class="glyphicon glyphicon-arrow-left"></span>arrow-left</li>
            <li><span class="glyphicon glyphicon-arrow-right"></span>arrow-right</li>
            <li><span class="glyphicon glyphicon-arrow-up"></span>arrow-up</li>
            <li><span class="glyphicon glyphicon-asterisk"></span>asterisk</li>
            <li><span class="glyphicon glyphicon-backward"></span>backward</li>
            <li><span class="glyphicon glyphicon-ban-circle"></span>ban-circle</li>
            <li><span class="glyphicon glyphicon-barcode"></span>barcode</li>
            <li><span class="glyphicon glyphicon-bell"></span>bell</li>
            <li><span class="glyphicon glyphicon-bold"></span>bold</li>
            <li><span class="glyphicon glyphicon-book"></span>book</li>
            <li><span class="glyphicon glyphicon-bookmark"></span>bookmark</li>
            <li><span class="glyphicon glyphicon-briefcase"></span>briefcase</li>
            <li><span class="glyphicon glyphicon-bullhorn"></span>bullhorn</li>
            <li><span class="glyphicon glyphicon-calendar"></span>calendar</li>
            <li><span class="glyphicon glyphicon-camera"></span>camera</li>
            <li><span class="glyphicon glyphicon-certificate"></span>certificate</li>
            <li><span class="glyphicon glyphicon-check"></span>check</li>
            <li><span class="glyphicon glyphicon-chevron-down"></span>chevron-down</li>
            <li><span class="glyphicon glyphicon-chevron-left"></span>chevron-left</li>
            <li><span class="glyphicon glyphicon-chevron-right"></span>chevron-right</li>
            <li><span class="glyphicon glyphicon-chevron-up"></span>chevron-up</li>
            <li><span class="glyphicon glyphicon-circle-arrow-down"></span>circle-arrow-down</li>
            <li><span class="glyphicon glyphicon-circle-arrow-left"></span>circle-arrow-left</li>
            <li><span class="glyphicon glyphicon-circle-arrow-right"></span>circle-arrow-right</li>
            <li><span class="glyphicon glyphicon-circle-arrow-up"></span>circle-arrow-up</li>
            <li><span class="glyphicon glyphicon-cloud"></span>cloud</li>
            <li><span class="glyphicon glyphicon-cloud-download"></span>cloud-download</li>
            <li><span class="glyphicon glyphicon-cloud-upload"></span>cloud-upload</li>
            <li><span class="glyphicon glyphicon-cog"></span>cog</li>
            <li><span class="glyphicon glyphicon-collapse-down"></span>collapse-down</li>
            <li><span class="glyphicon glyphicon-collapse-up"></span>collapse-up</li>
            <li><span class="glyphicon glyphicon-comment"></span>comment</li>
            <li><span class="glyphicon glyphicon-compressed"></span>compressed</li>
            <li><span class="glyphicon glyphicon-copyright-mark"></span>copyright-mark</li>
            <li><span class="glyphicon glyphicon-credit-card"></span>credit-card</li>
            <li><span class="glyphicon glyphicon-cutlery"></span>cutlery</li>
            <li><span class="glyphicon glyphicon-dashboard"></span>dashboard</li>
            <li><span class="glyphicon glyphicon-download"></span>download</li>
            <li><span class="glyphicon glyphicon-download-alt"></span>download-alt</li>
            <li><span class="glyphicon glyphicon-earphone"></span>earphone</li>
            <li><span class="glyphicon glyphicon-edit"></span>edit</li>
            <li><span class="glyphicon glyphicon-eject"></span>eject</li>
            <li><span class="glyphicon glyphicon-envelope"></span>envelope</li>
            <li><span class="glyphicon glyphicon-euro"></span>euro</li>
            <li><span class="glyphicon glyphicon-exclamation-sign"></span>exclamation-sign</li>
            <li><span class="glyphicon glyphicon-expand"></span>expand</li>
            <li><span class="glyphicon glyphicon-export"></span>export</li>
            <li><span class="glyphicon glyphicon-eye-close"></span>eye-close</li>
            <li><span class="glyphicon glyphicon-eye-open"></span>eye-open</li>
            <li><span class="glyphicon glyphicon-facetime-video"></span>facetime-video</li>
            <li><span class="glyphicon glyphicon-fast-backward"></span>fast-backward</li>
            <li><span class="glyphicon glyphicon-fast-forward"></span>fast-forward</li>
            <li><span class="glyphicon glyphicon-file"></span>file</li>
            <li><span class="glyphicon glyphicon-film"></span>film</li>
            <li><span class="glyphicon glyphicon-filter"></span>filter</li>
            <li><span class="glyphicon glyphicon-fire"></span>fire</li>
            <li><span class="glyphicon glyphicon-flag"></span>flag</li>
            <li><span class="glyphicon glyphicon-flash"></span>flash</li>
            <li><span class="glyphicon glyphicon-floppy-disk"></span>floppy-disk</li>
            <li><span class="glyphicon glyphicon-floppy-open"></span>floppy-open</li>
            <li><span class="glyphicon glyphicon-floppy-remove"></span>floppy-remove</li>
            <li><span class="glyphicon glyphicon-floppy-save"></span>floppy-save</li>
            <li><span class="glyphicon glyphicon-floppy-saved"></span>floppy-saved</li>
            <li><span class="glyphicon glyphicon-folder-close"></span>folder-close</li>
            <li><span class="glyphicon glyphicon-folder-open"></span>folder-open</li>
            <li><span class="glyphicon glyphicon-font"></span>font</li>
            <li><span class="glyphicon glyphicon-forward"></span>forward</li>
            <li><span class="glyphicon glyphicon-fullscreen"></span>fullscreen</li>
            <li><span class="glyphicon glyphicon-gbp"></span>gbp</li>
            <li><span class="glyphicon glyphicon-gift"></span>gift</li>
            <li><span class="glyphicon glyphicon-glass"></span>glass</li>
            <li><span class="glyphicon glyphicon-globe"></span>globe</li>
            <li><span class="glyphicon glyphicon-hand-down"></span>hand-down</li>
            <li><span class="glyphicon glyphicon-hand-left"></span>hand-left</li>
            <li><span class="glyphicon glyphicon-hand-right"></span>hand-right</li>
            <li><span class="glyphicon glyphicon-hand-up"></span>hand-up</li>
            <li><span class="glyphicon glyphicon-hd-video"></span>hd-video</li>
            <li><span class="glyphicon glyphicon-hdd"></span>hdd</li>
            <li><span class="glyphicon glyphicon-header"></span>header</li>
            <li><span class="glyphicon glyphicon-headphones"></span>headphones</li>
            <li><span class="glyphicon glyphicon-heart"></span>heart</li>
            <li><span class="glyphicon glyphicon-heart-empty"></span>heart-empty</li>
            <li><span class="glyphicon glyphicon-home"></span>home</li>
            <li><span class="glyphicon glyphicon-import"></span>import</li>
            <li><span class="glyphicon glyphicon-inbox"></span>inbox</li>
            <li><span class="glyphicon glyphicon-indent-left"></span>indent-left</li>
            <li><span class="glyphicon glyphicon-indent-right"></span>indent-right</li>
            <li><span class="glyphicon glyphicon-info-sign"></span>info-sign</li>
            <li><span class="glyphicon glyphicon-italic"></span>italic</li>
            <li><span class="glyphicon glyphicon-leaf"></span>leaf</li>
            <li><span class="glyphicon glyphicon-link"></span>link</li>
            <li><span class="glyphicon glyphicon-list"></span>list</li>
            <li><span class="glyphicon glyphicon-list-alt"></span>list-alt</li>
            <li><span class="glyphicon glyphicon-lock"></span>lock</li>
            <li><span class="glyphicon glyphicon-log-in"></span>log-in</li>
            <li><span class="glyphicon glyphicon-log-out"></span>log-out</li>
            <li><span class="glyphicon glyphicon-magnet"></span>magnet</li>
            <li><span class="glyphicon glyphicon-map-marker"></span>map-marker</li>
            <li><span class="glyphicon glyphicon-minus"></span>minus</li>
            <li><span class="glyphicon glyphicon-minus-sign"></span>minus-sign</li>
            <li><span class="glyphicon glyphicon-move"></span>move</li>
            <li><span class="glyphicon glyphicon-music"></span>music</li>
            <li><span class="glyphicon glyphicon-new-window"></span>new-window</li>
            <li><span class="glyphicon glyphicon-off"></span>off</li>
            <li><span class="glyphicon glyphicon-ok"></span>ok</li>
            <li><span class="glyphicon glyphicon-ok-circle"></span>ok-circle</li>
            <li><span class="glyphicon glyphicon-ok-sign"></span>ok-sign</li>
            <li><span class="glyphicon glyphicon-open"></span>open</li>
            <li><span class="glyphicon glyphicon-paperclip"></span>paperclip</li>
            <li><span class="glyphicon glyphicon-pause"></span>pause</li>
            <li><span class="glyphicon glyphicon-pencil"></span>pencil</li>
            <li><span class="glyphicon glyphicon-phone"></span>phone</li>
            <li><span class="glyphicon glyphicon-phone-alt"></span>phone-alt</li>
            <li><span class="glyphicon glyphicon-picture"></span>picture</li>
            <li><span class="glyphicon glyphicon-plane"></span>plane</li>
            <li><span class="glyphicon glyphicon-play"></span>play</li>
            <li><span class="glyphicon glyphicon-play-circle"></span>play-circle</li>
            <li><span class="glyphicon glyphicon-plus"></span>plus</li>
            <li><span class="glyphicon glyphicon-plus-sign"></span>plus-sign</li>
            <li><span class="glyphicon glyphicon-print"></span>print</li>
            <li><span class="glyphicon glyphicon-pushpin"></span>pushpin</li>
            <li><span class="glyphicon glyphicon-qrcode"></span>qrcode</li>
            <li><span class="glyphicon glyphicon-question-sign"></span>question-sign</li>
            <li><span class="glyphicon glyphicon-random"></span>random</li>
            <li><span class="glyphicon glyphicon-record"></span>record</li>
            <li><span class="glyphicon glyphicon-refresh"></span>refresh</li>
            <li><span class="glyphicon glyphicon-registration-mark"></span>registration-mark</li>
            <li><span class="glyphicon glyphicon-remove"></span>remove</li>
            <li><span class="glyphicon glyphicon-remove-circle"></span>remove-circle</li>
            <li><span class="glyphicon glyphicon-remove-sign"></span>remove-sign</li>
            <li><span class="glyphicon glyphicon-repeat"></span>repeat</li>
            <li><span class="glyphicon glyphicon-resize-full"></span>resize-full</li>
            <li><span class="glyphicon glyphicon-resize-horizontal"></span>resize-horizontal</li>
            <li><span class="glyphicon glyphicon-resize-small"></span>resize-small</li>
            <li><span class="glyphicon glyphicon-resize-vertical"></span>resize-vertical</li>
            <li><span class="glyphicon glyphicon-retweet"></span>retweet</li>
            <li><span class="glyphicon glyphicon-road"></span>road</li>
            <li><span class="glyphicon glyphicon-save"></span>save</li>
            <li><span class="glyphicon glyphicon-saved"></span>saved</li>
            <li><span class="glyphicon glyphicon-screenshot"></span>screenshot</li>
            <li><span class="glyphicon glyphicon-sd-video"></span>sd-video</li>
            <li><span class="glyphicon glyphicon-search"></span>search</li>
            <li><span class="glyphicon glyphicon-send"></span>send</li>
            <li><span class="glyphicon glyphicon-share"></span>share</li>
            <li><span class="glyphicon glyphicon-share-alt"></span>share-alt</li>
            <li><span class="glyphicon glyphicon-shopping-cart"></span>shopping-cart</li>
            <li><span class="glyphicon glyphicon-signal"></span>signal</li>
            <li><span class="glyphicon glyphicon-sort"></span>sort</li>
            <li><span class="glyphicon glyphicon-sort-by-alphabet"></span>sort-by-alphabet</li>
            <li><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>sort-by-alphabet-alt</li>
            <li><span class="glyphicon glyphicon-sort-by-attributes"></span>sort-by-attributes</li>
            <li><span class="glyphicon glyphicon-sort-by-attributes-alt"></span>sort-by-attributes-alt</li>
            <li><span class="glyphicon glyphicon-sort-by-order"></span>sort-by-order</li>
            <li><span class="glyphicon glyphicon-sort-by-order-alt"></span>sort-by-order-alt</li>
            <li><span class="glyphicon glyphicon-sound-5-1"></span>sound-5-1</li>
            <li><span class="glyphicon glyphicon-sound-6-1"></span>sound-6-1</li>
            <li><span class="glyphicon glyphicon-sound-7-1"></span>sound-7-1</li>
            <li><span class="glyphicon glyphicon-sound-dolby"></span>sound-dolby</li>
            <li><span class="glyphicon glyphicon-sound-stereo"></span>sound-stereo</li>
            <li><span class="glyphicon glyphicon-star"></span>star</li>
            <li><span class="glyphicon glyphicon-star-empty"></span>star-empty</li>
            <li><span class="glyphicon glyphicon-stats"></span>stats</li>
            <li><span class="glyphicon glyphicon-step-backward"></span>step-backward</li>
            <li><span class="glyphicon glyphicon-step-forward"></span>step-forward</li>
            <li><span class="glyphicon glyphicon-stop"></span>stop</li>
            <li><span class="glyphicon glyphicon-subtitles"></span>subtitles</li>
            <li><span class="glyphicon glyphicon-tag"></span>tag</li>
            <li><span class="glyphicon glyphicon-tags"></span>tags</li>
            <li><span class="glyphicon glyphicon-tasks"></span>tasks</li>
            <li><span class="glyphicon glyphicon-text-height"></span>text-height</li>
            <li><span class="glyphicon glyphicon-text-width"></span>text-width</li>
            <li><span class="glyphicon glyphicon-th"></span>th</li>
            <li><span class="glyphicon glyphicon-th-large"></span>th-large</li>
            <li><span class="glyphicon glyphicon-th-list"></span>th-list</li>
            <li><span class="glyphicon glyphicon-thumbs-down"></span>thumbs-down</li>
            <li><span class="glyphicon glyphicon-thumbs-up"></span>thumbs-up</li>
            <li><span class="glyphicon glyphicon-time"></span>time</li>
            <li><span class="glyphicon glyphicon-tint"></span>tint</li>
            <li><span class="glyphicon glyphicon-tower"></span>tower</li>
            <li><span class="glyphicon glyphicon-transfer"></span>transfer</li>
            <li><span class="glyphicon glyphicon-trash"></span>trash</li>
            <li><span class="glyphicon glyphicon-tree-conifer"></span>tree-conifer</li>
            <li><span class="glyphicon glyphicon-tree-deciduous"></span>tree-deciduous</li>
            <li><span class="glyphicon glyphicon-unchecked"></span>unchecked</li>
            <li><span class="glyphicon glyphicon-upload"></span>upload</li>
            <li><span class="glyphicon glyphicon-usd"></span>usd</li>
            <li><span class="glyphicon glyphicon-user"></span>user</li>
            <li><span class="glyphicon glyphicon-volume-down"></span>volume-down</li>
            <li><span class="glyphicon glyphicon-volume-off"></span>volume-off</li>
            <li><span class="glyphicon glyphicon-volume-up"></span>volume-up</li>
            <li><span class="glyphicon glyphicon-warning-sign"></span>warning-sign</li>
            <li><span class="glyphicon glyphicon-wrench"></span>wrench</li>
            <li><span class="glyphicon glyphicon-zoom-in"></span>zoom-in</li>
            <li><span class="glyphicon glyphicon-zoom-out"></span>zoom-out</li>
        </ul>
    </div>
</body>

</html>
