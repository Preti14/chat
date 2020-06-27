FROM preti14/apache
ADD . /var/www/html
CMD ["apachectl", "-D", "FOREGROUND"]
