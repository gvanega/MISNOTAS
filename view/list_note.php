<div class="row">
    <div class="col-md-12">
        <a href="index.php?controller=note&action=edit" class="btn btn-outline-primary">Crear Nota</a>
        <hr>
    </div>
    <!-- Las Card -->
    <?php
    if(count($dataToView["data"])>0){
        foreach($dataToView["data"] as $note){
            ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body border border-secondary rounded">
                        <h5 class="card-tittle"><?php echo $note['title']; ?></h5>
                        <div class="card-text"><?php echo nl2br ($note['title']); ?></div>
                        <hr class="mt-1">

                        <a href="index.php?controller=note&action=edit&id=<?php echo $note['id'];?>" class="btn btn-success">Editar</a>
                        <a href="index.php?controller=note&action=confirmDelete&id=<?php echo $note['id'];?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        <?php }
    }else { ?>
    <div class="alert alert-info">
        Actualmente no existen notas
    </div>
        <?php
    }
    ?>
</div><!-- Fin del ROW -->