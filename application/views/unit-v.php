<?php 

?>

<h2 class="unit-title"><?php echo ucwords($unit->title); ?></h2>
<p  class="unit-description"><?php echo ucfirst($unit->description); ?></p>
<hr>
<div class="unit-materials">
    <?php foreach($unit->materials as $m): ?>
    <?php if ($m->content_type == 4) :          // if this is a webpage, then just insert URL?>
    <a target="_blank" href="<?php $this->load->helper('url'); echo prep_url($m->content); ?>">
    <?php else:                                 // otherwise send to controller to check which view to use?>
    <a target="_blank" href="<?php echo base_url('content/show/'.$m->id); ?>">
    <?php endif;?>    
        <?php                                   // show a title if one was set, or just use the content as title
        if (isset($m->title) && strlen($m->title) > 2) {echo $m->title;}
        else {echo $m->content; }
        ?></a><br>
    <?php endforeach; ?>
</div>