<form action="<?php echo $postUrl;?>" method="post">
    <?php if(isset($index['id'])):?>
        <input type="hidden" name="id" value="<?php echo $index['id']?>">
    <?php endif;?>
    <input type="text" name="value" value="<?php echo isset($index['item_name']) ? $index['item_name'] : '' ?>">
    <input type="submit" value="提交">
</form>