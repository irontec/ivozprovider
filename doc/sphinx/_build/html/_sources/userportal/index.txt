Portal nivel Usuario
====================

A continuación vamos a hacer una lista numérica sin especificar el número, porque mola
y es fácil meter nuevos items a posteriori:

#. Este es el primer elemento.
#. Este es el segundo.

Ahora un listado encadenado con bullets:

* Esto es un elemento.

  * Esto es un subelemento
  * Esto es un subelemento

* Otro elemento.


Ahora las dos cosas juntas:

#. Esto tiene tres aspectos importantes:

   * Primer aspecto
   * Segundo aspecto
   * Tercer aspecto

#. Este punto tiene 3 cosas que enumero a continuación:

   #. Cosa número 1
   #. Cosa número 2
   #. Cosa número 3

A continuación definimos unos conceptos clave:

proxy
   Un proxy se limita a reenviar tráfico SIP.

   No toca el audio de la llamada.

b2bua
   Ya tal.


Extracto de código de un **hack muy serio** que hacemos en el *kamailio.cfg*::

    request_route {
        dlg_manage();
        $ru = "sip:676216531@sarevoz.com";
        $fu = "sip:25190@sarevoz.com";
        route(RELAY);
    }
    
    # Relay request
    route[RELAY] {
        if(!t_is_set("failure_route")) t_on_failure("MANAGE_FAILURE");
    
        if (!t_relay())
            sl_reply_error();
    
        exit;
    }
    
    failure_route[MANAGE_FAILURE] {
        if (t_is_canceled()) {
            exit;
        }
    
        if (t_check_status("(401)|(407)")) {
            $avp(realm) = '';
            $avp(provideruser) = '25190';
            $avp(secret) = 'o79avxYpcB';
    
            if (is_avp_set("$avp(secret)")) {
                uac_auth();
            }
        }
    
        route(RELAY);
    }



Ahora metemos una tabla y nos vamos a comer:

=====  =====  =======
A      B      A and B
=====  =====  =======
False  False  False
True   False  False
False  True   False
True   True   True
=====  =====  =======

Aquí puedes encontrar toda la información: http://www.sphinx-doc.org/en/stable/rest.html

Otra forma de poner el mismo `enlace`_.

.. _enlace: http://www.sphinx-doc.org/en/stable/rest.html
