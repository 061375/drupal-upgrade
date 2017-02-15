<?php
namespace Controller;
/**
 *
 *
 *
 * */
use \Libraries\General;
class Backup {
    /**
     *  backup database
     *  @param array database connection string
     *      host    
     *      user
     *      pass
     *      dbn
     *  @param string directory to put the database
     *  @return void
     *  */
    public static function database($params,$backfolder)
    {
        General::_mkdir($backfolder);

        $er = false;
        
        $user = General::is_set($params,'user',false,true);
        $host = General::is_set($params,'host',false,true);
        $pass = General::is_set($params,'pass',false,true);
        $dbn = General::is_set($params,'dbn',false,true);
        
        if(false !== $er)die("\none or more database connection fields are missing\n");
        
        echo "\npurging previous backup of database...\n";
        @unlink($backfolder.'/'.$dbn.'.sql');
        
        echo "\nbacking up database...\n";
        $cmd = 'mysqldump -u '.$user.' -p'.$pass.' -h '.$host.' '.$dbn.' > '.$backfolder.'/'.$dbn.'.sql';
        echo shell_exec($cmd);
    }
    /**
     * files
     * @param string $backfolder
     * @param array
     * @return void
     * */
    public static function files($backfolder,$exclude = array())
    {
        General::_mkdir($backfolder);
        
        echo "\npurging previous backup...\n";
        @unlink($backfolder.'/drupal-backup.zip');
        
        $first = false;
        
        $exclude[] = '..';
        $exclude[] = '.';
        $files = array_diff(scandir(getcwd()), $exclude);
        foreach($files as $file) {
            $flag = (false === $first ? '-r' : '-ur');
            echo shell_exec('zip '.$flag.' '.$backfolder.'/drupal-backup.zip '.$file);
            $first = true;
        }
    }
}