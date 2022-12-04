## REGISTRO NUEVO USUARIO
    http://localhost:8080/api/user/create
    Tipo : post
    Json que recibe la api: {
                               "email": "amaia@correo.com",
                               "pass": "ASdfgh123"
                            }
    Respuesta: Si hace registro devuelve StatusCode 200
               Si no hace el registro devuelve StatusCode 400
## ACTIVACIÓN DE CUENTA
    http://localhost:8080/activacion/(:num)
    Tipo : GET
    Este enlace lo recibe el nuevo usuario en su correo, cuando lo pulse le redirige a la página de login.
    El back se encarga de la lógica de la verificación.
    En la url se recibe un parámetro en función de la respuesta de la API:
        http://localhost:4200/login?verificado=error --> No se ha encontrado al usuario o algún fallo interno por BD o servidor.    
                                                     --> En el alert, mensaje tipo inténtalo más tarde o ponte en contacto con nosotros.

        http://localhost:4200/login?verificado=error44 --> El usuario ya está verificado anteriormente.
                                                       --> En el alert, mensaje tipo 'Este usuario ya ha sido verificado. Puedes iniciar sesión'.

        http://localhost:4200/login?verificado=ok --> Usuario verificado
                                                  --> En el alert, mensaje tipo, 'Usuario verificado correctamente'
## LOGIN
    http://localhost:8080/api/user/login
    Tipo: post
    Json que recibe la api: {
                               "email": "amaia@correo.com",
                               "pass": "ASdfgh123"
                            }
    Respuesta: Si el email está registrado y la pass es correcta, devuelve:
                    {
                        "id": "1",
                        "pass": true,
                        "username": null
                    }
               Si está registrado pero la contraseña no es correcta
                    {
                        "id": "1",
                        "pass": false
                    }   
                Si no esta registrado:
                    {
                        "id": null
                    }
                Si no ha verificado su emial
                    {
                        "verificado": 0
                    }

## ACTUALIZAR DATOS DE USUARIO         
    http://localhost:8080/api/user/update
    Tipo: put
    TODO: Funciona, pero de forma básica, tengo que terminarla
