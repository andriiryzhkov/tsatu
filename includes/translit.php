<?php
/**
 * Generates post and page slugs in latin letters from their titles.
 *
 * Based on UkrToLat plugin by LaSet http://www.laset.info/
 *
 * @package TSATU
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$cyr_lat = array(
    "А" => "A",
    "Б" => "B",
    "В" => "V",
    "Г" => "H",
    "Д" => "D",
    "Е" => "E",
    "Ж" => "ZH",
    "З" => "Z",
    "И" => "Y",
    "Й" => "J",
    "К" => "K",
    "Л" => "L",
    "М" => "M",
    "Н" => "N",
    "О" => "O",
    "П" => "P",
    "Р" => "R",
    "С" => "S",
    "Т" => "T",
    "У" => "U",
    "Ф" => "F",
    "Х" => "H",
    "Ц" => "C",
    "Ч" => "CH",
    "Ш" => "SH",
    "Щ" => "SHH",
    "Ъ" => "'",
    "Ы" => "Y",
    "Ь" => "",
    "Э" => "EH",
    "Ю" => "JU",
    "Я" => "JA",
    "а" => "a",
    "б" => "b",
    "в" => "v",
    "г" => "h",
    "д" => "d",
    "е" => "e",
    "ж" => "zh",
    "з" => "z",
    "и" => "y",
    "й" => "j",
    "к" => "k",
    "л" => "l",
    "м" => "m",
    "н" => "n",
    "о" => "o",
    "п" => "p",
    "р" => "r",
    "с" => "s",
    "т" => "t",
    "у" => "u",
    "ф" => "f",
    "х" => "h",
    "ц" => "c",
    "ч" => "ch",
    "ш" => "sh",
    "щ" => "sch",
    "ъ" => "",
    "ы" => "y",
    "ь" => "",
    "э" => "eh",
    "ю" => "ju",
    "я" => "ja",
    "ї" => "ji",
    "“" => "",
    "”" => "",
    "«" => "",
    "»" => "",
    "„" => "",
    "‘" => "",
    "’" => "",
    "`" => "",
    "´" => "",
    "Ґ" => "G",
    "Ё" => "JO",
    "Є" => "JE",
    "Ы" => "Y",
    "І" => "I",
    "і" => "i",
    "ґ" => "g",
    "ё" => "jo",
    "№" => "#",
    "є" => "je",
    "ы" => "y"
);

function tsatu_title_translit($title) {
    global $cyr_lat;
    return strtr($title, $cyr_lat);
}

add_action('sanitize_title', 'tsatu_title_translit', 0);
