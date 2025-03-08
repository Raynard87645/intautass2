INTERNET AUTHORING ASSIGNMENT #2



<!-- server {
  listen        80;
  #listen        [::]:80;
 

  root /var/www/html/;
  index index.html index.htm index.php;

  server_name your-domain.com www.your-domain.com;

  charset utf-8;

  # Start the SSL configurations

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
      try_files $uri $uri/ =404;
      fastcgi_split_path_info ^(.+?\.php)(/.+)?$;
      fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
      fastcgi_index index.php;
      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
      include fastcgi_params;        
    }

    


  
} -->

