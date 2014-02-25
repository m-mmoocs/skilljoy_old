<?php 

?>

<h2 class="unit-title"><?php echo ucwords($unit->title); ?></h2>
<p  class="unit-description"><?php echo ucfirst($unit->description); ?></p>
<hr>
<div class="unit-materials">
    <!-- only shows primary materials -->
    <?php foreach($unit->materials as $m): ?>
    <?php   
            if($m->primary_mat == 1)
            {
                $this->load->model('materials_m');
                $url = $this->materials_m->get_materials_with_id($m->id);
                $url = $url[0];

                //$this->smrke->debug($url);
                
                if ($m->content_type == 1) // -------- if it's a youtube video id
                {
                    $this->load->view('materials/youtube-v', $m);
                }
                elseif ($m->content_type == 2) // -------- if it's a pdf URL
                {
                    $this->load->view('materials/pdf-v', $url);
                }
                elseif ($m->content_type == 3) // -------- if it's a vimeo URL
                {
                    $this->load->view('materials/vimeo-v', $url);
                }
                else 
                    echo '<a target="_blank" href="'. $this->load->helper('url') . prep_url($m->content). '>';
                } ?>
            </a><br />
    <?php endforeach; ?>


<!-- use to show the links for supportive materials-->
 <?php foreach($unit->materials as $m): ?>
  <?php 
    if($m->primary_mat == 0)
    {
        if ($m->content_type == 4) :          // if this is a webpage, then just insert URL?>
        <a target="_blank" href="<?php $this->load->helper('url'); echo prep_url($m->content); ?>">
        <?php else:                                 // otherwise send to controller to check which view to use?>
        <a target="_blank" href="<?php echo base_url('units/show_link/'.$m->id); ?>">
        <?php endif;?>    
        <?php                                   // show a title if one was set, or just use the content as title
            if (isset($m->title) && strlen($m->title) > 2) {echo $m->title;}
            else {echo $m->content; } 
    } ?></a><br>
    <?php endforeach; ?>
</div>