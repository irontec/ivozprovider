## About Storage path

Storage path is mounted on nfs in distributed installations. Because of that, you should not rely on 
the file/folder ownership id as it may differ between nodes.

Depending on the task, stored files may be owned by root (recordings) or www-data (everything else). 
The same applies to the folders.

Folders are always created with 0777 permissions, and files with 0644. New folder permissions are read 
from application.ini files: 

        Iron.fso.localStoragePath  = "/opt/irontec/ivozprovider/storage"
        Iron.fso.localStorageChmod = "0777"

## Recordings

Recording system is executed as root and it uses these three folders:

    ivozprovider_model_recordings.tmp
    ivozprovider_model_recordings.originalfile
    ivozprovider_model_recordings.recordedfile

Under tmp you'll find ongoing recordings that will be moved to originalfile directory as soon 
as they are finished. 

This process is handled by rtpproxy. For instance:

    /usr/bin/rtpproxy -u root -f \ 
      -p /var/run/rtpproxy.pid -s udp:127.0.0.1 22222 -l 5.196.32.132 \
      -r /opt/irontec/ivozprovider/storage/ivozprovider_model_recordings.originalfile/ \
      -S /opt/irontec/ivozprovider/storage/ivozprovider_model_recordings.tmp/ \
      -m 13000 -M 17000 -t 184 -R -dDBUG

You'll find a couple of rtp files within originalfile directory as a result:

    # ls -la ivozprovider_model_recordings.originalfile/
    2_2654064392@10.10.1.226=3704343059.0.a.rtp
    2_2654064392@10.10.1.226=3704343059.0.o.rtp

The encoding service is run by a systemd timer periodically 
(/etc/systemd/system/ivozprovider-recordings.timer), it's not a reactive process. 
It may take some minutes to get the final files available from the portals.

Encoder process converts rtp files to wav first and wav files to mp3 immediately afterwards. 
Via FSO these mp3 end up hosted in ivozprovider_model_recordings.recordedfile directory.

    # ls -la ivozprovider_model_recordings.recordedfile/1/
    -rw-r--r-- 1 root root 230288 jul  5 10:32 12.mp3

## locutions and music on hold
Storage folder is used by locutions and music on hold as well.

Uploaded (or recorded) locutions and music on hold are encoded to wav by MultimediaWorker. This job
is triggered as soon as the file is uploaded though there is only one worker instance per portal node.
The task will be enqueued if no available worker is found.

    drwxrwxrwx www-data www-data ivozprovider_model_genericmusiconhold.encodedfile
    drwxrwxrwx www-data www-data ivozprovider_model_genericmusiconhold.originalfile
    drwxrwxrwx www-data www-data ivozprovider_model_locutions.encodedfile
    drwxrwxrwx www-data www-data ivozprovider_model_locutions.originalfile
    drwxrwxrwx www-data www-data ivozprovider_model_musiconhold.encodedfile
    drwxrwxrwx www-data www-data ivozprovider_model_musiconhold.originalfile

## Invoices 
Invoice system makes use of the folders below:

    drwxrwxrwx www-data www-data invoice
    drwxrwxrwx www-data www-data ivozprovider_model_invoices.pdffile

The former folder is just for temporary files. The latter is where final files are stored.

## Any other folder

The rest of the folders are exclusively used by portals and there is no background process involved.

    drwxrwxrwx www-data www-data ivozprovider_model_brands.logo
    drwxrwxrwx www-data www-data ivozprovider_model_brandurls.logo
    drwxrwxrwx www-data www-data Provision_template
