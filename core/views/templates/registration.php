<?php
    $errors = $model->getErrors();
    if(!empty($errors)){
        var_dump($errors);
    }
?>

<form method="post">
    <input type="text" name="login" value="<?= (\library\Request::isPost()) ? $model->login : ''?>"><br>
    <input type="password" name="password"><br>
    <input type="password" name="password_confirm"><br>
    <input type="submit">
</form>
