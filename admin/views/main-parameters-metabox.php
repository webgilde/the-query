<?php require_once(THEQUERYBASEPATH . 'admin/includes/class-parameter-callbacks.php'); ?>
<?php $i = 1; $count = count($main_parameters); ?>
<?php foreach($main_parameters as $_parameter_id) : ?>
    <?php if (method_exists('The_Query_Admin_Parameter_Callbacks', $_parameter_id)) :
        $values = '';
        if (isset($this->params[$_parameter_id]['values']))
            $values = $this->params[$_parameter_id]['values'];
        The_Query_Admin_Parameter_Callbacks::$_parameter_id($values); ?>
        <?php if($i++ < $count) : ?></div><div class="inside"><?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
    <div class="clear"></div>