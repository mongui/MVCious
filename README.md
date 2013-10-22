MVCious
=======

MVCious is a light weight MVC (Model View Controller) framework for PHP >= 5.3.0.

The usage of this package in connection with PHP's object-oriented features allows you to build scalable, reusable and expressive Web applications.

## Installation ##
1. Download download it directly from github and uncompress it in your WWW directory or inside of one of its directories.
2. Edit the /config.php and change any settings in it according to your needs.
3. If you have an Apache server installed and you want to use this framework in a different directory than /MVCious/, it's necessary to edit the next line from the .htaccess file:

   ```
   # MVCious route:
   RewriteRule ^(.*)$ /MVCious/index.php?/$1 [L]
   ```
   To:
   ```
   # MVCious route:
   RewriteRule ^(.*)$ /YourDirectory/index.php?/$1 [L]
   ```
   If you want to use a HipHopVM (Facebook), use the included hhvm.hdf file to configure the server.

## License ##
Code is open-sourced software licensed under Apache 2.0 License.