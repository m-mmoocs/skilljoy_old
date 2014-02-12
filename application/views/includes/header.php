<?php if($this->m_user && $this->m_user->status()==='active'): ?>
    <div id="user-box">
        Hello <?php echo $this->m_user->Data('firstname'); ?>
    </div>

<?php else: ?>
    <?php if($p!=='login'): ?>
    <div id="login-box">
        <a href="<?php echo base_url('users/login'); ?>">Login to site</a>
    </div>
    <?php endif; ?>

<?php endif; ?>


