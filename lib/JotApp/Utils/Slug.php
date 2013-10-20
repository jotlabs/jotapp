<?php

namespace JotApp\Utils;

class Slug {
    
    public static function slugify($text) {
        $text = strtolower($text);
		$slug = preg_replace('/[^a-z0-9]+/', '-', $text);
		$slug = trim($slug, '-');
		return $slug;	
    }    
    
}

?>
