#!/bin/bash
###############################################################################
# check-iso-packages.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2026/09/02
#
###############################################################################
#
# Check that every binary package built from debian/control is included in the
# package list used to build the installation ISO. New packages added during a
# release cycle are easily forgotten there, leaving them out of the ISO.
#
# Used before releasing, as documented in doc/dev/RELEASE.md file
#
# Usage: check-iso-packages.sh
#
# Exit codes:
#   0 - every package is present in the ISO package list
#   1 - some packages are missing (printed, one per line)
#
###############################################################################

# Keep sort collation consistent
export LC_ALL=C

# Move to repository root
cd $(dirname "$(realpath -se "$0")")/..

CONTROL="debian/control"
PACKAGE_LIST="extra/simple-cdd/package.list"

MISSING=$(comm -23 \
    <(grep "^Package:" "$CONTROL" | awk '{print $2}' | sort -u) \
    <(sort -u "$PACKAGE_LIST"))

if [ -z "$MISSING" ]; then
    echo "Every $CONTROL package is present in $PACKAGE_LIST"
    exit 0
fi

echo "The following packages are missing from $PACKAGE_LIST:"
echo "$MISSING" | sed 's/^/ - /'
exit 1
