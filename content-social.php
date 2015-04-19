<?php
/**
 * The template part for displaying social buttons.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

?>

<div class="social-likes" data-url="<?php echo get_permalink(); ?>" data-title="<?php the_title(); ?>">
    <div class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</div>
    <div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div>
    <div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
    <div class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</div>
    <div class="pinterest" title="Поделиться картинкой на Пинтересте" data-media="">Pinterest</div>
</div>
