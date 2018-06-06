<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parents extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function index()
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/parents_dashboard', 'refresh');
    }

 function video_detail($category_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        if ($category_id == '')
            $category_id           =   $this->db->get('gallery_category')->first_row()->category_id;
        $page_data['page_name']  = 'video_detail';
        $page_data['page_title'] = get_phrase('Gallery');
        $page_data['category_id']   = $category_id;
        $this->load->view('backend/index', $page_data);    
    }

      function videos()
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'videos';
        $page_data['page_title'] = get_phrase('GalleryPic');
        $this->load->view('backend/index', $page_data);
    }

    function events($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_title']    = get_phrase('Events');
        $page_data['page_name']  = 'events';
        $this->load->view('backend/index', $page_data);
    }

    function parents_dashboard()
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'parents_dashboard';
        $page_data['page_title'] = get_phrase('Parents-Dashboard');
        $this->load->view('backend/index', $page_data);
    }

     function pages_view($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'page_details') 
        {
            $page_data['room_page'] = 'page_details';
            $page_data['page_id'] = $param2;
        }
        $page_data['page_name']   = 'page_details'; 
        $page_data['page_title']  = $this->db->get_where('pages',array('page_id'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }
    
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = get_phrase('Teachers');
        $this->load->view('backend/index', $page_data);
    }

    function unit_content($student_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'unit_content';
        $page_data['page_title'] = get_phrase('Semester-Content');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function download_unit_content($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;

        force_download($name, $data);
    }

    function marks_print_view($student_id , $exam_id) 
     {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/parent/marks_print_view', $page_data);
    }

    function circulares($param1 = '', $param2 = '') 
    {
        if ($param1 == 'mark_as_archive') {
            $this->db->where('news_code' , $param2);
            $this->db->update('news' , array('news_status' => 0));
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('news_code' , $param2);
            $this->db->update('news' , array('news_status' => 1));
        }

        $page_data['page_name'] = 'circulares';
        $page_data['page_title'] = get_phrase('News');
        $this->load->view('backend/index', $page_data);
    }

    function marks($param1 = '', $param2 ='')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $parents = $this->db->get_where('student' , array('student_id' => $param1))->result_array();
                foreach ($parents as $row)
            {
                if($row['parent_id'] == $this->session->userdata('login_user_id'))
                {
                    $page_data['student_id'] = $param1;
                } else if($row['parent_id'] != $this->session->userdata('login_user_id'))
                {
                    redirect(base_url(), 'refresh');
                }
            }

        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('Qualifications');
        $this->load->view('backend/index', $page_data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('Library');
        $this->load->view('backend/index', $page_data);
    }
    
    
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report() 
     {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_report';
         $page_data['page_title']   = get_phrase('Attendance-Report');
         $this->load->view('backend/index',$page_data);
     }

    function report_attendance_view($class_id = '' , $section_id = '', $month = '', $param1 = '') 
     {
         if($this->session->userdata('parent_login')!=1)
            redirect(base_url() , 'refresh');
        
        $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['month']    = $month;
        $page_data['student_id'] = $param1;
        $page_data['page_name'] = 'report_attendance_view';
        $section_name = $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('Attendance-Report');
        $this->load->view('backend/index', $page_data);
     }

     function attendance_report_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url().'index.php?parents/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'],'refresh');
    }

    function horario_de_examenes($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'horario_de_examenes';
        $page_data['page_title'] = get_phrase('Exam-Routine');
        $this->load->view('backend/index', $page_data);
    }
    
    
    function invoice($student_id = '' , $param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'make_payment') 
        {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
            $invoice_details = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'index.php?parents/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'index.php?parents/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'index.php?parents/invoice/paypal_success');
            $this->paypal->submit_paypal_post();
        }
        if ($param1 == 'paypal_ipn') 
        {
            if ($this->paypal->validate_ipn() == true) 
            {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details']   = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method']    = 'paypal';
                $data['status']            = 'paid';
                $invoice_id                = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);
                $data2['method']       =   'paypal';
                $data2['invoice_id']   =   $_POST['custom'];
                $data2['timestamp']    =   strtotime(date("m/d/Y"));
                $data2['payment_type'] =   'income';
                $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                $this->db->insert('payment' , $data2);
            }
        }
        if ($param1 == 'paypal_cancel') 
        {
            redirect(base_url() . 'index.php?parents/invoice/' . $student_id, 'refresh');
        }
        if ($param1 == 'paypal_success') 
        {
            redirect(base_url() . 'index.php?parents/invoice/' . $student_id, 'refresh');
        }
        $parent_profile         = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->row();
        $page_data['student_id'] = $student_id;
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('Students-Payments');
        $this->load->view('backend/index', $page_data);
    }
    
    function newsroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        else if ($param1 == 'overview') 
        {
            $page_data['room_page'] = 'news_overview';
            $page_data['news_code'] = $param2;
        }

        $page_data['page_name']   = 'newsroom'; 
        $page_data['page_title']  = get_phrase('Details');
        $page_data['page_title'] .=  ": " . $this->db->get_where('news',array('news_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function news_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php?parents/newsroom/overview/' . $param2, 'refresh');
        }
    }

    function school_bus($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'school_bus';
        $page_data['page_title'] = get_phrase('School-Bus');
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            redirect(base_url() . 'index.php?parents/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);
            redirect(base_url() . 'index.php?parents/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read')
         {
            $page_data['current_message_thread_code'] = $param2;
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('Private-Messages');
        $this->load->view('backend/index', $page_data);
    }
}