## REGISTRO NUEVO USUARIO
    http://localhost:8080/api/user/create
    Tipo : POST
    Json que recibe la api: {
                               "email": "amaia@correo.com",
                               "pass": "ASdfgh123",
                               "username": "amaia123"
                            }
    Respuesta: Si hace registro devuelve StatusCode 200
               Si no hace el registro devuelve StatusCode 400

## ACTIVACIÓN DE CUENTA
    http://localhost:8080/activacion/(:num)
    Tipo : GET
    Este enlace lo recibe el nuevo usuario en su correo, cuando lo pulse le redirige a la página de login.
    El back se encarga de la lógica de la verificación.
    En la url se recibe un parámetro en función de la respuesta de la API:
        http://localhost:4200/login?verified=error --> No se ha encontrado al usuario o algún fallo interno por BD o servidor.    
                                                     --> En el alert, mensaje tipo inténtalo más tarde o ponte en contacto con nosotros.

        http://localhost:4200/login?verified=error44 --> El usuario ya está verificado anteriormente.
                                                       --> En el alert, mensaje tipo 'Este usuario ya ha sido verificado. Puedes iniciar sesión'.

        http://localhost:4200/login?verified=ok --> Usuario verificado
                                                  --> En el alert, mensaje tipo, 'Usuario verificado correctamente'

## LOGIN
    http://localhost:8080/api/user/login
    Tipo: POST
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
                Si no ha verificado su email
                    {
                        "verificado": 0
                    }

## REGISTRO ACTIVIDADES
    localhost:8080/api/activity/create
    Tipo: POST
    Lo que recibe la api :
        {
            "title": "Prueba titulo",
            "description" : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
            "idCategory": 1,
            "idUser": 11
        }

    Respuesta: 
        Si lo ha insertado en la BD: 
            {
                "ok": true
            }
        Si no lo ha insertado en la BD:
            {
                "ok": false
            }

## RECUPERAR ACTIVIDADES CON BUSQUEDA
    localhost:8080/api/activity/findall
    Tipo: GET
    Lo que puede recibir la api para la busqueda con filtros:
        {
            "category" : 1,
            "province": "01",
            "city": "051",
            "search": "texto"
        }

## ACTIVIDAD
    localhost:8080/api/activity/find/1
    Tipo: GET
    Devuelve los datos de una actividad

## LISTADO DE CATEGORIAS PARA EL DESPLEGABLE DEL BUSCADOR
    localhost:8080/api/category/getList
    Tipo: GET

## ACTUALIZAR CONTRASEÑA
    localhost:8080/api/user/updatepass
    Tipo: PUT
    Objeto que recibe la API : 
        {
            "id" : 14,
            "pass"  : "A123456a",
            "pass1" : "A123456aa",
            "pass2" : "A123456aa"
        }


## SOLICITAR ACTIVIDAD
    localhost:8080/api/requests/request
    Tipo: POST
    Objeto que recibe la API:
        {
            "idUser" : 4,       // ESTE ID ES EL DEL QUE SOLICITA LA ACTIVIDAD
            "idActivity" : 2,
            "idState" : "P"
        }

## ACTUALIZAR ESTADO DE LA ACTIVIDAD
    localhost:8080/api/requests/update
    Tipo: POST
        Objeto que recibe la API:   ( EL ID DE LA SOLICITUD Y EL ESTADO AL QUE SE QUIERE ACTUALIZAR )
        {
            "id" : 4,
            "idState" : "A"
        }

## OBTNENER LISTADO DE SOLICITUDES REALIZADAS A OTROS USUARIOS
    localhost:8080/api/requests/getRequests/$1   ( el parametro de la URL, es el id del usuario logado )
    Tipo: GET

## OBTENER LAS SOLICITUDES QUE SE HAN REALIZADO AL USUARIO LOGADO
    localhost:8080/api/requests/getRequestsByactivities/$1    ( el parametro de la URL, es el id del usuario logado )
    Tipo: GET

    

