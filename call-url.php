<?php
	function callURL() {
		//inicial
		$url = $_POST['link'];
		$html = file_get_contents($url);
		$doc = new DOMDocument();
		@$doc->loadHTML($html);
		$nodes = $doc->getElementsByTagName('title');
		$links = $doc->getElementsByTagName('a');

		$title = $nodes->item(0)->nodeValue;
		
		$external = 0;
		$internal = 0;
		//execução for atravez de "host" e "#" detecta internal
		$parse = parse_url($url);
		$host = $parse['host'];
		foreach ($links as $link){
			$href = $link->getAttribute('href');
			if($href!=null && $href!=''){
				
				if($href=='#' || substr($href, 0, 1) == '/') {
					$internal++;
				} else {
					$parseLink = parse_url($href);
					if (array_key_exists('host',$parseLink)) {
						$hostLink = $parseLink['host'];
						if($hostLink!=null && $hostLink == $host) {
							$internal++;
						} else {
							$external++;
						}
					}	
				}
			}
		}
		
		$response = json_encode(array('title' => $title, 'external' => $external, 'internal' => $internal));
		echo $response;
	}
	
	callURL();
?>
