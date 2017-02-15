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
        $cmd = 'wget https://ftp.drupal.org/files/projects/drupal-'.$ver.'.zip';
        echo shell_exec($cmd);
        
        echo "\nextracting Drupal into temp directory\n";
        $cmd = 'unzip drupal-'.$ver.'.zip';
        echo shell_exec($cmd);

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
        $er = false;
        $ver = General::is_set($params,'ver',false,true);
        
        if(false !== $er)die("\nplease provide a version to upgrade to\n");
        
        $r = getcwd();
        
        chdir($backfolder);
        
        echo "\ncopying Drupal core upgrade to website directory\n";
        
        $cmd = 'cp -rf drupal-'.$ver.'/* '.$r;
        echo shell_exec($cmd);
        
    }
}