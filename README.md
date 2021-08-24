Autor: David Martinez

Construido sobre WAMPSERVER 3.2.3, Windows 10 64bits

Base de datos: MySQL 5.7.31
Version de PHP: 7.3.21

Notas:
-Se puede mejorar el routeo a traves de una clase router la cual deberia hacer las llamadas que se filtran en los controladores.
-Se puede mejorar el dialog de eliminacion de grupos y clientes hacia algo mas agradablemente visual.
-No se utiliza doctrine ni docker debido a la insuficiente experiencia en dichas herramientas, esto era sabido con antelacion por el señor Rodolfo.
-Para el despliegue de la base de datos se debe utilizar el archivo 'urbano_db.sql' dentro de la carpeta 'database'
-El directorio raiz de la aplicacion es 'clientes_urbano'