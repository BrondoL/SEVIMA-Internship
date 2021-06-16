<?php

namespace App\Controllers;

class Action extends BaseController
{
    public function like()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id_post = $request->getVar('id');
            $id_user = $this->session->get('user_id');
            $row = $this->LikesModel->where('id_post', $id_post)->where('id_user', $id_user)->countAllResults();

            if ($row) {
                $this->LikesModel->where('id_post', $id_post)->where('id_user', $id_user)->delete();
            } else {
                $this->LikesModel->insert(['id_post' => $id_post, 'id_user' => $id_user]);
            }

            $msg = [
                'sukses' => $row
            ];

            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function komen()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'komentar' => [
                    'label' => 'Komentar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'komentar'   => $validation->getError('komentar'),
                    ]
                ];
            } else {
                $simpandata = [
                    'komentar'  => $request->getVar('komentar'),
                    'id_post'   => $request->getVar('id'),
                    'id_user'   => $this->session->get('user_id')
                ];

                $this->KomentarModel->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function fetch_komen($id)
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'komen' => $this->KomentarModel->join('users', 'users.id_user = komentar.id_user')->where('id_post', $id)->get()->getResultArray()
            ];
            $msg = [
                'data' => view('users/v_profile/komen', $data)
            ];

            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function hapus_komen()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id_komentar = $request->getVar('id');
            $this->KomentarModel->delete($id_komentar);

            $msg = [
                'sukses' => 1
            ];

            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function hapus_post()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id_post = $request->getVar('id');
            $this->PostsModel->delete($id_post);

            $msg = [
                'sukses' => 1
            ];

            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }
}
