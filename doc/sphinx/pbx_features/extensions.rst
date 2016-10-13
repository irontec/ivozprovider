.. _extensions:

###########
Extensiones
###########

La configuración de partida incluía 2 extensiones (101 y 102) que apuntaban directamente a *Alice* y *Bob*, por lo que apenas dijimos nada sobre la sección **Configuración de empresa** > **Extensiones**.

.. note:: **Una extensión es**, por definición, **un número interno con una lógica asignada**.

.. rubric:: Crear una nueva extensión

La ventana de creación de una nueva extensión es tal que así:

.. image:: img/extension_add.png

.. glossary::

    Número
        El número que al ser marcado por un usuario interno activará la lógica que sigue. Tiene que tener una longitud mínima de 2 y estar compuesto únicamente por dígitos.

    Enrutar
        Este selector nos permite indicar la lógica que seguirá esta numeración cuando sea marcada por un usuario concreto. Al seleccionar un ítem en cuestión, se nos mostrará un selector adicional para seleccionar el grupo de salto, sala de conferencias, etc.

.. note:: En el caso de las extensiones que apuntan a usuario, la vinculación con el usuario concreto tendrá que hacerse desde **Configuración de empresa** > **Usuarios**.

.. warning:: Si existe una extensión cuyo número conflicte con un número externo, el número externo quedará enmascarado y resultará, en la práctica, inaccesible para toda la empresa.

