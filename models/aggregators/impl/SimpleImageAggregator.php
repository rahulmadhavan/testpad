<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/models/aggregators/ImageAggregatorInterface.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/generators/impl/BehanceImageGenerator.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/generators/impl/DesignYouTrustImageGenerator.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/generators/impl/FubizImageGenerator.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/generators/impl/MatboardImageGenerator.php';	

	class SimpleImageAggregator implements ImageAggregatorInterface{
		
	    public $_generators;
		private static $image_generators = array("BehanceImageGenerator","DesignYouTrustImageGenerator","FubizImageGenerator","MatboardImageGenerator");											   																																				 			
		private static $instance;

		
		
		protected function __construct(){
			$this->_generators = array();
			foreach(static::$image_generators as $generator){
				array_push($this->_generators,new $generator);
			}
		}
		
		
		public static function getInstance(){
	      if (static::$instance === null){
	         static::$instance = new SimpleImageAggregator();
	      }
	      return static::$instance;
	  	}
		
		public function fetchImages($arguments = null){
			$images = array();
			foreach($this->_generators as $generator){
				$count = 0;
				foreach($generator->generateImages($arguments) as $image){
					if($count >= 4){
						break;
					}
					array_push($images,$image);
					$count++;
				}								
			}
			return $images;
		}
					
	}


?>