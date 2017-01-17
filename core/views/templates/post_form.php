<?php
?>

<form method="post">
    <input type="text" name="title" value="<?= (!empty($model->title)) ? $model->title : ''?>">
    <input type="submit">
</form>
