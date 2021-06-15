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

# Update package version
grep -q -F $VERSION debian/changelog
if [ $? -ne 0 ]; then
    # Set the current version as stable:
    dch --controlmaint --release ""
    # Add a new entry with the new version with UNRELEASED distribution. 
    dch --controlmaint --distribution UNRELEASED --newversion $MAJOR.$MINOR~$VERSION "Version bump to $VERSION" 
fi


# Update documentation version
# Sphinx shows documentation version above the left menu
sed -i "s/\(version =\) .*/\1 \"$MAJOR.$MINOR\"/" doc/sphinx/conf.py
sed -i "s/IvozProvider [0-9\.]\+ Documentation/IvozProvider $MAJOR.$MINOR Documentation/" doc/sphinx/conf.py


# Update Application User Agent
sed -i "s/\(user_agent=Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR/" asterisk/config/pjsip.conf

# Update Kamailio User Agent and Server
sed -i "s/\(server_header=\"Server: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/trunks/config/kamailio.cfg
sed -i "s/\(server_header=\"Server: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/users/config/kamailio.cfg
sed -i "s/\(user_agent_header=\"User-Agent: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/trunks/config/kamailio.cfg
sed -i "s/\(user_agent_header=\"User-Agent: Irontec IvozProvider\) .*/\1 v$MAJOR.$MINOR\"/" kamailio/users/config/kamailio.cfg

# Done!
echo "All versions bumped to $VERSION"
