<?=get('message');?>

<?php
    $user = find('user', 'id', $_GET['id']);
?>

<form action="/pages/forms/update_user.php" method="POST" role="form">
    <legend>Editar cadastro</legend>

    <div class="form-group">
        <label for="">Nome</label>
        <input type="text" class="form-control" name="name" placeholder="Input field" value="<?=$user->name;?>">
    </div>

    <input type="hidden" name="id" value="<?=$user->id;?>">

    <div class="form-group">
        <label for="">Sobrenome</label>
        <input type="text" class="form-control" name="sobrenome" placeholder="Input field" value="<?=$user->sobrenome;?>">
    </div>

    <div class="form-group">
        <label for="">E-mail</label>
        <input type="email" class="form-control" name="email" placeholder="Input field" value="<?=$user->email;?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
