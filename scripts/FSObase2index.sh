#!/bin/bash
###############################################################################
# FSObase2index.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2017/06/16
#
###############################################################################
#
# Moves stored files created with storeInBaseFolder to their final
# destination when that setting is not enabled.
#
# For example: /storage/model/4567.mp3 -> /storage/model/4/5/6/4567.mp3
#
# **** This only works for objects with numeric ID ****
# **** This only works for objects with numeric ID ****
# **** This only works for objects with numeric ID ****
#
###############################################################################
if [ -z $1 ]; then
    echo Usage: $0 path/to/storage/model
    exit 1
fi

STORAGEPATH=$1
for FILE in $(find $STORAGEPATH -maxdepth 1 -type f); do
    # Get file ID
    FILEID=$(basename ${FILE%?.???})
    # Get destination dir -> All digits but the last one
    DIR=$(echo $FILEID | sed -e 's/\([0-9]\)/\1\//g')

    # If id only contains one digit, use directory 0/
    if [ "$FILEID" == "$DIR" ]; then
        DIR="0/"
    fi

    # Create Dir
    mkdir -p $STORAGEPATH/$DIR
    # Move file
    mv -v $FILE $STORAGEPATH/$DIR
done

# Fix storage perms
chmod -R 777 $STORAGEPATH
exit 0

