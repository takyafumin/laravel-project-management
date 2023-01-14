#!/bin/bash
#
# run.shコマンドを短いコマンドで使う方法
# Bashエイリアスに以下を設定(~/.bashrcなどに設定)
#
#   alias r='[ -f run.sh ] && bash run.sh'
#

DIR_PROJECT=apps/project-management                         # Laravel Project Project
APP_CONTAINER=app                                           # Laravel PHP Container Name
APP_IMAGE=laravel-project-management/app                    # Laravel PHP Container Image Name
APP_USER=sail                                               # Laravel Container exec user
MYSQL_CONTAINER=db                                          # Mysql Container Name
DOCKER_VOLUME_VENDOR=project-management_laravel9-php-vendor # docker volume for composer
DOCKER_VOLUME_NODE_MODULES=project-management-node-modules  # docker volume for node modules


OSTYPE="$(uname -s)"
case "${OSTYPE}" in
    Linux*)         MACHINE=linux;;
    Darwin*)        MACHINE=mac;;
    MINGW64_NT*)    MACHINE=win;;
    *)              MACHINE="UNKNOWN"
esac

if [ "$MACHINE" == "UNKNOWN" ]; then
    echo "Unsupported operating system [$(uname -s)]. use Linux / Mac / Windows(git bash) / Windows(WSL2)" >&2
    exit 1
fi

PATH_PREFIX=
CMD_DOCKER="docker-compose -f docker-compose.yml"
if [ "$MACHINE" == "win" ]; then
    PATH_PREFIX=/
elif [ "$MACHINE" == "mac" ]; then
    CMD_DOCKER="docker-compose -f docker-compose.yml -f docker-compose.m1mac.yml"
fi


#------------------
# help表示
#------------------
function display_help {
    echo "Usage:" >&2
    echo "" >&2
    echo "  command [arguments]" >&2
    echo "" >&2
    echo "  if undefined [command] specified, transfer to 'docker-compose' command." >&2
    echo "" >&2
    echo "" >&2
    echo "Commands:" >&2
    echo "" >&2
    echo "  [Environment]" >&2
    echo "    init                  Remove the compiled class file" >&2
    echo "    migrate               Exec artisan migrate" >&2
    echo "    seed                  Exec artisan db:seed" >&2
    echo "    refresh-db            Exec artisan migrate:refresh --seed" >&2
    echo "    destroy               Exec docker compose down(remove volumes)" >&2
    echo "    destroy-all           Exec docker compose down(remove all resources)" >&2
    echo "    cp2local              Copy Container to local [vendor/*, node_modules/*]" >&2
    echo "    clean-local           Cleanup local resources(exec git clean -nx & remove [vendor/*, node_modules/*])" >&2
    echo "" >&2
    echo "  [for Development]" >&2
    echo "    up                    Exec docker compose up(background)" >&2
    echo "    down                  Exec docker compose down" >&2
    echo "    ps                    Exec docker compose ps" >&2
    echo "    artisan [command]     Exec artisan command" >&2
    echo "    tinker                Exec artisan tinker" >&2
    echo "    bash                  Exec bash in php container" >&2
    echo "    mysql                 Exec mysql cli in mysql container" >&2
    echo "    composer [command]    Exec composer command" >&2
    echo "    npm [command]         Exec npm command" >&2
    echo "    ide-helper            Generate Laravel IDE Helper File" >&2
    echo "" >&2
    echo "  [Test & CI]" >&2
    echo "    ci                    Exec CI" >&2
    echo "    phpcs                 Code Format Check: php" >&2
    echo "    fix                   Code Format Fix: php" >&2
    echo "    phpmd                 Coding Check: phpmd" >&2
    echo "    larastan              Coding Check: phpstan" >&2
    echo "    test                  Run phpunit" >&2
    echo "    test-coverage         Run phpunit(Coverage)" >&2
    echo "" >&2
    echo "  [other]" >&2
    echo "    help                  Show help" >&2
    echo "" >&2
    echo "" >&2
    exit 0;
}

#------------------
# copy to local
#------------------
function copy_to_local {
    docker run --rm -it -v `pwd`:/host -v ${DOCKER_VOLUME_VENDOR}:/vendor alpine:latest sh -c "cp -vrT /vendor /host/vendor && chown -R 1000:1000 /host/vendor"
    docker run --rm -it -v `pwd`:/host -v ${DOCKER_VOLUME_NODE_MODULES}:/node_modules alpine:latest sh -c "cp -vrT /node_modules /host/node_modules && chown -R 1000:1000 /host/node_modules"
}

