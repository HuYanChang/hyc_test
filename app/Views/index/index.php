<form>
    <input type="text" value="<?php echo $keyword?>" name="keyword">
    <input type="submit" value="搜索">
</form>

<p><a href="/manage">新建</a></p>

<table>
    <tr>
        <td>ID</td>
        <td>内容</td>
        <td>操作</td>
    </tr>
    <?php foreach ($indexs as $index):?>
        <tr>
            <td><?php echo $index['id'] ?></td>
            <td><?php echo $index['item_name'] ?></td>
            <td>
                <a href="/manage/<?php echo $index['id']?>">编辑</a>
                <a href="/delete/<?php echo $index['id']?>">删除</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>