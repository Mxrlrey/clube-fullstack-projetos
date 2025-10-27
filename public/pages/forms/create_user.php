<?php

require '../../../bootstrap.php';

if (isEmpty()) {
    flash('message', 'Preencha todos os campos!');
    return redirect("create_user");
}

$validate = validate([
    'name' => 's',
    'sobrenome' => 's',
    'email' => 'e',
    'password' => 's'
]);

$cadastrado = create('user', $validate);

if($cadastrado){
    flash('message', 'Cadastrado com sucesso!', 'success');
    return redirect("create_user"); 
}
flash('message', 'Erro ao cadastrar usuario.');
return redirect("create_user");