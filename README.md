# THOT Website — v2 / 2018-2021

Based on Symfony 5 + Webpack

#### To install dependencies

    composer install

#### To build production assets

    npm install
    npm run build

#### To run a dev server

    php -S localhost:8000 -t public

## Translations

To extract translations from templates :

    bin/console translation:update --output-format xlf --xliff-version=2.0 fr --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 en --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 fa --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 ps --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 ar --force

