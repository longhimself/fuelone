<?php

class Controller_Users extends Controller_Template
{

	public function action_index()
	{
	    $users = Model_Users::find('all');
	    $data = array('users' => $users);
        return Response::forge(View::forge('users/index', $data, false));
	}
    public function action_view($id)
    {
        $user = Model_Users::find('first', array(
            'where' => array(
                'id' => $id
            )
        ));
        $data = array('user' => $user);
         return Response::forge(View::forge('users/view', $data, false));
    }
    public function action_add()
    {
        echo 'user add';
        return Response::forge(View::forge('users/add'));
    }
    public function action_edit()
    {
        echo 'user view';
        return Response::forge(View::forge('users/edit'));
    }
}
