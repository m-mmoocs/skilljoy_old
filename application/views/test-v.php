<?php
echo ('Testing output page<br><hr><br>');
if (isset($input))
{echo ('<br>Original input: ' . $input);}

if (isset($output['content_type']))
{echo('<br>Detected type: ' . $output['content_type']);}
else
{echo('<br>No content type detected!');}    
if (isset($output['content']))
{echo('<br>Resulting output: ' . $output['content']);}
else
{echo('<br>No valid content detected! (Possible invalid URL)');}    

    

echo ('<br><hr><br>End output page');


?>
<br><br>
Enter URL to test video format:
<br>
(pdf testing still appears buggy)
<br>

<form action="<?php echo base_url('test/testurl'); ?>" method="post">
<input type="text" name="input">
<input type="submit" name="testURL" value="testURL">
</form>

