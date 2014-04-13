<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container-fluid">
    <div >
        <div id="content">
            <div class="row">
                <div class="col-sm-12 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li><?php echo CHtml::link('Dashboard', array('manager/dashboard')); ?></li>
                        <li><?php echo CHtml::link('Human Resources', array('manager/hr')); ?></li>
                        <li><?php echo CHtml::link('Inventory', array('manager/inventory')); ?></li>
                    </ul>
                </div>
                <div class="col-sm-10 col-md-8 main">
                    <?php echo $content; ?>

                </div>
            </div>
        </div>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>
<div class="row">
