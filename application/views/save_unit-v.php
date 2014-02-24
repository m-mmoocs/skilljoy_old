<h2>Add New Unit</h2>

<form action="" method="post">
    <br>
    <label for="title">Title: </label>
    <input type="text" name="title" value="<?php if (isset($_POST['title'])) echo ($_POST['title']); ?>">
    <?php if (isset($_POST['add_unit'])) echo form_error('title');?>
    <br><br>
    <label for="title">Description: </label>
    <textarea name="description" rows="5" cols="60"><?php if (isset($_POST['description'])) echo ($_POST['description']); ?></textarea>
    <br><br>
    <p>Materials:</p>
    <?php if (isset($_POST['add_unit'])) echo form_error('materials');?>
    <table>
        <tr><td>Title</td><td>Content</td></tr>
        <tr><td><input type="text" name="materials[0][title]" 
           value="<?php if (isset($_POST['materials'][0]['title'])) echo ($_POST['materials'][0]['title']); ?>"></td>
            <td><input type="text" name="materials[0][content]" 
           value="<?php if (isset($_POST['materials'][0]['content'])) echo ($_POST['materials'][0]['content']); ?>"></td>
            <?php if (isset($_POST['add_unit'])) echo form_error('materials[0][content]');?>
        </tr>
        <tr><td><input type="text" name="materials[1][title]" 
           value="<?php if (isset($_POST['materials'][1]['title'])) echo ($_POST['materials'][1]['title']); ?>"></td>
            <td><input type="text" name="materials[1][content]" 
           value="<?php if (isset($_POST['materials'][1]['content'])) echo ($_POST['materials'][1]['content']); ?>"></td>
            <?php if (isset($_POST['add_unit'])) echo form_error('materials[1][content]');?>
        </tr>
        <tr><td><input type="text" name="materials[2][title]" 
           value = "<?php if (isset($_POST['materials'][2]['title'])) echo ($_POST['materials'][2]['title']); ?>"></td>
            <td><input type="text" name="materials[2][content]" 
           value = "<?php if (isset($_POST['materials'][2]['content'])) echo ($_POST['materials'][2]['content']); ?>"></td>
            <?php if (isset($_POST['add_unit'])) echo form_error('materials[2][content]');?>
        </tr>
        
    </table>
    <br><br>
    <input type="submit" name="add_unit" value="Save">

</form>