<h1>Danh sách danh mục</h1>

<form method="POST" action="<?= route('admin.category.delete') ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <button type="submit">Delete</button>
</form>
