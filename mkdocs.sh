#!/bin/bash

# @see: http://www.mkdocs.org
# @dev: mkdocs serve -a 0.0.0.0:8000

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
components['lxd']='plinker/lxd'

function move_component_docs {
    # loop over project components
    for key in "${!components[@]}"
    do
        # check project folder exists
        if [ -d "$PWD/vendor/${components[$key]}" ]; then
            if [ -f "$PWD/vendor/${components[$key]}/docs/index.md" ]; then
                \cp -r $PWD/vendor/${components[$key]}/docs/index.md $PWD/docs/$key.md
            else
                echo "- Skipping component, docs index does not exist: $PWD/vendor/${components[$key]}/docs/index.md"
            fi
        else
            echo "- Skipping component, directory does not exist: $PWD/vendor/${components[$key]}"
        fi
    done
}

function deploy_github {
    sudo mkdocs gh-deploy

    rm site/ -Rf
}

function main {
    move_component_docs
    deploy_github
}

main
