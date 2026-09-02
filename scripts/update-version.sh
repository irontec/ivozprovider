#!/bin/bash
###############################################################################
# update-version.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2020/12/28
#
###############################################################################
#
# Update package and software version. This script is based on task documented
# in doc/dev/RELEASE.md file
#
# Usage: update-version.sh 2.24.5
#
###############################################################################

VERSION=$1

if [ -z "$VERSION" ]; then
    echo "ERROR: Missing version parameter"
    echo
    echo "Usage: $0 major.minor.patch"
    exit 1
fi

SEMVER=(${VERSION//./ })
MAJOR="${SEMVER[0]}"
MINOR="${SEMVER[1]}"
PATCH="${SEMVER[2]}"

if [ -z "$MAJOR" ] || [ -z "$MINOR" ] || [ -z "$PATCH" ]; then
    echo "ERROR: Invalid standard version format (major.minor.patch)"
    echo
    echo "Usage: $0 major.minor.patch"
    exit 2
fi

# Update documentation version
# Sphinx shows documentation version above the left menu
sed -i "s/\(version =\) .*/\1 \"$MAJOR.$MINOR\"/" doc/sphinx/conf.py
sed -i "s/IvozProvider [0-9\.]\+ Documentation/IvozProvider $MAJOR.$MINOR Documentation/" doc/sphinx/conf.py

# Update Application User Agent
sed -i "s/\(user_agent=Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR/" asterisk/config/pjsip.conf.in

# Update Kamailio User Agent and Server
sed -i "s/\(server_header=\"Server: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/trunks/config/kamailio.cfg
sed -i "s/\(server_header=\"Server: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/users/config/kamailio.cfg
sed -i "s/\(user_agent_header=\"User-Agent: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/trunks/config/kamailio.cfg
sed -i "s/\(user_agent_header=\"User-Agent: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/users/config/kamailio.cfg

# Update README badge and ISO link of the maintained release branch
# Both are no-ops on patch releases, where MAJOR.MINOR does not change
sed -i "s|badge/latest-[0-9.]\+-blue|badge/latest-$MAJOR.$MINOR-blue|" README.md
sed -i "s#| tempest | [0-9.]\+ #| tempest | $VERSION #" README.md
sed -i "s|ivozprovider-[0-9.~]\+-tempest-amd64.iso|ivozprovider-$MAJOR.$MINOR~$VERSION-tempest-amd64.iso|" README.md

# Update portals versions
# --no-git-tag-version keeps npm from committing and tagging on its own
for PORTAL in platform brand client user;do
    pushd web/portal/$PORTAL
    npm version --no-git-tag-version $VERSION
    popd
done

# Done!
echo "All versions bumped to $VERSION"
