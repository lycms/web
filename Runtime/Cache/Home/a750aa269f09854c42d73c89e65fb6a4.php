<?php if (!defined('THINK_PATH')) exit(); if(!empty($config['type'])){ ?>
<div class="change-link">
    <label>第三方账号登陆</label>  
    <br>
    <?php if(in_array('Weixin',$config['type'])): ?>
                <a class="btn btn-default" style="color:#44b549" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0;width=100');return false" href="<?php echo addons_url('SyncLogin://Login/login', array('type'=>'weixin')); ?>">
                    <i class="am-icon-weixin am-icon-md"></i>微信登陆
                </a>
        <?php endif; ?>
        <?php if(in_array('Qq',$config['type'])): ?>
                <a class="btn btn-default" style="color:#12b7f5" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0;width=100');return false" href="<?php echo addons_url('SyncLogin://Login/login', array('type'=>'qq')); ?>">
                    <i class="am-icon-qq am-icon-md"></i>QQ登陆
                </a>
        <?php endif; ?>
        <?php if(in_array('Sina',$config['type'])): ?>
                <a class="btn btn-default" style="color:#F30002" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0;width=100');return false" href="<?php echo addons_url('SyncLogin://Login/login', array('type'=>'sina')); ?>">
                    <i class="am-icon-weibo am-icon-md"></i>新浪登陆
                </a>
        <?php endif; ?>
        <?php if(in_array('Renren',$config['type'])): ?>
                <a class="btn btn-default" style="color:#1965B5" onclick="window.open(this.href,'_blank','scrollbars=0,resizable=0;width=100');return false" href="<?php echo addons_url('SyncLogin://Login/login', array('type'=>'renren')); ?>">
                    <i class="fa fa-renren"></i>人人登录
                </a>
    <?php endif; ?>
</div>
<?php } ?>