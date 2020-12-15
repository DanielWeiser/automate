docker exec -it php-fpm composer install
sudo chown -R daniel:daniel logs/
sudo chmod -R 777 logs/
sudo chown -R daniel:daniel symfony/var/
sudo chmod -R 777 symfony/var/