<?php foreach($this->param_groups as $_parameter_group_id => $_parameter_group) : ?>
<h4><?php echo $_parameter_group['name']; ?></h4>
    <?php if(is_array($_parameter_group['param_content'])) foreach($_parameter_group['param_content'] as $_param_id => $_param_content ) : ?>
        <div class="parameter-content"><?php echo $_param_content; ?></div>
    <?php endforeach; ?>
<?php endforeach; ?>
