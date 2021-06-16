<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index($user)
    {
        $user = $this->UsersModel->where('username', $user)->get()->getRowArray();
        $posts = $this->PostsModel->where('author', $user['id_user'])->get()->getResultArray();
        $total_post = $this->PostsModel->where('author', $user['id_user'])->countAllResults();

        $data = [
            'title' => '@' . $user['username'] . ' - InstaApp',
            'user'  => $user,
            'posts' => $posts,
            'total' => $total_post
        ];
        return view('users/v_profile/index', $data);
    }

    public function form_upload()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {

            $msg = [
                'sukses' => view('users/v_profile/upload')
            ];

            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function doupload()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'foto' => [
                    'label' => 'Foto User',
                    'rules' => 'uploaded[foto]|max_size[foto, 1024]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'uploaded'  => '{field} belum diupload',
                        'max_size'  => 'Ukuran {field} Melebihi 1 MB',
                        'mime_in'   => 'File yang diupload harus gambar!',
                        'is_image'  => 'File yang diupload harus gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'foto' => $validation->getError('foto')
                    ]
                ];
            } else {
                $filegambar = $request->getFile('foto');
                $simpandata = [
                    'foto_post'     => $filegambar->getName(),
                    'deskripsi'     => $request->getVar("deskripsi"),
                    'author'        => $this->session->get('user_id'),
                    'created_at'    => date('Y-m-d H:i:s')
                ];

                $this->PostsModel->insert($simpandata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(800, 533, 'center')
                    ->save('images/posts/thumb/' . 'thumb_' .  $filegambar->getName());
                $filegambar->move('images/posts');
                $msg = [
                    'sukses' => 'Gambar berhasil diupload!'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function view_post()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {

            $id = $request->getVar('id');
            $row = $this->PostsModel->join('users', 'users.id_user = posts.author')->where('id_post', $id)->get()->getRowArray();
            $id_user = $this->session->get('user_id');
            $cek_like = $this->LikesModel->where('id_post', $id)->where('id_user', $id_user)->countAllResults();

            $data = [
                'id'            => $row['id_post'],
                'foto'          => $row['foto_post'],
                'deskripsi'     => $row['deskripsi'],
                'author'        => $row['username'],
                'created_at'    => $row['created_at'],
                'foto_user'     => $row['foto'],
                'cek_like'      => $cek_like
            ];

            $msg = [
                'sukses' => view('users/v_profile/view', $data)
            ];

            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }
}
