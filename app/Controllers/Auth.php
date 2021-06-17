<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        if (session('login')) {
            return redirect()->to(base_url('Home'));
        }
        $data = [
            'title' => 'InstaApp - Login'
        ];
        return view('users/v_auth/index', $data);
    }

    public function validasi()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $username = $request->getVar('username');
            $password = $request->getVar('password');

            if ($username == NULL or $password == NULL) {
                $msg = [
                    'error' => 'Harap mengisi Username dan Password !'
                ];
            } else {
                $row = $this->UsersModel->where('username', $username)->get();

                if ($row->getNumRows() > 0) {
                    $row = $row->getRowArray();
                    $password_user = $row['password'];

                    if (password_verify($password, $password_user)) {
                        $simpan_session = [
                            'login' => true,
                            'nama' => $row['nama'],
                            'user_id' => $row['id_user'],
                            'username' => $row['username'],
                            'email'  => $row['email'],
                            'foto'  => $row['foto'],
                            'role' => $row['role_id'],
                        ];

                        $this->session->set($simpan_session);
                        date_default_timezone_set('Asia/Jakarta');
                        $this->UsersModel->update($row['id_user'], ['last_login' => date('Y-m-d H:i:s')]);

                        $msg = [
                            'sukses' => [
                                'link' => base_url('Home')
                            ]
                        ];
                    } else {
                        $msg = [
                            'error' => 'Password salah!'
                        ];
                    }
                } else {
                    $msg = [
                        'error' => 'User tidak ditemukan!'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function daftar()
    {
        if (session('login')) {
            return redirect()->to(base_url('Home'));
        }
        $data = [
            'title' => 'InstaApp - Register'
        ];
        return view('users/v_auth/daftar', $data);
    }

    public function simpan()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]|alpha_numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tersebut sudah ada',
                        'alpha_numeric' => '{field} hanya dapat diisi dengan huruf, angka, underscores dan periods',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|is_unique[users.email]|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tersebut sudah ada',
                        'valid_email' => '{field} salah'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} terlalu pendek'
                    ]
                ],
                'password2' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'matches' => '{field} tidak cocok'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username'   => $validation->getError('username'),
                        'nama'       => $validation->getError('nama'),
                        'email'      => $validation->getError('email'),
                        'password'   => $validation->getError('password'),
                        'password2'  => $validation->getError('password2')
                    ]
                ];
            } else {
                $simpandata = [
                    'username'       => $request->getVar('username'),
                    'nama'           => $request->getVar('nama'),
                    'email'          => $request->getVar('email'),
                    'password'       => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
                    'role_id'        => 2,
                    'foto'           => "default.png",
                ];

                $this->UsersModel->insert($simpandata);
                $msg = [
                    'sukses' => [
                        'link' => base_url('Auth'),
                        'msg'  => 'Register Berhasil!',
                    ]
                ];
            }
            echo json_encode($msg);
        } else {
            exit(view('errors/html/error_404'));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('Auth'));
    }
}
