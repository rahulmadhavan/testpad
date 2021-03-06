<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/lib/simple_html_dom.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/generators/ImageGeneratorInterface.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/Image.php';

	class FFFFoundImageGenerator implements ImageGeneratorInterface{
 
		const SOURCE_NAME = 'ffffound';
		const SOURCE_ROOT = 'http://ffffound.com/';
		
		public function generateImages($arguments = null){
			
		    $context = stream_context_create($arguments["options"]);

		    $html = file_get_html('http://ffffound.com/?offset=200',false,$context);
			$images= array();

		    foreach($html->find('blockquote') as $bq)
		    {
		         foreach($bq->find('img') as $image){
			
					$anchor_url = $image->parent->href;
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
	// $big = new FFFFoundImageGenerator();
	// $images = $big->generateImages(array("options" => $options, "searchterm" => $_GET["search"]));
	// echo "".Image::getHtmlForImages($images);

?>