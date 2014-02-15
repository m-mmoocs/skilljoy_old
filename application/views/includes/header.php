<a href="<?php echo base_url(); ?>" id="site-logo" class="floatLeft" >Skilljoy</a>
<div id="user-box" class="floatRight">
<?php if($this->user && $this->user->status()==='active'): ?>
    <div id="">Hello <?php echo $this->user->Data('firstname'); ?></div>
    <a href="<?php echo base_url('users/logout'); ?>">Logout</a>
<?php else: ?>
    <?php if($p!=='login'): ?>
    <div id="login-box">
        <a href="<?php echo base_url('users/login'); ?>">Login to site</a>
    </div>
    <?php endif; ?>
<?php endif; ?>
</div>

