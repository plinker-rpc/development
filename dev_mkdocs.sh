#!/bin/bash

#

if [[ $EUID -ne 0 ]]; then
   echo "This script must be run as root: sudo bash dev_mkdocs.sh"
   exit 1
fi

VENDOR="vendor/plinker"

declare -A components
components['core']='plinker/core'
components['base91']='plinker/base91'
components['asterisk']='plinker/asterisk'
components['cron']='plinker/cron'
components['lxc']='plinker/lxc'
components['redbean']='plinker/redbean'
components['system']='plinker/system'
components['tasks']='plinker/tasks'
components['test']='plinker/test'
components['nginx']='plinker/nginx'
components['iptables']='plinker/iptables'
components['files']='plinker/files'

function block {
    inotifywait -q -r -e modify,move,create,delete $VENDOR
}

function stop_mkdocs_serve {
    for pid in $(ps -ef | awk '/mkdocs serve -a 0.0.0.0/{print $2}'); do
        echo "Killing mkdocs process: $pid"
        sudo kill -9 $pid &> /dev/null
    done
}

function start_mkdocs_serve {
    sudo mkdocs serve -a 0.0.0.0:8000 >nohup.out 2>&1 &
}

function move_component_docs {
    # loop over project components
    for key in "${!components[@]}"
    do
        # check project folder exists
        if [ -d "$PWD/vendor/${components[$key]}" ]; then
            if [ -f "$PWD/vendor/${components[$key]}/README.md" ]; then
                \cp -r $PWD/vendor/${components[$key]}/README.md $PWD/docs/$key.md
            else
                echo "- Skipping component, README.md does not exist: $PWD/vendor/${components[$key]}/README.md"
            fi
        else
            echo "- Skipping component, directory does not exist: $PWD/vendor/${components[$key]}"
        fi
    done
}

function main {
    move_component_docs

    echo "Stopping mkdocs server"
    stop_mkdocs_serve

    echo "Starting mkdocs server"
    start_mkdocs_serve
}

main

while block; do
    main
done
