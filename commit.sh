#!/bin/bash

#
## Plinker - Commit Processer
#

# vars
message=$1
projectName="Plinker"
projectDir="/var/www/html"
date=$(date +"%d-%b-%Y")

declare -A components
components['plinker-core']='plinker/core'
components['plinker-base91']='plinker/base91'
components['plinker-asterisk']='plinker/asterisk'
components['plinker-cron']='plinker/cron'
components['plinker-lxc']='plinker/lxc'
components['plinker-redbean']='plinker/redbean'
components['plinker-system']='plinker/system'
components['plinker-tasks']='plinker/tasks'
components['plinker-test']='plinker/test'

#
increment_semver() {
    # passed in as: -p, -m, -M | release = p, m, M
    release=${1#?}
    
    # passed in as: v0.0.1 | version = 0.0.1 
    version=${2#?}
    
    # explode into array based on .
    v=(${version//./ })
    
    # default to 0.0.1
    if [ ${#v[@]} -ne 3 ]
    then
        echo "0.0.1"
    else
        # Major
        if [ "$release" == "M" ]; then
            ((v[0]++))
              v[1]=0
              v[2]=0
        fi

        # Minor
        if [ "$release" == "m" ]; then
            ((v[1]++))
              v[2]=0
        fi
        
        # Patch
        if [ "$release" == "p" ]; then
            ((v[2]++))
        fi
        
        echo "${v[0]}.${v[1]}.${v[2]}"
    fi
}

#
commit() {

    echo "- Fetching tags"
    git fetch --tags
    
    # get the current semantic tag
    latestTag=$(git describe --tags `git rev-list --tags --max-count=1`)
    echo "Current Semantic Version Tag: $latestTag"

    # look for previous semvar choice tmp file
    if [ ! -f /tmp/semvar_choice ]; then
        while true; do
            read -p "Which type of change has been done: [p]atch, [m]inor, [M]ajor? " semver
            case $semver in
                [p]* ) break;;
                [m]* ) break;;
                [M]* ) break;;
                * ) echo "Please answer p, m or M";;
            esac
        done
        echo $semver > /tmp/semvar_choice
    else
        # red choice into semvar variable
        read -r semver < /tmp/semvar_choice;
    fi
    
    # new release semvar 
    releaseSemvar=$(increment_semver -"$semver" $latestTag)

    # stage changes
    git add -A ./
    
    # stage changes
    git commit -a -m "[since: v$releaseSemvar]  $date - $message"
    
    # pull latest
    git pull origin master
    
    # commit any remote changes
    git commit -a -m  "[since: v$releaseSemvar]  $date - $message"
    
    # update master
    git push origin master
    
    # commit tag
    git tag -a v$releaseSemvar -m "[$semver] v$releaseSemvar - $date - $message"
    
    # push tag
    git push origin v$releaseSemvar
}

#
main() {
    echo "---------------------------------------------------"
    echo "- Project -: $projectName"
    echo "- Date ----: $date"
    echo "- Workspace: $projectDir"
    echo "- Message -: $message"
    echo "---------------------------------------------------"

    # move into project workspace
    cd $projectDir

    # loop over project components
    for key in "${!components[@]}"
    do
        echo "- Commiting: $key"
        
        # check project folder exists
        if [ -d "$PWD/vendor/${components[$key]}" ]; then
            
            if [ -d "$PWD/vendor/${components[$key]}/.git" ]; then
            
                echo "- Entering: $PWD/vendor/${components[$key]}"
                cd "$PWD/vendor/${components[$key]}"
                
                # commit
                commit $message
            
            else
                echo "- Skipping, .git directory does not exist: $PWD/vendor/${components[$key]}/.git"
            fi
        else
            echo "- Skipping, directory does not exist: $PWD/vendor/${components[$key]}"
        fi

        echo "---------------------------------------------------"

        # move back into project workspace        
        cd $projectDir
    done
    
    rm /tmp/semvar_choice
}

main
