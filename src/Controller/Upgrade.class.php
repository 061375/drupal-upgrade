<?php
namespace Controller;
/**
 *
 *
 *
 * */
use \Libraries\General;
class Upgrade {
    /**
     *  downloads the requested version of Drupal into the specified backup folder
     *  @param string backup folder
     *  @param array 
     *  @return void
     *  */
    public static function download($backfolder,$params)
    {
        $er = false;
        
        $ver = General::is_set($params,'ver',false,true);
        
        if(false !== $er)die("\nplease provide a version to upgrade to\n");
        
        $r = getcwd();
        
        chdir($backfolder);
        
        echo "\ndownloading requested version of Drupal form repository\n";
        echo shell_exec('wget https://ftp.drupal.org/files/projects/drupal-'.$ver.'.zip');
        
        echo "\nextracting Drupal into temp directory\n";
        echo shell_exec('unzip drupal-'.$ver.'.zip');

        chdir($r);
    }
    /**
     *  copies Drupal from temp directory and overwrites any existing files
     *  @param string backup folder
     *  @param array 
     *  @return void
     *  */
    public static function install($backfolder,$params)
    {
        $ver = General::is_set($params,'ver',false,true);
        
        if(false !== $er)die("\nplease provide a version to upgrade to\n");
        
        echo "\ncopying Drupal core upgrade to website directory\n";
        echo shell_exec('cp -rf drupal-'.$ver.'/* '.$r);
        
    }
}