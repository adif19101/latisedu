<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Pendataan extends ResourcePresenter
{
    public function __construct()
    {
        $this->mLembaga = new \App\Models\LembagaSiswa();
        $this->mSiswa = new \App\Models\Siswa();
    }

    /**
     * Present a view of resource objects
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Dashboard',
            // 'breadcrumbs' => [
            //     [
            //         'crumb' => 'Dashboard'
            //     ],
            // ],
        ];

        $data['datatable'] = $this->mSiswa->dataSiswa();
        // echo '<pre>';
        // var_dump($data['datatable']);
        // die;

        return view('pendataan', $data);
    }

    public function searchTabel() {
        $data['tabel'] = $this->mSiswa->dataSiswa($this->request->getPost());
        return $data;
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param string $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Dashboard',
            'breadcrumbs' => [
                [
                    'crumb' => 'Dashboard'
                ],
                [
                    'crumb' => 'Tambah Data'
                ],
            ],
        ];

        $data['lembaga'] = $this->mLembaga->get()->getResultArray();
        return view('pendataan_create', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $dataIn = $this->request->getPost();
        $dataIn['id_lembaga'] = $dataIn['nama_lembaga'];

        $rules = [
            'id_lembaga' => 'required|max_length[255]',
            'nis' => 'required|numeric|is_unique[siswa.nis]',
            'nama_siswa' => 'required|max_length[255]',
            'email' => 'required|max_length[254]|valid_email',
            'foto' => 'uploaded[foto]|max_size[foto,100]',
        ];

        if (! $this->validateData($dataIn, $rules)) {
            $errorMsg = '';
            foreach ($this->validator->getErrors() as $key => $value) {
                $errorMsg = $errorMsg . $value . ' '; 
            }
            $response = [
                'status' => 'error',
                'message' => $errorMsg,
            ];
            return $this->response->setJSON($response);
        }

        $img = $this->request->getFile('foto');

        if (isset($img) && $img->isValid() && ! $img->hasMoved()) {
            $imgName = $img->getRandomName();

            if ($img->move(AVATAR_UPLOAD_PATH, $imgName)) {
                $dataIn += ['foto' => $imgName];
            }
        }
        // TODO data validation

        if ($this->mSiswa->createSiswa($dataIn)) {
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data gagal disimpan',
            ];
        }

        return $this->response->setJSON($response);
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}