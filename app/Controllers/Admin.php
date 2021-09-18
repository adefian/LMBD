<?php

    namespace App\Controllers;
    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use App\Models\M_Admin;
    use App\Filters\FilterInterface;

    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Label\Label;
    use Endroid\QrCode\Logo\Logo;
    use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
    use Endroid\QrCode\Writer\PngWriter;

    class Admin extends Controller
    {
        protected $M_Admin;

        public function __construct()
        {
            $this->M_Admin = new M_Admin;
        }
        public function index()
        {
            $session = session();
            // $db = \Config\Database::connect();

            // $builder = $db->table('barang');
            // $builder->select('barang.nm_barang'.'barang.');

            // $nama_barang = $builder->get()->getResult();

            $nama_barang = $this->M_Admin->data_peminjam();
            $nm_barang = "";
            $jumlah_dipinjam = null;
            foreach ($nama_barang as $item) {
                $bar = $item['nm_barang'];
                $nm_barang .= "'$bar'". ", ";
                $jum = $item['COUNT(*)'];
                $jumlah_dipinjam .= "$jum". ", ";
            }

            // dd(rtrim($nm_barang, ", "));
            $data = [
                'judul' => 'Dashboard Admin',
                'nama_barang' => rtrim($nm_barang, ", "),
                'jumlah_dipinjam' => rtrim($jumlah_dipinjam, ", ")
            ];

            echo view('templates/v_header', $data);
            echo view('templates/v_sidebar');
            echo view('templates/v_topbar');
            echo view('admin/index', $data);
            echo view('templates/v_footer',);
        }

        public function ubah_password()
        {
            $session = session();

            $db = \Config\Database::connect(); // optional; init database if not created yet

            $builder = $db->table('tb_admin');
            $builder->where('id_admin', 1);
            $builder->select('*');
            $builder->limit(1);

            $query = $builder->get();
            $result = $query->getResult(); // Result as objects eg; $result->kode
            $admin = $result[0];

            $data = [
                'judul' => 'Dashboard Admin',
                'result' => $admin
            ];

            echo view('templates/v_header', $data);
            echo view('templates/v_sidebar');
            echo view('templates/v_topbar');
            echo view('admin/ubah_password', $data);
            echo view('templates/v_footer',);
        }
        public function update_password()
        {
            //include helper form
            helper(['form']);
            //set rules validation form
            $rules = [
                'password' => 'required|min_length[6]|max_length[200]',
            ];

            if($this->validate($rules)){

                $nama_admin = $this->request->getVar('nama_admin');
                $writer = new PngWriter();

                // Create QR code
                $qrCode = QrCode::create($nama_admin)
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize(300)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));

                // Create generic logo
                $logo = Logo::create(__DIR__.'/../../public/favicon.png')
                    ->setResizeToWidth(50);

                // Create generic label
                $label = Label::create('Admin')
                    ->setTextColor(new Color(0, 0, 0));

                $result = $writer->write($qrCode, $logo, $label);
                
                header('Content-Type: '.$result->getMimeType());
                echo $result->getString();

                // Save it to a file
                $result->saveToFile(__DIR__.'/../../public/assets/img/qr_code_admin/'.$nama_admin.'.jpg');

                if($this->request->getVar('password')){
                    $data = [
                        'nama_admin' => $this->request->getVar('nama_admin'),
                        'user_admin' => $this->request->getVar('user_admin'),
                        'passwd_admin' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        'qr_code'       => $nama_admin.'.jpg'

                    ];
                } else {
                    $data = [
                        'nama_admin' => $this->request->getVar('nama_admin'),
                        'user_admin' => $this->request->getVar('user_admin'),
                        'qr_code'    => $image_name

                    ];
                }

                $id = 1;
                $success = $this->M_Admin->ubah_password($data, $id);
                if ($success) {
                    session()->setFlashdata('message', 'Berhasil merubah data');
                    return redirect()->to('admin/ubah_password');
                }
            }else{
                $db = \Config\Database::connect(); // optional; init database if not created yet

                $builder = $db->table('tb_admin');
                $builder->where('id_admin', 1);
                $builder->select('*');
                $builder->limit(1);

                $query = $builder->get();
                $result = $query->getResult(); // Result as objects eg; $result->kode
                $admin = $result[0];
                
                $data = [
                    'judul' => 'Dashboard Admin',
                    'result' => $admin
                ];

                session()->setFlashdata('err', \Config\Services::validation()->listErrors()); 
                    
                echo view('templates/v_header', $data);
                echo view('templates/v_sidebar');
                echo view('templates/v_topbar');
                echo view('admin/ubah_password', $data);
                echo view('templates/v_footer',);
            }
        }

    }