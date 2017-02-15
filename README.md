# drupal-upgrade
Script to backup then upgrade drupal from the command-line

NOTE: This is still in production. I have only tested the backup so far.

Its true that Drush can upgrade Drupal 8, but I don;t think it can back it up first.

This script:

1. backups up the database

2. backups up the website (allowing for folders to be igonored)

3. downloads the core files

4. replaces the core files

