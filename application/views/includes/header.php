<?php if($this->m_user && $this->m_user->status()==='active'): ?>
    <div id="user-box">
        Hello <?php echo $this->m_user->Data('firstname'); ?>
    </div>

<?php else: ?>
    <?php if($p!=='login'): ?>
    
    <?php endif; ?>

<?php endif; ?>