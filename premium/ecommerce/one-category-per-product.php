<?php 
/*
If a product has multiple categories selected, by default MC4WP sends in all those categories, separated by the | symbol.
That works well for segments, as you can segment based on "vendor contains ..."

However, for the new Ecommerce Product Follow-up by Category you probabaly want to send in only 1 category per product. 
This code snippet will let you create a list of categories ordered by priorituy. Only the first match will be send to MailChimp.
If no match is found, the first alphabetical category will be send in for that product. 

Replace Test1, Test2, Test3 with the categories you want to send in, higest priority on top. 
You can keep adding to that list.
*/

add_filter( 'mc4wp_ecommerce_product_data', function( $data, $product ) {
	$priority_categories = array(
		'Test1',
		'Test2',
		'Test3'
	);
	$single_category = array();
	$categories = explode('|', $data['vendor']);
	$single_category = array_intersect($categories, $priority_categories);
	if(count($single_category) < 1) $single_category[0] = $categories[0];
	$data['vendor'] = current($single_category);
	return $data;
}, 10, 2); 
