#!/bin/bash
###############################################################################
# FSOBrandMusicOnHold.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2017/11/21
#
###############################################################################
#
# Moves brand stored music on hold to common moh files folder
#
# Since 2.0.0 all music on hold share the same path both for brands and
# companies, so this script only requires to be run once.
#
###############################################################################

STORAGE_DIR=/opt/irontec/ivozprovider/storage/

GENERIC_MOH_ENCODED_DIR=$STORAGE_DIR/ivozprovider_model_genericmusiconhold.encodedfile/
GENERIC_MOH_ORIGINAL_DIR=$STORAGE_DIR/ivozprovider_model_genericmusiconhold.originalfile/

MOH_ENCODED_DIR=$STORAGE_DIR/ivozprovider_model_musiconhold.encodedfile/
MOH_ORIGINAL_DIR=$STORAGE_DIR/ivozprovider_model_musiconhold.originalfile/

# Move encoded files
if [ -d $GENERIC_MOH_ENCODED_DIR ]; then
    mv -v $GENERIC_MOH_ENCODED_DIR/* $MOH_ENCODED_DIR/
    rmdir $GENERIC_MOH_ENCODED_DIR
fi

# Move original files
if [ -d $GENERIC_MOH_ORIGINAL_DIR ]; then
    mv -v $GENERIC_MOH_ORIGINAL_DIR/* $MOH_ORIGINAL_DIR/
    rmdir $GENERIC_MOH_ORIGINAL_DIR
fi