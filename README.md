# drupal-upgrade
Script to backup then upgrade drupal from the command-line

It's true that Drush can upgrade Drupal 8, but I don't think it can back it up first.

Plus, this doesn't require Drush.

I would still use with caution. I wrote this on my environment for my own purposes.

You are free to use it AS IS or modify it and I take no responsability if it breaks your website.

The script:

1. backups up the database

2. backups up the website 

3. downloads the core files

4. replaces the core files

## TODO

```--pass=``` is an insecure way to add the password as it will appear in the .bash_history

## Usage

### Config

config/app.yml

* optional - set a backup folder path

backfolder: /path/to/my/backup

### Run Program

``` cd /path/to/my/drupal/project ```

``` php /path/to/drupal-upgrade/upgrade.php -dfu --host=localhost --dbn=drp_uptest --user=drp_uptest --pass=abc1234 --ver=8.2.6 ```

### Bash Function Example (to make things easier )

```
function upfunc()
{
  cd /var/www/vhosts/mywebsite
  php /path/to/scripts/drupal-upgrade/upgrade.php $1 --host=localhost --dbn=drp_uptest --user=drp_uptest --pass=abc1234 --ver=$2
}
```

Example:

``` # upfunc -dfu 8.1.2 ```

### Flags

-d  backs up database
    
    --host=[ host ]
    
    --dbn= [ database name ]
   
    --user=[ database user ]
    
    --pass=[ database password ]

-f  backs up drupal core files

-u  downloads and upgrades based on the version requested
    
    --ver=[ 8.x.x ]
    

