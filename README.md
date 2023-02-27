#  MVC

En este documento redactare la funcionalidad, ademas del como se usa el proyecto en turno, el cual consta de una pagina en la cual se pueden insertar productos, relacionados a una categoria, y a su respectivo proveedor.

## Funcionalidad

La pagina consta de diferentes vistas, teniendo como primera el inicio de sesion, donde mediante un correo y contraseña, se podra acceder al sitio y asi utilizar el sistema, ademas en la anterior, tambien se muestra la tabla de productos que se estan insertados en la base de datos, teniendo arriba de la misma, un espacion en el cual se puede busvcar el producto que se desee, ademas de un boton el cual activa la busqueda previamente escrita.

## Uso
Este proyecto es usado con la finalidad de insertar, modificar, eliminar o buscar productos en la pagina misma.

### ¿Como se puede ejecutar el proyecto?

Habiendo descargado el archivo de nombre "productos_actualizado.rar" este se descomprimira, teniendo como resultado los archivos designados como "bd" carpeta donde se encuentra la conexion a la base de datos, el siguiente es el controlador, donde contiene los archivos que manejan el control de la oagina como por ejemplo, las acciones realizadas en el sistema, el siguiente es el modelo, donde se tiene el archivo que mantiene la conexion a la base de datos designada, tenemos tambien las validaciones, ademas de la vista, el cual mantiene el archivo en el que se almacena la vista del sistema, finalmente el archivo de iniciar y cerrar sesion. 

Al tener esto listo, abrimos nuestro xampp y activamos el servicio Apache y MySQL, acto seguido entramos a PhPMyAdmin donde crearemos una base de datos llamada "aw2022" e importaremos la misma. Despues vamos a arrastrar la carpeta del proyecto, que contiene todos los archivos antes mencionados, a la carpeta htdocs, la cual esta ubicada en la carpeta xampp y ahi se encuentra la antes mencionada, al hacer estos pasos podemos poner en nuestro navegador la siguiente ruta...
http://localhost/productos_actualizado/index.php
y asi podremos hacer uso del proyecto.

