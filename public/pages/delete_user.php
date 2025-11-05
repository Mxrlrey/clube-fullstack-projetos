<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$deletado = delete('user', 'id', $id);

if ($deletado){
    flash('message', "Deletado com sucesso!", 'success');
    redirectToHome();
}

flash('message', "Erro ao deletar!");
redirectToHome();