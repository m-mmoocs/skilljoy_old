<h2>Units</h2>

<?php foreach($units as $u): ?>
    <div class="unit_stub">
        <a href="<?php echo base_url('units/show/'.$u->id); ?>"><?php echo $u->title; ?></a>
    </div>
<?php endforeach; ?>

<br>
<a href="<?php echo base_url('units/save_unit'); ?>" >Add Unit</a>
