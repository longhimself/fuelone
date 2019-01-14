<?php

class Controller_Users extends Controller_Template
{

	public function action_index()
	{
        $config = array(
            'pagination_url' => 'users/index/',
            'total_items'    => Model_Users::count(),
            'per_page'       => 4,
//            'uri_segment'    => 3,
            // or if you prefer pagination by query string
            //'uri_segment'    => 'page',
        );

        $pagination = Pagination::forge('pagination', $config);

	    $users = Model_Users::query()
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->get();
	    $data = array('users' => $users, 'pagination' => $pagination);

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
        if(Input::post('submit')){
            $registration = new Model_Users();
            $registration->name = Input::post('name');
            $registration->email = Input::post('email');
            $registration->password = Input::post('password');
            $registration->save();
            \Fuel\Core\Session::set_flash('success', 'User registered');
            Response::redirect('/users');
        }
        return Response::forge(View::forge('users/add'));
    }
    public function action_edit($id)
    {
        $registration = Model_Users::find($id);
        if(Input::post('submit')){
            $registration->name = Input::post('name');
            $registration->email = Input::post('email');
            $registration->password = Input::post('password');
            $registration->save();
            \Fuel\Core\Session::set_flash('success', 'User registered');
            Response::redirect('/users');
        }
        $data = array('user' => $registration);
        return Response::forge(View::forge('users/edit', $data));
    }
    public function action_delete($id)
    {
        $elimination = Model_Users::find($id);
        $elimination->delete();
        Session::set_flash('success', 'User removed');
        return Response::redirect('/users');
    }
}
