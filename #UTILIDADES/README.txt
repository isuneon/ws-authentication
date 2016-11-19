CRITERIOS PARA REALIZAR EL SERVICIO WEB
-          Framework LARAVEL.
-          Todos las repuestas deben ser en formato .JSON
-          Usar Token de seguridad para la autenticación y uso de los WS. 
           Para cualquier operación debe enviarse el token. 
           De no enviar un token valido la respuesta será denegada.
-          Validaciones, todos los servicios deben validar los tipos de datos, longitudes, exepciones.
 
WS 1 –  AUTENTICACION DE USUARIO. (Log IN)
  Envia               
-          Email.
-          Contraseña.

Recibe
-          Token.
-          Nombre.
-          Apellido.
-          Email.
-          Activo.
-          co_usuario 
-          co_vendedor.
-          Rol.
-          Permisos.
-          Ultima actualizacion 
-          Horas de syncronizacion automatica. 
-          Metodo de sync
-          Ultima conexion del usuario.
 			
LOG OUT
Envia 
-          Token
-          Email.
Recibe
-          Mensaje satisfactorio.
	   La sesion caduca y termina con el token.
  

WS 2   - passsword reset
Para este Caso 
Envia
              Email.
Recibe 
-          Mensaje “Revise su email”

           De existir en la tabla users se le envia un email  a su direccion de correo, con un codigo de verificacion              
             se crea un codigo d verificacion aleatorio, se envia por email al usuario y se guarda en el campo  "user.security_code" este codigo tendra un tiempo de validez.
 
-          Mensaje “Correo invalido”
           De ser invalido el email.
 
 
Con el codigo recibido. Podra enviar su nueva contraseña.
Envia

		- codigo de verificacion
		- contraseña.
		- repetir contraseña.

Recibe
                Mensaje de respuesta de la solicitud.
		satisfactorio o no.


WS 3. -  Clientes. (CRUD)
                Para realizar cualquiera de estas acciones debe enviarse el token de autenticacion
                CONSULTA
                Envia
                                token ,Codigo de vendedor,co_sucursal,activo, last_sync.

                Recibe
                                Clientes.
                NUEVO REGISTRO
                Envia
                               
                                token ,Codigo de vendedor,co_sucursal,activo...
                Recibe
                                De ser satisfactoria.
                                Id del nuevo usuario, mensaje.
                                De ser rechazada.
                                Mensaje de error.
                ACTUALIZACION
                Envia    
                                token ,Codigo de vendedor,co_sucursal,activo, last_sync.
                Recibe
                                Clientes.
 
                BORRAR CLIENTE
Envia     
                                token ,Id del nuevo usuario, co_usuario
                Recibe
                                De ser satisfactoria.
                                Mensaje de haberse completado la accion.
                                De ser rechazada.
                                Mensaje de error.





