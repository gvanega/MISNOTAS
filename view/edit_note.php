<?php
    $id = $title = $content = "";

    if(isset($dataToView["data"]["id"]))
    $id = $dataToView["data"]["id"];

    if(isset($dataToView["data"]["title"]))
    $title = $dataToView["data"]["title"];

    if(isset($dataToView["data"]["content"]))
    $content = $dataToView["data"]["content"];
?>

<div class="row">
    <?php
    if (isset($_GET["response"]) and $_GET["response"] === true) {
        ?>
    <div class="alert alert-success">
        Operacion realizada correctamente. <a href="index.php?controller=note&action=list">Volver al listado</a>
    </div> <?php  }    ?>

    <!-- Creacion del formulario -->
    <form action="index.php?controller=note&action=save" class="form" method="POST">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label>Titulo</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" />
        </div>
        <div class="form-group">
            <label>Contenido</label>
            <textarea name="content" class="form-control" rows="5"><?php echo $content; ?></textarea>
        </div>
        <input type="submit" value="Guardar" class="mt-2 btn btn-primary" />
        <a href="index.php?controller=note&action=list" class="mt-2 btn btn-outline-warning">Cancelar</a>
    </form>
</div>