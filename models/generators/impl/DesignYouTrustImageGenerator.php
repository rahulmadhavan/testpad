<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/lib/simple_html_dom.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/generators/ImageGeneratorInterface.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/Image.php';

	class DesignYouTrustImageGenerator implements ImageGeneratorInterface{
 
		const SOURCE_NAME = 'Designyoutrust';
		const SOURCE_ROOT = 'http://www.designyoutrust.com/';
		
		public function generateImages($arguments = null){
			
		    $context = stream_context_create($arguments["options"]);
			$search_url = "http://designyoutrust.com/?s=".$arguments["searchterm"];
		    $html = file_get_html($search_url,false,$context);
			$images= array();

		    foreach($html->find('div[class=mainpost]') as $mp)
		    {
		         foreach($mp->find('img') as $image){
			
					$anchor_id = $mp->parent->id;
					$anchor_url = $search_url."#".$anchor_id;					
		            $image_url = $image->src;
					$alt = $image->alt;
					$image = new Image(self::SOURCE_NAME,self::SOURCE_ROOT,$image_url,$alt,$anchor_url);

					//echo "".$anchor_url." ".$image_url." ".$alt."\n";
					
					array_push($images,$image);															
		
		         }
		
		    }
				    			
			return $images;	
		}						
		
	}

	// $options = array(
	//       'http'=>array(
	//         'method'=>"GET",
	//         'header'=> 'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko)                        Chrome/31.0.1650.63 Safari/537.36' 
	//       )
	//     );
	// 
	// $big = new DesignYouTrustImageGenerator();
	// $images = $big->generateImages(array("options" => $options, "searchterm" => $_GET["search"]));
	// echo "".Image::getHtmlForImages($images);

?>