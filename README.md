# THOT Website — v2 / 2018-2019

Based on Symfony 4 + Webpack

#### To install dependencies

    composer install

#### To build production assets

    npm install
    npm run build

#### To run a dev server

    php -S localhost:8000 -t public

## Translations

To extract translations from templates :

    bin/console translation:update --no-backup --output-format xlf fr --force
    bin/console translation:update --no-backup --output-format xlf en --force
    bin/console translation:update --no-backup --output-format xlf fa --force
    bin/console translation:update --no-backup --output-format xlf ps --force
    bin/console translation:update --no-backup --output-format xlf ar --force
