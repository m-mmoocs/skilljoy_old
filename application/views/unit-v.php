<?php 
//$this->smrke->debug($unit);

?>

<h2 class="unit-title"><?php echo ucwords($unit->title); ?></h2>
<p  class="unit-description"><?php echo ucfirst($unit->description); ?></p>
<div class="unit-materials">
    <?php foreach($unit->materials as $m): ?>
    <a target="_blank" href="<?php echo $m->content; ?>"><?php echo $m->content; ?></a><br>
    <?php endforeach; ?>
</div>