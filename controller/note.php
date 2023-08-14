<?php
require_once 'model/note.php';

class noteController{
    public $page_title;
    public $view;

    public function __construct()
    {
        $this->view = 'list_note';
        $this->page_title = '';
        $this->noteobj = new Note();
    }//Cierre del constructor

    /*Listando todas las notas */
    public function list()
    {
        $this->page_title = 'Listado de notas';
         return $this->noteobj->getNotes();
    }

    // Cargar notas para editar
    public function edit($id = null)
    {
        $this->page_title = 'Editar Notas';
        $this->view = 'edit_note';

        if (isset($_GET["id"])) $id = $_GET["id"];
        return $this->noteobj->getNoteById($id);

    }//Cierre de funcion para cargar y editar notas

    //Crear Notas
    public function save()
    {
        $this->view = 'edit_note';
        $this->page_title = 'Guardar Notas';
        $id = $this->noteobj->save($_POST);
        $result = $this->noteobj->getNoteById($id);
        $_GET["response"] = true;
        return $result;
    }//Cierre de funcion de guardado de notas

    /**Confirmar eliminacion */
    public function confirmDelete()
    {
        $this->page_title = 'Eliminar nota';
        $this->view = 'confirm_delete_note';
        return $this->noteobj->getNoteById($_GET["id"]);
    }
    /**ELIMINAR */
    public function delete()
    {
        $this->page_title = 'Listado de notas';
        $this->view = 'delete_note';
        return $this->noteobj->deleteNoteById($_POST["id"]);   
    }
}//Fin del noteController
?>