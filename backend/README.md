## REGISTRO NUEVO USUARIO
    datos del formulario requeridos: email, contraseña

    valida que el email no esté registrado, y tenga el formato adecuado
    valida que la contraseña min. 8 caracteres, una mayúscula, una minúscula, y un número
    valida que el nombre tenga mínimo 2 caracteres

    guarda la contraseña encriptada con md5

    librería phpmailer para enviar un email y así verificar el correo de nuevo usuario

    Enviar email con la url que verifica el email. Se genera un codigo único ( activacion_codigo ) que será el que se verifica que corresponda a ese usuario
    URL verificar email

## LOGIN
    Comprueba si existe el email, si existe comprueba que la contraseña sea correcta y comprueba si su email lo ha verificado a través del enlace de su correo.


    



