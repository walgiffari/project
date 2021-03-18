<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('image_lib');
        $this->load->helper(array('download'));
        $this->load->helper('directory');

    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function info()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('user_templates', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Info Pasangan';
        $suami_ = $this->input->post('suami');
        $istri_ = $this->input->post('istri');
        $alamat_ = $this->input->post('alamat');
        $image_ = $this->input->post('images');
        $email_ = $this->input->post('email', true);
        $this->form_validation->set_rules('suami', 'suami', 'required|trim');
        $this->form_validation->set_rules('istri', 'istri', 'required|trim');
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim|max_length[25]');
        $suamiada = $this->db->get_where('user_templates', ['email' => $email_])->row_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/info_pasangan', $data);
            $this->load->view('templates/footer');
        } else {
            if ($suamiada) {
                $this->db->set('suami', $suami_);

                $upload_images = $_FILES['images_suami']['name'];
                if ($upload_images) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('images_suami')) {
                        $old_image = $data['info']['images_suami'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('images_suami', $new_image);
                    } else {
                        echo $this->upload->dispay_errors();
                    }
                }
                $this->db->set('istri', $istri_);

                $upload_images = $_FILES['images_istri']['name'];
                if ($upload_images) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('images_istri')) {
                        $old_image = $data['info']['images_istri'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                        $new_images = $this->upload->data('file_name');
                        $this->db->set('images_istri', $new_images);
                    } else {
                        echo $this->upload->dispay_errors();
                    }
                }

                $this->db->set('alamat', $alamat_);
                $this->db->where('email', $email_);
                $this->db->update('user_templates');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data informasi telah tersimpan!</div>');
                redirect('user/info');

            } else {
                $upload_images = $_FILES['images_suami']['name'];
                if ($upload_images) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('images_suami')) {
                        $old_image = $data['info']['images_suami'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('images_suami', $new_image);
                    } else {
                        echo $this->upload->dispay_errors();
                    }
                }

                $upload_imagess = $_FILES['images_istri']['name'];
                if ($upload_imagess) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('images_istri')) {
                        $old_image = $data['info']['images_istri'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                        $new_images = $this->upload->data('file_name');
                        $this->db->set('images_istri', $new_images);
                    } else {
                        echo $this->upload->dispay_errors();
                    }
                }

                $data = [
                    'email' => htmlspecialchars($email_),
                    'suami' => htmlspecialchars($suami_),
                    'images_suami' => htmlspecialchars($new_image),
                    'istri' => htmlspecialchars($istri_),
                    'images_istri' => htmlspecialchars($new_images),
                    'alamat' => htmlspecialchars($alamat_),

                ];
                $this->db->insert('user_templates', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data informasi telah tersimpan!</div>');
                redirect('user/info');
            }

        }

    }

    public function undangan()
    {

        $data['title'] = 'Undangan Foto';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('user_templates', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/temp_foto', $data);
        $this->load->view('templates/footer');

    }

    public function download()
    {
        $data['title'] = 'Undangan Foto';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('user_templates', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/temp_foto', $data);
        $this->load->view('templates/footer');

        force_download('./assets/templates/foto/temp1.jpg', null);

    }

    public function waktu()
    {

        $data['title'] = 'Waktu dan Tempat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('user_templates', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/temp_waktu', $data);
        $this->load->view('templates/footer');

    }
}
