<?php
/**
 * Google Map shortcode
 * 
 * @package tsatu
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function shortcode_map($params, $content = null) {
    extract(shortcode_atts(array(
        'title' => false,
        'address' => false,
        'lat' => false,
        'lng' => false,
        'zoom' => '17',
        'height' => '350px',
        'width' => '100%',
        'marker' => 0,
        'infowindow' => false,
                    ), $params));
    $content = preg_replace('/<br class="nc".\/>/', '', $content);

    //wp_enqueue_script('googlemaps-api', '//maps.google.com/maps/api/js?sensor=false', array(), null, false);

    if ($address) {
        $coordinates = tsatu_gmaps_decode_address($address);
        if (is_array($coordinates)) {
            $lat = $coordinates['lat'];
            $lng = $coordinates['lng'];
        }
    }

    if (!$title) {
        if ($address) {
            $title = $address;
        } else {
            $title = $lat . ', ' . $lng;
        }
    }

    $map_id = uniqid('maps_');

    // show marker or not
    $marker = (int) $marker ? true : false;

    ob_start();
    ?>
    <div id="<?php echo esc_attr($map_id); ?>" style="height: <?php echo esc_attr($height); ?>; width: <?php echo esc_attr($width); ?>"></div>
    <script type="text/javascript">
        function initialize() {
            var myLatlng = new google.maps.LatLng(<?php echo esc_attr($lat); ?>, <?php echo esc_attr($lng); ?>);
            var myOptions = {
                zoom: <?php echo esc_attr($zoom); ?>,
                center: myLatlng,
                panControl: false,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("<?php echo esc_attr($map_id); ?>"), myOptions);

    <?php if ($marker) : ?>
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: '<?php echo esc_attr($title); ?>'
                });

        <?php if ($content) : ?>
                    var contentString = '<div id="content"><h4><?php echo esc_attr($title); ?></h4><?php echo esc_attr($content); ?></div>';
                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
        <?php endif; ?>
    <?php endif; ?>

        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('map', 'shortcode_map');

/**
 * Retrieve coordinates for an address
 *
 * Coordinates are cached using transients and a hash of the address
 *
 * @since       1.1
 * @return      $array of latitude and longitude
 */
function tsatu_gmaps_decode_address($address) {
    $address_hash = md5($address);

    $coordinates = get_transient($address_hash);

    if (false === $coordinates) {
        $args = array('address' => urlencode($address));
        $url = add_query_arg($args, 'http://maps.googleapis.com/maps/api/geocode/json');
        $response = wp_remote_get($url);

        if (is_wp_error($response))
            return;

        if ($response['response']['code'] == 200) {
            $data = wp_remote_retrieve_body($response);

            if (is_wp_error($data))
                return;

            $data = json_decode($data);

            if ($data->status === 'OK') {
                $coordinates = $data->results[0]->geometry->location;

                $cache_value['lat'] = $coordinates->lat;
                $cache_value['lng'] = $coordinates->lng;

                // cache coordinates for 1 month
                set_transient($address_hash, $cache_value, 3600 * 24 * 30);
                $coordinates = $cache_value;
            } elseif ($data->status === 'ZERO_RESULTS') {
                return __('No location found for the entered address.', 'wp-gmaps');
            } elseif ($data->status === 'INVALID_REQUEST') {
                return __('Invalid request. Address is missing', 'wp-gmaps');
            } else {
                return __('Something went wrong while retrieving your map.', 'wp-gmaps');
            }
        } else {
            return __('Unable to contact Google API service.', 'wp-gmaps');
        }
    }

    return $coordinates;
}
