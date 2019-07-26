<?php

namespace Deployer;

require 'recipe/symfony4.php';

set('ssh_type', 'native');
set('ssh_multiplexing', true);

// Configuration
inventory('deploy/servers.yml');

set('env', function () {
    return [
        'APP_ENV' => 'prod',
        'GA_TRACKING_ID' => '0',
        'DATABASE_URL' => 'null',
        'MAILER_URL' => 'null',
    ];
});

set('http_user', 'www-data');
set('default_stage', 'production');
set('repository', 'git@github.com:ecole-thot/website.git');

set('shared_dirs', ['var/log', 'var/sessions', 'public/uploads']);
set('writable_dirs', ['var', 'public/uploads']);

set('clear_paths', [
  './README.md',
  './.gitignore',
  './.git',
  './deploy',
  './.php_cs',
  './deploy.php',
  './.env*',
]);
//set('writable_mode', "chmod");

desc('Build bundle assets');
task('deploy:build_assets', function () {
    cd('{{release_path}}');
    run('npm install --no-optional --no-progress');
    run('npm run build');
});

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php7.1-fpm.service');
});

desc('Correct translations folder rights');
task('folder:rights', function () {
    cd('{{deploy_path}}/current');
    run('sudo chgrp -R www-data .');
    run('sudo chmod -R g+w ./translations');
});

// Hooks
after('deploy:update_code', 'deploy:build_assets');
after('deploy:symlink', 'folder:rights');
after('deploy:symlink', 'php-fpm:restart');
after('deploy:failed', 'deploy:unlock');

