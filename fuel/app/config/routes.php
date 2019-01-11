<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
    'users/view(/:id)?' => array('users/view'),
    'users/edit(/:id)?' => array('users/edit', 'id' => 'edit'),
    'users/add' => array('users/add', 'id' => 'add'),
);
