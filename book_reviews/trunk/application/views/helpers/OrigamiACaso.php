<?php

class Zend_View_Helper_OrigamiACaso extends Zend_View_Helper_Abstract 
{
    protected $_imgPath = null;
 
    /**
     * Restituisce il tag <img />
     * di unm'immagine nella cartella
     * 'origami_a_caso'
     *
     * @return string
     */
    public function origamiACaso()
    {
    	$dir = 'images/origami/';
    	$files = array();

		// Open a known directory, and proceed to read its contents
		if (is_dir($dir)) {
    		if ($dh = opendir($dir)) {
        		while (($file = readdir($dh)) !== false) {
        			if ($file != "." && $file != ".." && $file != ".svn" && $file != "mc_access") {
        				$files[] = $file;
      				}
        		}
        		closedir($dh);
    		}
    		
    		$random = array_rand($files);
    		
    		return '<img src="/' . $dir . $files[$random] .
                   '" alt="L\'ho fatto io!" title="L\'ho fatto io!" />';
		} else {
			return false;
		}
    }
}