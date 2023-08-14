<?php
class Note{

    private $table = 'note';
    private $conection;
    //Constructor vacio
    public function __construct()
    {  
    }

    /**Obtener conection */
    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }//Cierre del getConection

    /**Obtener todas las notas */
    public function getNotes()
    {
        $this->getConection();
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
    return $stmt->fetchAll();
    }//Fin de mi funcion de obtener notas

    /**Obtener notas por ID */
    public function getNoteById($id)
    {
        if (is_null($id)) return false;

        $this->getConection();
        $sql = "SELECT * FROM " . $this->table . "WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }//Fin de mi funcion de obtener notas por id

/*Funcion guardar o save note */
    public function save($param)
    {
        $this->getConection();
        /*Set default values */
        $title = "";
        $content = "";

        /*Revisar si existe */
        $exists = false;
        if (isset($param["id"]) and $param["id"] !='') {
            $actualNote = $this->getNoteById($param["id"]);
            if (isset($actualNote["id"])) {
                $exists = true;
                /*Valores actuales */
                $id = $param["id"];
                $title = $actualNote["title"];
                $content = $actualNote["content"];
            }
        } //Fin de la revision si existe

            /**Recibir valores */
            if (isset($param["title"]))
                $title = $param["title"];

            if (isset($param["content"]));
                $content = $param["content"];
        
        /* Operacion en la base de datos */
        if ($exists) {
            //EDITAR
            $sql = "UPDATE " . $this->table . " SET title=?,content=? WHERE id = ?";
            $stmt = $this->conection->prepare($sql);
            $res = $stmt->execute([$title, $content, $id]);
        } else {
            //REGISTRAR o INSERTAR
            $sql = " INSERT INTO " . $this->table . "(title,content) Values (?,?)";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$title, $content]);
            $id = $this->conection->lastInsertId();
        }//Cierre de mi funcion insertar
        return $id;
    }//Cierre de llaves de mi funcion guardar notas

    public function deleteNoteById($id)
    {
        $this->getConection();
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        return $stmt->execute([$id]);
    }
}//Fin de mi clase note