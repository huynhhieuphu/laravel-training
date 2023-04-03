<form method="POST" action="<?= route('admin.category.handleAdd') ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="text" placeholder="Ten danh muc">
    <button type="submit">Add</button>
</form>
