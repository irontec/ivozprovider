# Configuración Apache2

        Alias /oasis /home/youUser/workspace/ivozprovider/portals/public
        <Directory /home/youUser/workspace/ivozprovider/portals/public>
                Options -Indexes +FollowSymLinks -MultiViews
                AllowOverride None
                 <Limit GET HEAD POST PUT DELETE OPTIONS PATCH>
                    Order allow,deny
                    Allow from all
                    Require all granted
                    Satisfy Any
                </Limit>
                #SetEnv APPLICATION_ENV localdev

                RewriteEngine On
                RewriteBase /oasis

                # The following rule tells Apache that if the requested filename
                # exists, simply serve it.
                RewriteCond %{REQUEST_FILENAME} -s [OR]
                RewriteCond %{REQUEST_FILENAME} -l [OR]
                RewriteCond %{REQUEST_FILENAME} -d
                RewriteRule ^.*$ - [NC,L]
                # The following rewrites all other queries to index.php. The
                # condition ensures that if you are using Apache aliases to do
                # mass virtual hosting, the base path will be prepended to
                # allow proper resolution of the index.php file; it will work
                # in non-aliased environments as well, providing a safe, one-size
                # fits all solution.
                RewriteCond %{REQUEST_URI}::$1 ^(/.+)(.+)::^B$
                RewriteRule ^(.*)$ - [E=BASE:%1]
                RewriteRule ^(.*)$ %{ENV:BASE}index.php [NC,L]



                #Header set Access-Control-Allow-Origin "*"
                Header set Access-Control-Allow-Methods "GET, PUT, POST, OPTIONS, DELETE"
                Header set Access-Control-Allow-Credentials "true"
                Header set Access-Control-Allow-Headers "Authorization, Origin, Content-Type, X-CSRF-Token, page, Request-Date"
                Header set Access-Control-Expose-Headers "totalItems, range"


        </Directory>


## Instalar gearman y igbinary

Cómo instalar igbinary
http://www.metod.si/how-to-install-igbinary-serializer-for-php/