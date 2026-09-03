#!/bin/bash
###############################################################################
# release-commits.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2026/09/02
#
###############################################################################
#
# List everything merged between two git references, grouped as pull requests
# with the information needed to write a ChangeLog entry: pull request number,
# Jira ticket, title, commit tags, changed components and a suggested section.
#
# Used while writing the ChangeLog of a release, as documented in
# doc/dev/RELEASE.md file
#
# Usage: release-commits.sh [from-ref] [to-ref]
#
###############################################################################

# Keep sort collation consistent
export LC_ALL=C

FROM=$1
TO=$2

# Move to repository root
cd $(dirname "$(realpath -se "$0")")/..

# Default range: from the last release tag up to the current main branch
if [ -z "$FROM" ]; then
    FROM=$(git describe --tags --abbrev=0 main)
fi
if [ -z "$TO" ]; then
    TO="main"
fi

# Map a commit tag to its ChangeLog section
section_of() {
    case "$1" in
        portal|portal/*) echo "Portals" ;;
        core|rest|rest/*) echo "Core" ;;
        kamailio|kamusers|kamtrunks|proxy) echo "Kamailio" ;;
        asterisk|agi|as) echo "Asterisk" ;;
        microservices/provision) echo "Provisioning" ;;
        schema|data) echo "Schema" ;;
        *) echo "Misc" ;;
    esac
}

# Commit tags of a pull request, deduplicated and comma separated
tags_of() {
    git log --format="%s" "$1..$2" \
        | grep -oP '^[a-z][a-z0-9/()]*(?=:)' \
        | sort -u \
        | paste -sd, - \
        | sed 's/,/, /g'
}

# Suggested sections of a pull request, one per line
sections_of() {
    local TAGS
    TAGS=$(git log --format="%s" "$1..$2" | grep -oP '^[a-z][a-z0-9/()]*(?=:)' | sort -u)
    for TAG in $TAGS; do
        section_of "$TAG"
    done | sort -u | paste -sd, - | sed 's/,/, /g'
}

# Top level components touched by a pull request
components_of() {
    git diff --name-only "$1" "$2" \
        | awk -F/ '{
            if (NF > 1 && $1 ~ /^(web|microservices|kamailio|library|schema|doc|profiles|tests)$/)
                print $1"/"$2;
            else
                print $1
          }' \
        | sort -u \
        | head -8 \
        | paste -sd, - \
        | sed 's/,/, /g'
}

MERGES=$(git log --merges --first-parent --format="%H" "$FROM..$TO")
DIRECT=$(git log --no-merges --first-parent --format="%h %s" "$FROM..$TO")
TOTAL_COMMITS=$(git log --no-merges --format="%H" "$FROM..$TO" | wc -l)
TOTAL_MERGES=$(echo "$MERGES" | grep -c .)

echo "# Release commits: $FROM -> $TO ($TOTAL_MERGES pull requests, $TOTAL_COMMITS commits)"
echo

PULL_REQUESTS=""
DEPENDENCIES=""

for MERGE in $MERGES; do
    SUBJECT=$(git log -1 --format="%s" "$MERGE")
    BODY=$(git log -1 --format="%b" "$MERGE" | head -1)
    PARENTS=($(git log -1 --format="%P" "$MERGE"))
    BASE=${PARENTS[0]}
    HEAD=${PARENTS[1]}

    # Merge commits not created by a pull request (a local merge, for instance)
    if [ -z "$HEAD" ]; then
        continue
    fi

    NUMBER=$(echo "$SUBJECT" | grep -oP '(?<=Merge pull request #)[0-9]+')
    BRANCH=$(echo "$SUBJECT" | sed 's/.* from //')
    TICKET=$(echo "$BRANCH $BODY" | grep -oP '[A-Z]+-[0-9]+' | head -1)
    TITLE=$(echo "$BODY" | sed 's/^\[[A-Z]\+-[0-9]\+\] *//')

    if [ -z "$TITLE" ]; then
        TITLE="$SUBJECT"
    fi

    ENTRY="#${NUMBER:-?} ${TICKET:-no-ticket} $TITLE"$'\n'
    ENTRY+="      sections: $(sections_of "$BASE" "$HEAD")"$'\n'
    ENTRY+="      tags: $(tags_of "$BASE" "$HEAD")"$'\n'
    ENTRY+="      components: $(components_of "$BASE" "$HEAD")"$'\n'

    if [[ "$BRANCH" == *dependabot/* ]]; then
        DEPENDENCIES+="$ENTRY"
    else
        PULL_REQUESTS+="$ENTRY"
    fi
done

echo "== PULL REQUESTS =="
echo "$PULL_REQUESTS"

if [ -n "$DEPENDENCIES" ]; then
    echo "== DEPENDENCY UPDATES (collapse into a single ChangeLog entry) =="
    echo "$DEPENDENCIES"
fi

if [ -n "$DIRECT" ]; then
    echo "== COMMITS PUSHED WITHOUT A PULL REQUEST =="
    echo "$DIRECT"
    echo
fi

exit 0
