<form method="POST" action="<?= route('admin.category.handleUpdate') ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="text" placeholder="Ten danh muc" value="<?php echo $idCategory; ?>" >
    <button type="submit">Update</button>
</form>
