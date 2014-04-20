<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form-group">
    <label for="userfname">First Name</label>
    <?php
    
 $autocomplete = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'createuserfname',
	'value'=>$model->f_name,
//	'source'=>$people, // <- use this for pre-set array of values
	'source'=>$this->createUrl('manager/getNames'),// <- path to controller which returns dynamic data
	// additional javascript options for the autocomplete plugin
        
	'options'=>array(
            'showAnim'=>'fold',
		'minLength'=>'1', // min chars to start search
            'response'=>'js:function( event, ui ) {
                       
                    }',
            'select'=>'js:function(event, ui) { 
                        event.preventDefault();
                        console.log(1 +":"+ui.item.f_name); 
                        
                        $("#createuserfname").val(ui.item.f_name);
                        console.log("CHANGE");
                    }'
	),
        
	'htmlOptions'=>array(
		'id'=>'createuserfname',
		'rel'=>'val',
	),
));?>
    <input type="text" class="form-control" id="createfname" placeholder="First Name">
</div>
<div class="form-group">
    <label for="userlname">Last Name</label>
    <input type="text" class="form-control" id="createlname" placeholder="Last Name">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="createusername" placeholder="Username">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="createpassword" placeholder="Password">
</div>          