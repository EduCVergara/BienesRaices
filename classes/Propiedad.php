<?php

namespace App;

class Propiedad {

    // BD
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    // Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    
    // Definición de la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? 1;
    }

    public function guardar() {
        // Sanitizar datos
        $atributos = $this->sanitizarDatos();


        // Insertar en la base de datos
        // Manera tradicional
        // $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) 
        // VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id')";
        // Manera mejorada:
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Identificar y unir atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Validación
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "La propiedad debe tener un <strong>título</strong>";
        }

        if(!$this->precio) {
            self::$errores[] = "La propiedad debe tener un <strong>precio</strong>";
        }

        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La propiedad debe tener una <strong>descripcion</strong>, y debe tener al menos 50 caracteres para más posibilidades de venta";
        }

        if(!$this->habitaciones) {
            self::$errores[] = "La propiedad debe tener <strong>habitaciones</strong>";
        }

        if(!$this->wc) {
            self::$errores[] = "La propiedad debe especificar cuantos <strong>baños</strong> tiene";
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "La propiedad debe especificar cuantos <strong>estacionamientos</strong> tiene";
        }

        if(!$this->vendedores_id) {
            self::$errores[] = "Debes elegir un  <strong>vendedor</strong>";
        }

        if(!$this->imagen) {
            self::$errores[] = "La propiedad debe contener una <strong>imagen</strong>";
        }

        return self::$errores;
    }

    public function setImagen($imagen) {
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id={$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); // la función array_shift de php retorna el primer elemento de un arreglo
    }

    public static function consultarSQL($query) {
        // Consultar la BD
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }
        
        // Liberar la memoria
        $resultado->free();
        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sync($args = []) {
        foreach($args as $key=> $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}