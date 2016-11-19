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
 			
            
##-----------------------------------------------------------------------------------------------------------------------
SELECT id AS user_id ,NAME,email,admin,co_sucu,co_vendedor,nombre,apellido,activo,last_sync,PASSWORD,created_at,updated_at,deleted_at
       FROM users
       WHERE email = 'instalador@email.com';
## En los mensajes retornado esta:
## Usuario inactivo  --> users.activo = 0       
## Usuario o Clave incorrecta.  (al ingresar la clave o el usuario incorrecto)

## Roles y permisos del usuario
SELECT  r.name AS name_role, r.display_name AS des_role,
       p.name AS name_permission
FROM roles AS r
INNER JOIN permission_role AS pr
ON pr.role_id = r.id
INNER JOIN permissions AS p 
ON pr.permission_id = p.id 
INNER JOIN role_user AS rl
ON r.id = rl.user_id
INNER JOIN users 
ON users.id = rl.user_id
WHERE users.id = '1';    


## Dependiendo de la configuarion activa mostrara los horarios
SELECT a.id AS syn_conf_id,a.NAME AS tipo_sync, a.activo,b.`hora_sync`
FROM `sync_config` AS a
LEFT JOIN   sync_horas AS b
ON  a.`id` = b.`sync_id`
WHERE a.activo = 1;

Queria retornar la informacion de estas tres consultas en un solo QUERY, pero se me hizo
dificil hacerlo en un solo QUERY.
#####################################################################################################

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
                                token ,clientes.co_vendedor, last_sync

                Recibe
                    SELECT co_cli,co_vendedor,co_zona,co_segmento,tipo,rif,activo,email,descripcion,direccion,
		            direc_entre,telefono,created_at,updated_at,deleted_at
                    FROM clientes 
                    WHERE clientes.co_vendedor ='RM';
                    
                NUEVO REGISTRO
                Envia           
                                token ,co_vendedor,co_sucursal,activo, last_sync
                Recibe
                                De ser satisfactoria.
                                Id del nuevo usuario, mensaje.
                                De ser rechazada.
                                Mensaje de error.
                ACTUALIZACION
                Envia    
                                token ,co_vendedor,co_sucursal,activo, last_sync. campos a actualizar
                Recibe
                                Mensajes de validacion o actualizacion satisfactoria.
 
                BORRAR CLIENTE
                Envia     
                                token ,Id del nuevo usuario, co_usuario
                                En esta parte solo inactiva clientes, actualizando el campo activo = 1
                                y el campo deleted_at.
                Recibe
                                De ser satisfactoria.
                                Mensaje de haberse completado la accion.
                                De ser rechazada.
                                Mensaje de error.





