<?php

// Misc functions used by the theme.

/**
 * @param $variation_attributes
 * @return array[]
 */
function format_variation_attributes(array $variation_attributes): array
{
    $colors = [];
    $sizes  = [];
    foreach( $variation_attributes as $attribute_name => $attribute_values) {
        foreach($attribute_values as $attribute_key => $attribute_string) {
            // Store initial value
            $data = [
                'key'      => $attribute_key,
                'value'    => $attribute_string,
            ];
            // Strip until first "-"
            $attribute_array = explode('-', $attribute_string);
            $part_one = array_shift($attribute_array);
            $part_one = mb_strtoupper(substr($part_one, 0, strlen($part_one)));
            $data['part_one'] = $part_one;

            if ($attribute_name === 'pa_color') {
                $data['part_two'] = format_color_variations($attribute_array);
                $colors[] = $data;
            }

            if ($attribute_name === 'pa_size') {
                $data['part_two'] = format_size_variations($attribute_array);
                $sizes[] = $data;
            }
        }
    }

    return [
        'colors' => $colors,
        'sizes'  => $sizes,
    ];
}

/**
 * @var array $attribute_array
 * @return string
 */
function format_color_variations(array $attribute_array): string
{
    $attribute_array = array_map(function ($item) {
        return mb_convert_case($item, MB_CASE_TITLE);
    }, $attribute_array);

    return implode(' ', $attribute_array);
}

/**
 * @param array $attribute_array
 * @return string
 */
function format_size_variations(array $attribute_array): string
{
    /* Two possibilities: [12, x, 5] or [12x5] */

    // Convert all to lowercase
    $attribute_array = array_map(function($item) {
        return mb_strtolower($item);
    }, $attribute_array);

    // Convert all cases to a 2-sized array
    if (count($attribute_array) === 1) {
        $attribute_array = explode("x", $attribute_array[0]);
    } else {
        unset($attribute_array[1]);
    }

    // Implode array
    return implode(' x ', $attribute_array);
}

/**
 * @param array $available_variations
 * @return array
 */
function subset_variations_prices(array $available_variations)
{
    $variations = [];
    foreach ($available_variations as $index => $data) {
        $variations[] = [
            'variation_id' => $data['variation_id'],
            //'color'        => $data['attributes']['attribute_pa_color'], //only enable when color changes price
            'size'         => $data['attributes']['attribute_pa_size'],
            'price'        => $data['display_price'],
        ];
    }
    return $variations;
}

/**
 * @param array $assocArray
 * @return string
 */
function array_to_jsondata (array $assocArray) {
    $json    = wp_json_encode( $assocArray );
    $encoded = function_exists( 'wc_esc_json' ) ?
        wc_esc_json($json) :
        _wp_specialchars($json, ENT_QUOTES, 'UTF-8', true );

    return $encoded;
}

function sort_sizes_by_area($sizes)
{
    // Area is just part_one, the multiplication of AxB lol.
    $ret_sizes = $sizes;
    usort($ret_sizes, function(array $a, array $b) {

        /*
        // Take "part_two", which contains "A x B", and extract the numbers
        $a_parts = explode("x", $a['part_two']);
        $b_parts = explode("x", $b['part_two']);
        $a_area = (int)$a_parts[0] * (int)$a_parts[1];
        $b_area = (int)$b_parts[0] * (int)$b_parts[1];
        */

        // Previous code is unnecessary, as area is part_one already.
        $a_area = (int)$a['part_one'];
        $b_area = (int)$b['part_one'];

        if ($a_area === $b_area) {
            return 0;
        }
        return ($a_area < $b_area) ? -1 : 1;

    });

    return $ret_sizes;
}