#------------------
# cleanup local resources
#------------------
function clean_local {
    git clean -fx
    rm -rf vendor
    rm -rf node_modules
}

# プロジェクトディレクトリに移動
cd ${DIR_PROJECT}
if [ -f .env ]; then
    source .env
fi


#------------------
# Commands
#------------------
if [ $# -eq 0 ]; then
    # show help
    display_help

elif [ "$1" == "help" ]; then
    display_help

elif [ "$1" == "init" ]; then
    # copy .env File
    if [ ! -f .env ]; then
        cp .env.example .env
    fi

    # container build & startup
    ${CMD_DOCKER} build

    # ライブラリインストール
    docker run --rm -it --env WWWUSER=1000 -v `pwd`:/var/www/html ${APP_IMAGE} composer install
    docker run --rm -it --env WWWUSER=1000 -v `pwd`:/var/www/html ${APP_IMAGE} npm install

    # container起動
    # 念の為, mysql起動待ちを10秒
    ${CMD_DOCKER} up -d
    sleep 10

    # Database Migration
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan migrate
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan db:seed

    # setup ide-helper
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan ide-helper:generate
    echo "complete init."

elif [ "$1" == "migrate" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan migrate

elif [ "$1" == "seed" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan db:seed

elif [ "$1" == "refresh-db" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan migrate:refresh --seed

elif [ "$1" == "destroy" ]; then
    ${CMD_DOCKER} down --volumes

elif [ "$1" == "destroy-all" ]; then
    # dockerリソースを削除
    ${CMD_DOCKER} down --rmi all --volumes --remove-orphans

    # ローカルリソースを削除
    clean_local
    echo "complete destroy all."

elif [ "$1" == "up" ]; then
    ${CMD_DOCKER} up -d

elif [ "$1" == "down" ]; then
    shift 1;
    ${CMD_DOCKER} down $@

elif [ "$1" == "ps" ]; then
    ${CMD_DOCKER} ps

elif [ "$1" == "cp2local" ]; then
    # ライブラリをlocalにコピー
    copy_to_local

elif [ "$1" == "clean-local" ]; then
    # ローカルリソースを削除
    clean_local

elif [ "$1" == "artisan" ]; then
    shift 1
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan "$@"

elif [ "$1" == "tinker" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan tinker

elif [ "$1" == "bash" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} bash

elif [ "$1" == "mysql" ]; then
    ${CMD_DOCKER} exec ${MYSQL_CONTAINER} bash -c 'MYSQL_PWD=${MYSQL_PASSWORD} mysql -u ${MYSQL_USER} ${MYSQL_DATABASE}'

elif [ "$1" == "composer" ]; then
    shift 1
    ${CMD_DOCKER} exec -u root ${APP_CONTAINER} composer $@

elif [ "$1" == "ide-helper" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan ide-helper:generate

elif [ "$1" == "npm" ]; then
    shift 1
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} npm $@

elif [ "$1" == "ci" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpcbf --standard=phpcs.xml
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpcs --standard=phpcs.xml
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpmd packages/ text phpmd.xml
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpstan analyze
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} bash -c "export XDEBUG_MODE=off && php artisan test"

elif [ "$1" == "phpcs" ]; then
    shift 1
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpcs --standard=phpcs.xml $@

elif [ "$1" == "fix" ]; then
    shift 1
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpcbf --standard=phpcs.xml $@

elif [ "$1" == "phpmd" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpmd packages/ text phpmd.xml

elif [ "$1" == "larastan" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} vendor/bin/phpstan analyze

elif [ "$1" == "test" ]; then
    shift 1
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan config:clear
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} bash -c "export XDEBUG_MODE=off && php artisan test $@"

elif [ "$1" == "test-coverage" ]; then
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} php artisan config:clear
    ${CMD_DOCKER} exec -u ${APP_USER} ${APP_CONTAINER} bash -c "export XDEBUG_MODE=coverage && vendor/bin/phpunit --coverage-html public/coverage"

else
    # transfer to 'docker-compose' command
    ${CMD_DOCKER} "$@"

fi
