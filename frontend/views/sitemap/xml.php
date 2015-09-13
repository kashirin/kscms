<?php

echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


function node($url){
	return '<url>
    <loc>http://myoption.ru/'.trim($url).'</loc>
</url>'."\n";
}

foreach ($articles as $key => $first_level) {
	echo node($first_level['url']);
    if($first_level['children']){
		foreach ($first_level['children'] as $k => $second_level) {
			echo node($second_level['url']);
			if($second_level['articles']){
				foreach ($second_level['articles'] as $item) {
										echo node($item['url']);
									}
			}
		}
    }
}

                			foreach ($pages as $key => $page) {
                				echo node($page['url']);
                			}


echo '</urlset>';
?>