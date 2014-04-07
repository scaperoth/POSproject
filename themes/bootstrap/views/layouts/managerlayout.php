<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container-fluid">
    <div >
        <div id="content">
            <div class="row">
                <div class="col-sm-12 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="dashboard">Overview</a></li>
                        <li><a href="hr">Human Resources</a></li>
                        <li><a href="inventory">Inventory</a></li>
                    </ul>
                </div>
                <div class="col-sm-10 col-sm-offset-1  col-md-8 col-md-offset-0 main">
                    <?php echo $content; ?>

                </div>
            </div>
        </div>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>
<div class="row">
