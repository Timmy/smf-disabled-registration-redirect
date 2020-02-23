FROM php:alpine

ADD https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar /tmp

COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]

CMD [ "--help" ]
