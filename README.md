# sandokan
sandokan: php youtube-dl web frontend

# CRON: update youtube-dl every day, edit the pip bin path

add this line to `crontab -e`
```
0 0 * * * /root/scripts/youtube_dl_update.sh
```
# APACHE configuration: It can be added separately in each folder a .htaccess file with its corresponding configuration
```
        <Directory "/home/projects/sandokan">
                Options Indexes FollowSymLinks MultiViews

                AllowOverride none
                Order allow,deny
                Allow From all

                Require all granted
        </Directory>
        <Directory "/home/projects/sandokan/downloads">
                Options Indexes FollowSymLinks MultiViews
                IndexIgnore ..

                AllowOverride none
                Order allow,deny
                Allow From all

                Require all granted
        </Directory>
        <Directory "/home/projects/sandokan/libs">
                AllowOverride none
                Order allow,deny
                Deny From all

                Require all granted
        </Directory>
        <Directory "/home/projects/sandokan/tmp">
                AllowOverride none
                Order allow,deny
                Deny From all

                Require all granted
        </Directory>
```
