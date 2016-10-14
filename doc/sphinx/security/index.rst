##########################
[P] Elementos de seguridad
##########################

******************
Firewall con geoIP
******************



************************************
Rangos de IP autorizados por empresa
************************************

En el proceso de creación de empresas nos saltamos deliberademente un mecanismo de seguridad que pasamos a describir:

.. image:: img/authorized_ips2.png
    :align: center

Por medio de este mecanismo especificamos qué direcciones IP o qué redes pueden utilizar las credenciales de los terminales de una empresa concreta. Todo usuario que quiera conectarse desde una red no incluida, no podrá, aunque disponga de unas credenciales válidas.

.. error:: Una vez activado el filtrado, **es obligatorio** añadir redes o direcciones válidas o, por el contrario, todas las llamadas se rechazarán:

.. image:: img/authorized_ips.png

Se pueden añadir direcciones IP y rangos de direcciones, en formato CIDR (IP/mask):

.. image:: img/authorized_ips3.png

*************
Anti-flooding
*************

*******************************
Límite de llamadas concurrentes
*******************************

.. image:: img/call_limit.png

