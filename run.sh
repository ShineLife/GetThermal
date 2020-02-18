#!/bin/bash
cp -a html/NewTaipei /var/www/html
systemctl restart apache2
