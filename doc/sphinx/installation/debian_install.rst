########################################################
Instalación por paquetes Debian
########################################################

IvozProvider está diseñado para instalarse y actualizarse mediante paquetes Debian. En concreto, la release actual esta pensada para funcionar sobre `Debian Jessie 8 <https://www.debian.org/releases/jessie>`_.

Se recomienda emplear las `guias oficiales de instalación <https://www.debian.org/releases/jessie/installmanual>`_ para obtener un sistema base mínimo, ya que toda dependencia que necesite posteriormente será instalada automaticamente.

Tanto si deseas realizar una :ref:`instalacion-standalone` o una :ref:`instalacion-distribuida`, es preciso configurar los repositorios de paquetes debian de Irontec.

********************************************************
Configurar repositorios APT
********************************************************

Actualmente se emplean dos repositorios diferentes tanto para la última release de IvozProvider (oasis) como para la de Klear (chloe)

.. code-block:: console

    cd /etc/apt/sources.list.d
    echo deb http://packages.irontec.com/debian oasis main extra > ivozprovider.list
    echo deb http://packages.irontec.com/debian chloe main > klear.list

Añadimos la clave publica del repositorio:

.. code-block:: console

    wget http://packages.irontec.com/public.key -q -O - | apt-key add -

.. _instalando-paquete-virtual:

********************************************************
Instalar el paquete del rol
********************************************************

Una vez configurados los repositorios será preciso seleccionar el paquete acorde al perfil que queramos instalar:

- Para una :ref:`instalacion-standalone`:
    - ivozprovider

- Para una :ref:`instalacion-distribuida`: uno de los paquetes en función rol se desee que desempeñe la máquina
    - ivozprovider-profile-data
    - ivozprovider-profile-proxy
    - ivozprovider-profile-portal
    - ivozprovider-profile-as

.. code-block:: console

    apt-get update
    apt-get install ivozprovider

********************************************************
Completar instalación
********************************************************
Las instalaciones distribuidas requieren multiples configuraciones en funcion del rol que se haya instalado. Consulte `completar la instalción de un rol <http://google.com>`_ para más información.

Las instalaciones standalone cuentan con un menú que ayuda a configurar los datos básicos de los servicios empleados en IvozProvider. Puesto que todos los servicios se ejecutan en la misma máquina, muchos de los procesos vienen configurados automáticamente con los valores por defecto.

El menú permite, entre otros:

- Configurar las IPs públicas de los proxies SIP
- El lenguaje por defecto que empleará la plataforma
- Las contraseñas para acceder a las bases de datos

Es posible cambiar cualquiera de estos valores una vez instalado IvozProvider volviendo a ejecutar:

.. code-block:: console

    dpkg-reconfigure ivozprovider


