Application Servers
-------------------

The section **Application Servers** will list the IP address where the existing
Asterisk processes will listen for request, and like previously mentioned,
can scale horizontaly to adapt the platform for the required load.

Contrary to the Proxies, Asterisk is not exposed to the external world, so
for a standalone installation there will only be one listening at 127.0.0.1.

.. ifconfig:: language == 'en'

    .. image:: img/en/app_servers.png

.. ifconfig:: language == 'es'

    .. image:: img/es/app_servers.png

.. note:: The listening port will not be displayed in the field because it will
    always be 6060 (UDP).

.. important:: As soon as another Application Server is added, the proxies will
    try to balance load using it. If no response is received from added
    Application server, it will be disabled automatically.
