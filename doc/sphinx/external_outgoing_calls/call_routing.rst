.. _outgoing_routes:

Ya tenemos nuestra llamada de pruebas categorizada dentro del **Patrón de destino** 'España'. Es más, también tenemos un **Grupo de patrones de destino** que incluye 'España', 'Europa'.

Ahora solo nos falta decir a IvozProvider que las llamadas de 'España' o de 'Europa' salgan por nuestro **Contrato de peering**.

###############
Rutas salientes
###############

Para realizar esta vinculación, accedemos a la sección **Rutas salientes**:

.. image:: img/outgoing_routes_section.png
    :align: center

Si optamos por enrutar solamente las llamadas de España por nuestro Contrato de *peering*, tendremos que realizar la siguiente configuración:

.. image:: img/outgoing_routes_by_pattern.png
    :align: center

Por el contrario, si somos más generosos y decidimos permitir todas las llamadas a países europeos, la configuración a aplicar sería la siguiente:

.. image:: img/outgoing_routes_by_patterngroup.png
    :align: center

.. _routes_metrics:

Existen dos parámetros que merecen explicación:

.. glossary::

    Prioridad
        Si una llamada concreta encaja con rutas de distinta prioridad, la llamada se sacará por la que menor prioridad tenga siempre y cuando esté disponible.

    Métrica
        Si una llamada concreta encaja con rutas con la misma prioridad, la métrica determina cuántas se sacarán por una ruta y cuántas por otra.

.. note:: Estos dos parámetros son clave para conseguir dos funcionalidades muy interesantes: **load-balancing** y **failover-routes**.

Balanceo de carga
=================

El balanceo de carga o *load-balancing* nos permite sacar un porcentaje de llamadas por una ruta y otro porcentaje de llamadas por otra ruta, es decir, nos permite repartir las llamadas entre dos o más rutas igualmente válidas.

.. rubric:: Ejemplo 1

- Ruta A: prioridad 1, métrica 1
- Ruta B: prioridad 1, métrica 1

Las llamadas que encajen en ambas rutas se sacaran el 50% por una ruta y el 50% por la otra.

.. rubric:: Ejemplo 2

- Ruta A: prioridad 1, métrica 1
- Ruta B: prioridad 1, métrica 2

Las llamadas que encajen en ambas rutas se sacaran el 33% por la Ruta A y el 66% por la Ruta B (el doble por B que por A).

Conmutación por error
=====================

Las rutas en caso de fallo o *failover-routes* nos permite disponer de ruta adicional en caso de que la ruta preferida falle.

.. rubric:: Ejemplo

- Ruta A: prioridad 1, métrica 1
- Ruta B: prioridad 2, métrica 1

Las llamadas que encajen en ambas rutas se intentarán sacar siempre por la Ruta A. En caso de no error (operador caído, etc.), se intentará sacar por la Ruta B.

.. tip:: Tanto el balanceo de carga como las rutas de fallo permiten encadenar/utilizar más de 2 rutas, aunque en los ejemplo se hayan utilizado solo 2.

