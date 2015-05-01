/**
 * Created by Andrii on 01.05.2015.
 */
$('.social-likes').on('ready.social-likes', function(event, number) {
    // Request new counters
    $(event.currentTarget).socialLikes({forceUpdate: true});
});

$('.social-likes').on('popup_closed.social-likes', function(event, service) {
    // Request new counters
    $(event.currentTarget).socialLikes({forceUpdate: true});
});