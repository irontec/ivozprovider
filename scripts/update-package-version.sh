#!/bin/bash
###############################################################################
# update-package-version.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2024/11/21
#
###############################################################################
#
# Update Debian package version using dch
#
# Usage: update-package-version.sh 4.3.1
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
MAIN=$MAJOR.$MINOR

if [ -z "$MAJOR" ] || [ -z "$MINOR" ] || [ -z "$PATCH" ]; then
    echo "ERROR: Invalid standard version format (major.minor.patch)"
    echo
    echo "Usage: $0 major.minor.patch"
    exit 2
fi

# Get project name from debian/changelog
PROJECT=$(grep -m1 -oP '^\S+' debian/changelog)

# Get package version
PKGVERSION=$(grep -m1 -oP '\(\K[^)]+(?=\))' debian/changelog)

# Split package version into major.minor~project
PKGMAIN=${PKGVERSION%%~*}
PKGVERSION=${PKGVERSION#*~}

# Ensure versions we're upgrading the package
if [[ "$PROJECT" == "ivozprovider" ]]; then
    dpkg --compare-versions $VERSION gt $PKGVERSION
else
    dpkg --compare-versions $MAIN gt $PKGMAIN
fi
if [ $? -ne 0 ]; then
    echo -e "\033[1;33m$PROJECT: Given version $MAIN is not greater than existing package version $PKGMAIN\033[0m"
    exit 1
fi

# Special case for these projects: PKGVERSION is ivozprovider VERSION
if [[ "$PROJECT" == "ivozprovider" || "$PROJECT" == "ivozprovider-asterisk-sounds" ]]; then
    PKGVERSION=$VERSION
fi

# Change current unstable entry in changelog
sed -i 's/UNRELEASED/stable/g' debian/changelog

# Add a new entry for new version
dch --controlmaint --distribution UNRELEASED --newversion $MAIN~$PKGVERSION "Version bump to $VERSION"

echo "Debian package version bumped to $VERSION"
exit 0