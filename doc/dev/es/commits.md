## Formato de los commits

Para mantener los commits homogéneos se empleará solo inglés en los textos
de los commits.

Preferentemente el commit tendrá una linea descriptiva con un prefijo que
referencie cual es la parte más modificada por los cambios del commit. Esta
linea no debe superar en exceso los 60 caractéres, como recomendación.

Si bien los prefijos no son estrictos, si es posible, emplear aquellos que ya
existan en el histórico de commits:

    - doc: Cambios en la documentación (sin cambio de funcionalidades)
    - portals: Cambios que afectan principalmente a portales, klear, etc
    - kamtrunks: Cambios que afectan a proxys de salida
    - kamusers: Cambios que afectan a proxys de usuarios
    - agi: Cambios que afectan a las logicas de PBX
    - scheme: Cambios que afectan unicamente a la estructura de bases de datos
    - mappers: Cambios en mappers y/o modelos (regeneración por ejemplo)
    - i18n: Cambios de traducciones o internacionalización
    - pkg: Cambios del sistema de distribucion de paquetes debian
    - ...

Los tags pueden ser todo lo específico que se deseen, pudiendo hacer referencia
a un servicio en concreto, como fax:, provisioning: o invoicer:

Los commits contendrán opcionalmente una descripción larga del cambio a partir
de la segunda linea del mensaje. Esta descripción puede contener un código de
incidencia de gitlab o mantis.

## Resolucion de conflictos en commits

Siempre que sea posible, se evitará forzar merges a la hora de pullear cambios.
Una práctica sencilla es ejecutar reabase cuando se pullean cambios ajenos:

    git pull --rebase

De esta manera, nuestros commits pendientes se generarán a partir del último cambio
pusheado en el servidor, en lugar de forzar un commit extra para mergear.

Si varios desarrolladores han modificado los mismos ficheros, se deberán intentar
resolver y continuar con el rebase. En caso de no ser prosible, consultar con el
desarrollador del commit que conflicta con el nuestro.

