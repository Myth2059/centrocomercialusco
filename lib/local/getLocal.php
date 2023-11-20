<?php 

function getLocal($id){  
        $host = '127.0.0.1';
        $nombre_bd = 'centrocomercial';
        $usuario_bd = 'root';
        $contraseña_bd = '';
        
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);
        
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
          
            $stmt = $pdo->prepare("SELECT locales.id, locales.nombre as nombreLocal, locales.ubicacion,locales.categoria,locales.estado,locales.subcategoria,locales.imgurl,locales.usuarios_cedula,locales.id,usuarios.nombre,usuarios.apellido,usuarios.telefono FROM locales INNER JOIN usuarios on locales.usuarios_Cedula = usuarios.cedula where locales.id = ?");
            $stmt->execute([$id]);
        
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
           return $resultados;
        
        } catch (PDOException $e) {
        echo $e;
        }
        }



?>