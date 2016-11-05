 
Add this in htaccess file

<IfModule mod_rewrite.c>
  RewriteEngine On
  #RewriteBase /

  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^ index.php [QSA,L]
</IfModule>

Step 2 :

Remove index.php in codeigniter config

$config['base_url'] = ''; 
$config['index_page'] = '';

Step 3 :

Allow overriding htaccess in Apache Configuration (Command)

sudo nano /etc/apache2/apache2.conf

and edit the file & change to

AllowOverride All

for www folder

Step 4 :

Enabled apache mod rewrite (Command)

sudo a2enmod rewrite

Step 5 :

Restart Apache (Command)

sudo /etc/init.d/apache2 restart




Na wedosu se musi pridat do htaccess jeste ?

RewriteRule ^(.*)$ index.php?/$1 [L]