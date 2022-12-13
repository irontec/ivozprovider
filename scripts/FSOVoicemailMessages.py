#!/usr/bin/python3
###############################################################################
# FSOVoicemailMessages.py
#
# Author: IvozProvider <voip+ivozprovider@irontec.com>
# Date: 2022/06/27
#
###############################################################################
#
# Create ast_voicemail_messages entries from storage contents.
#
# Since 3.0.0 all voicemail messages files are mapped in ast_voicemail_messages
# application table and VoicemailMessages business table. This scripts creates
# a new row in ast_voicemial_messages for each existing voicemail in storage.
# There is a scheduler (run-voicemail-messages) that migrates rows from that
# table to the final VoicemailMessages table.
#
###############################################################################

import configparser
import glob
import os

import mysql.connector

# Configuration
storage_path = "/opt/irontec/ivozprovider/storage"
voicemail_spool = storage_path + "/asterisk/spool/voicemail/"

# Meta files reader
config = configparser.ConfigParser()

try:
    # MySQL access configuration
    cnx = mysql.connector.connect(user='root', password='changeme',
                                  host='data.ivozprovider.local',
                                  database='ivozprovider')

    # Get a list of voicemails
    messages = glob.glob(voicemail_spool + "**/*.txt", recursive=True)

    # For each voicemail present in storage
    for message in messages:
        # Get message information from filename
        dir = os.path.dirname(message)
        msgnum = int(os.path.basename(message).strip("msg").rstrip(".txt"))
        [context, user, folder] = dir.split("/")[-3:]

        # Check if file has already been imported
        cursor = cnx.cursor()
        cursor.execute("SELECT id FROM ast_voicemail_messages WHERE dir = %s AND msgnum = %s", (dir, msgnum))
        found = cursor.fetchall()
        if found:
            print("Message %s already imported in database. Skipping." % message)
            continue

        # Read from voicemail medatada file
        config.read(message)

        # Add new voicemail to voicemails table
        cursor.execute("INSERT INTO ast_voicemail_messages "
                       "(dir, msgnum, context, macrocontext, callerid, origtime, duration, recording, flag, category, mailboxuser, mailboxcontext, msg_id )"
                       "VALUES"
                       "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       (
                           dir,
                           msgnum,
                           config['message']['context'],
                           config['message']['macrocontext'],
                           config['message']['callerid'],
                           config['message']['origtime'],
                           config['message']['duration'],
                           '',
                           config['message']['flag'],
                           config['message']['category'],
                           user,
                           context,
                           config['message']['msg_id'],
                       ))
        cnx.commit()
        print("Message %s imported into database." % message)
except mysql.connector.Error as err:
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("Access denied, EDIT this script and configure MySQL credentials")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("Database does not exist")
    else:
        print(err)
