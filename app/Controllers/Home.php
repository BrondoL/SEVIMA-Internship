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

	public function fetch_komen($id)
	{
		$request = \Config\Services::request();
		// if ($request->isAJAX()) {
		$data = [
			'komen' => $this->KomentarModel->join('users', 'users.id_user = komentar.id_user')->where('id_post', $id)->get()->getResultArray()
		];
		$msg = [
			'data' => view('users/v_home/komen', $data)
		];

		echo json_encode($msg);
		// } else {
		// 	exit(view('errors/html/error_404'));
		// }
	}
}
