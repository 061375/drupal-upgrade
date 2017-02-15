<?php
namespace Libraries;
/**
 *  
 *  General
 *  
 *  
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class General
{
    /**
     * check if an array key is set and if FALSE can set an error
     * @param array
     * @param string
     * @param string
     * @param boolean
     * @return mixed
     * */
    public static function is_set($array,$key,$default='',$er = false){
        $return = isset($array[$key]) ? $array[$key] : $default;
	if(false !== $er) {
	    if($return == $default) {
		global $er;
		$er = $default;
	    }
	}
	return $return;
    }
    /**
     * if the backup directory doesn'y exists this tries to dreate it
     * @param string $backfolder
     * @return bool
     *  */
    public static function _mkdir($backfolder)
    {
	if(false === is_dir($backfolder)) {
	    if(false === @mkdir($backfolder))
		die("\nunable to create backup directory\n");
	}
	return true;
    }
}