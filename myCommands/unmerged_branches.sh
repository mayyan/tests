#!/bin/bash

# identify the branches merge to source_branch, but didn't merge to target_branch

target_branch="6.61-release"
source_branch="pdn"

hg log -r "p2(branch('$source_branch'))" | grep branch | sort -u > /tmp/pdn_branches.txt

hg up -C "$target_branch"

while read line; do
    branch=`echo $line | awk -F':' '{print $2}' | tr -d '[[:space:]]'`

    merge=`hg merge --preview "$branch"`
    if [ "$merge" != "" ]; then
        echo "$branch is in $source_branch, but not in $target_branch"
    fi
done </tmp/pdn_branches.txt