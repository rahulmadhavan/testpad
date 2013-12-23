<?php

class Image{
    public $_sourceName;
    public $_sourceRoot;
    public $_sourceImageUrl;
	public $_sourceImageAlt;
    public $_sourceAnchorUrl;
    
	const IMAGE_HTML_TEMPLATE  = "<img src='%s' alt='%s'>";
	const ANCHOR_HTML_TEMPLATE = "<a href='%s'>%s</a>";

	function __construct($sourceName,$sourceRoot,$sourceImageUrl,$sourceImageAlt,$sourceAnchorUrl,$options = null) {
	    $this->_sourceName = $sourceName ;
	    $this->_sourceRoot = $sourceRoot;
	    $this->_sourceImageUrl = $sourceImageUrl;
		$this->_sourceImageAlt = $sourceImageAlt;
	    $this->_sourceAnchorUrl = $sourceAnchorUrl;
   	}
	
	function getHtml(){ 
		$image_html = sprintf(self::IMAGE_HTML_TEMPLATE,$this->_sourceImageUrl,$this->_sourceImageAlt);
		$anchor_html = sprintf(self::ANCHOR_HTML_TEMPLATE,$this->_sourceAnchorUrl,$image_html);
		return $anchor_html;		
	}
	
	public static function getHtmlForImages($images){
		$image_html = "";
		foreach($images as $image){
			$image_html = $image_html.$image->getHtml(); 
		}
		return $image_html;
	} 
	
}

?>