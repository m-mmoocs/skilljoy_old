<h2>Add New Unit</h2>

<form action="" method="post">
    <br>
    <label for="title">Title: </label>
    <input type="text" name="title" >
    <br><br>
    <label for="title">Description: </label>
    <textarea name="description" rows="5" cols="60"></textarea>
    <br><br>
    <p>Materials:</p>
    
    
    <table>
        <tr><td>Title</td><td>Content</td></tr>
        <tr><td><input type="text" name="materials[0][title]" ></td>
            <td><input type="text" name="materials[0][content]" ></td>
        </tr>
        <tr><td><input type="text" name="materials[1][title]" ></td>
            <td><input type="text" name="materials[1][content]" ></td>
        </tr>
        <tr><td><input type="text" name="materials[2][title]" ></td>
            <td><input type="text" name="materials[2][content]" ></td>
        </tr>
    </table>
    <br><br>
    <input type="submit" name="add_unit" value="Save">
</form>