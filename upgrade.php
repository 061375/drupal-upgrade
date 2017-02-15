<?php
/**
 *
 * Drupal Upgrade Utility
 *
 * This utility will automate the Drupal upgrade process including backing up your previous version
 *
 * @author Jeremy Heminger <j.heminger13@gmail.com>
 *
 * 
 * */
$dir = str_replace('upgrade.php','',__FILE__);

// include Symfony components as necessary
include_once('vendor/autoload.php');
use Symfony\Component\Yaml\Yaml;


$app = Yaml::parse(file_get_contents($dir.'config/app.yml'));
$app['backfolder'] = isset($app['backfolder']) ? $app['backfolder'] : './drupal-bk';

// autoload classes 
$Directory = new RecursiveDirectoryIterator($dir.'src');
$Iterator = new RecursiveIteratorIterator($Directory);
$objects = new RegexIterator($Iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach($objects as $name => $object){
    require_once($name);
}
use \Libraries\CMD;
CMD::runall(
    array(
        array(
            'name'=>'backup_database',
            'flag'=>'d',
            'vars'=>array(
                '--host=',
                '--dbn=',
                '--user=',
                '--pass=',
                '--ver='
            )
        ),
        array(
            'name'=>'backup_files',
            'flag'=>'f',
            'vars'=>array(
                '--ver='
            )
        ),
        array(
            'name'=>'upgrade',
            'flag'=>'u',
            'vars'=>array(
                '--ver='
            )
        )
    ),'web access not allowed');

function backup_files() {
    global $app;
    \Controller\Backup::files($app['backfolder'],isset($app['exclude']) ? $app['exclude'] : array()); 
}
function backup_database($params) {
    global $app;
    \Controller\Backup::database($params,$app['backfolder']);
}
function upgrade($params) {
    global $app;
    \Controller\Upgrade::download($app['backfolder'],$params);
    \Controller\Upgrade::install($app['backfolder'],$params); 
}