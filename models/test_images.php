<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/models/aggregators/impl/SimpleImageAggregator.php';

	$options = array(
  			'http'=>array(
    			'method'=>"GET",
    			'header'=> 'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko)                        		Chrome/31.0.1650.63 Safari/537.36' 
  				)
			);

	$images = SimpleImageAggregator::getInstance()->fetchImages(array("options" => $options, "searchterm" => $_GET["search"]));
//	echo "".sizeof($images);
	echo "".Image::getHtmlForImages($images);

?>