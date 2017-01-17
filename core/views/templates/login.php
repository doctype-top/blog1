<?php
    var_dump($model->getErrors());
?>
<h2>Login</h2>
<form method="post">
    <input type="text" name="login" value="<?= (\library\Request::isPost()) ? $model->login : '';?>"><br>
    <input type="password" name="password"><br>
    <button type="submit">Login</button>
</form>
