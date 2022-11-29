## REGISTRO NUEVO USUARIO
    http://localhost:8080/api/user/create
    Tipo : post
    Json que recibe la api: {
                               "email": "amaia@correo.com",
                               "pass": "ASdfgh123"
                            }
    Respuesta: Si hace registro devuelve StatusCode 200
               Si no hace el registro devuelve StatusCode 400

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
                    
