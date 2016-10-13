.. _capture_groups:

###################
Capturas de llamada
###################

Se entiende por captura de llamada **la acción de un usuario que escucha** (o se entera de otro modo, vía panel de supervisión, etc.) **que una extensión está sonando y, desde su terminal, roba dicha llamada**.

IvozProvider soporta dos tipos de captura de llamadas:

.. glossary::

    Captura de llamadas directa
        En las capturas de llamadas directas el usuario indica un código que incluye la extensión del teléfono cuya llamada quiere *robar*. Si el código fuera \*95, por ejemplo, marcaría \*95101 para capturar una llamada que esté sonando en la extensión 101.

    Captura de llamadas indirecta
        En las capturas de llamadas indirectas, en cambio, el usuario indica un código y el sistema busca qué teléfono está sonando dentro de sus grupos de captura.

****************************
Grupos de captura de llamada
****************************

Para poder realizar **capturas de llamada indirectas**, el usuario que captura tiene que pertener al mismo grupo de captura que el usuario al que pretende capturar.

La sección **Grupos de captura de llamada** nos permite crear estos grupos y decir qué usuarios pertenecen a ellos:

.. image:: img/capture_groups.png

Como vimos en la sección de :ref:`users`, también se puede editar un usuario para editar los grupos de captura a los que pertenece.

.. note:: Un usuario puede pertenecer a más de un grupo de captura, el sistema tendrá en cuenta todos sus grupos.


Desde el momento en el que un usuario está en un grupo de captura, puede empezar a intentar capturar de forma indirecta pero para ello necesita saber el código de captura.

****************************
Código de captura de llamada
****************************

IvozProvider permite definir los códigos de captura a 2 niveles:

- A nivel de marca en **Configuración de Marca** > **Servicios**.

- A nivel de empresa en **Configuración de Empresa** > **Servicios**.

Esto permite que el administrador de marca pueda definir unos códigos genéricos para todas sus empresas y que, las empresas que deseen utilizar otros códigos, puedan redefinirlos.

:ref:`La siguiente sección <services>` explica todo lo relativo a servicios, que engloba los códigos de captura y otros servicios adicionales a los que se accede marcando códigos que comienzan por \*.

