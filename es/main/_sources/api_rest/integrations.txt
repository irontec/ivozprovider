########################
Third party integrations
########################

Ivoz Provider makes use of **OpenAPI Specification 2.0** (which is identical to the Swagger 2.0 specification before it was
renamed to "OpenAPI Specification").

APIs are supposed to be the way to integrate third party applications with IvozProvider. Some community tools, such as
`swagger-codegen <https://github.com/swagger-api/swagger-codegen>`_, may be of great help during the client development.
According to their github page the following language/framework code auto-generation is supported:

    - ActionScript
    - Ada
    - Apex
    - Bash
    - C# (.net 2.0, 3.5 or later)
    - C++ (cpprest, Qt5, Tizen)
    - Clojure
    - Dart
    - Elixir
    - Elm
    - Eiffel
    - Erlang
    - Go
    - Groovy
    - Haskell (http-client, Servant)
    - Java (Jersey1.x, Jersey2.x, OkHttp, Retrofit1.x, Retrofit2.x, Feign, RestTemplate, RESTEasy, Vertx, Google API Client Library for Java, Rest-assured)
    - Kotlin
    - Lua
    - Node.js (ES5, ES6, AngularJS with Google Closure Compiler annotations)
    - Objective-C
    - Perl
    - PHP
    - PowerShell
    - Python
    - R
    - Ruby
    - Rust (rust, rust-server)
    - Scala (akka, http4s, swagger-async-httpclient)
    - Swift (2.x, 3.x, 4.x)
    - Typescript (Angular1.x, Angular2.x, Fetch, jQuery, Node)

Each IvozProvider installation serves its API specs in the URLs below:

    - Platform API spec: ``https://your-domain/api/platform/docs.json``
    - Brand API spec: ``https://brand-domain/api/brand/docs.json``
    - Client API spec: ``https://client-domain/api/client/docs.json``
