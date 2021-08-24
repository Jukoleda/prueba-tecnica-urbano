<?php

spl_autoload_register(function ($filename) {
    if(file_exists($filename . '.php'))
         include $filename . '.php';
    
    if(file_exists('./controllers/' . $filename . '.php'))
         include './controllers/' . $filename . '.php';
    
     if(file_exists('./lib/database/' . $filename . '.php'))
          include './lib/database/' . $filename . '.php';

     if(file_exists('./models/' . $filename . '.php'))
          include './models/' . $filename . '.php';
 });

?>