<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if (!session('login')) {
			return redirect()->to(base_url('Auth'));
		}
		$posts = $this->PostsModel->join('users', 'users.id_user = posts.author')->where('author !=', $this->session->get('user_id'))->get()->getResultArray();

		$data = [
			'title' => 'InstaApp',
			'posts' => $posts,
			'LikesModel' => $this->LikesModel,
			'KomentarModel' => $this->KomentarModel
		];
		return view('users/v_home/index', $data);
	}
}
