<form action="<?php echo route('store.product') ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div>
        Name: <input type="text" name="product[][name]" value="Iphone 14 pro max">
        Price: <input type="text" name="product[0][price]" value="19000000">
    </div>

    <div>
        Name: <input type="text" name="product[][name]" value="Iphone 13 pro max">
        Price: <input type="text" name="product[1][price]" value="15000000">
    </div>
    <br>
    <div>
        <button type="submit">Cart</button>
    </div>

</form>
