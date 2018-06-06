<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends CI_Controller
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
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/student_dashboard', 'refresh');
    }

    function request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('student_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }    
        if ($param1 == "create")
        {
            $data['student_id']   = $this->session->userdata('login_user_id');
            $data['description']  = $this->input->post('description');
            $data['title']        = $this->input->post('title');
            $data['start_date']   = $this->input->post('start_date');
            $data['end_date']     = $this->input->post('end_date');
            $this->db->insert('students_request', $data);
            redirect(base_url() . 'index.php?student/request', 'refresh');
        }
        
        $data['page_name']  = 'request';
        $data['page_title'] = get_phrase('My-Permissions');
        $this->load->view('backend/index', $data);
    }

    function attendance_report() 
     {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_report';
         $page_data['page_title']   = get_phrase('Attendance-Report');
         $this->load->view('backend/index',$page_data);
     }

     function report_attendance_view($class_id = '' , $section_id = '', $month = '') 
     {
         if($this->session->userdata('student_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['month']    = $month;
        $page_data['page_name'] = 'report_attendance_view';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
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
        redirect(base_url().'index.php?student/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'],'refresh');
    }

    function pages_view($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
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

    function events($param1 = '', $param2 = '' , $param3 = '') {

        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'edit') 
        {
            $this->crud_model->calendar_event_edit($param2);
        }

        $page_data['page_name']     = 'events';
        $page_data['page_title']    = get_phrase('Events');
        $this->load->view('backend/index', $page_data);
    }

    function videos()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'videos';
        $page_data['page_title'] = get_phrase('GalleryPic');
        $this->load->view('backend/index', $page_data);
    }

    function video_detail($category_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        if ($category_id == '')
            $category_id           =   $this->db->get('gallery_category')->first_row()->category_id;
        $page_data['page_name']  = 'video_detail';
        $page_data['page_title'] = get_phrase('Gallery');
        $page_data['category_id']   = $category_id;
        $this->load->view('backend/index', $page_data);    
    }

    
    function student_dashboard()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'student_dashboard';
        $page_data['page_title'] = get_phrase('Student-Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function marks_print_view($student_id , $exam_id) 
     {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/student/marks_print_view', $page_data);
    }
    
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('Teachers');
        $this->load->view('backend/index', $page_data);
    }
    
    function subject($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $student_class_id        = $this->db->get_where('enroll' , array(
            'student_id' => $student_profile->student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $student_class_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('Subjects');
        $this->load->view('backend/index', $page_data);
    }
    
    function my_marks($student_id = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

         $student = $this->db->get_where('student' , array('student_id' => $student_id))->result_array();
                foreach ($student as $row)
            {
                if($row['student_id'] == $this->session->userdata('login_user_id'))
                {
                    $page_data['student_id'] =   $student_id;
                } else if($row['parent_id'] != $this->session->userdata('login_user_id'))
                {
                    redirect(base_url(), 'refresh');
                }
            }

        $class_id     = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'my_marks';
        $page_data['page_title'] =   $student_name.', '. get_phrase('Your-Marks');
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }
    
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $page_data['class_id']   = $this->db->get_where('enroll' , array(
            'student_id' => $student_profile->student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $page_data['student_id'] = $student_profile->student_id;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function horarios_de_examen($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile         = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
        $page_data['class_id']   = $this->db->get_where('enroll' , array(
            'student_id' => $student_profile->student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $page_data['student_id'] = $student_profile->student_id;
        $page_data['page_name']  = 'horarios_de_examen';
        $page_data['page_title'] = get_phrase('Exam-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function unit_content($student_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'unit_content';
        $page_data['page_title'] = get_phrase('Semester-Content');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

     function homework($student_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'homework';
        $page_data['page_title'] = get_phrase('My-Homework');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }
	
    function libreria_virtual($student_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'libreria_virtual';
        $page_data['page_title'] = get_phrase('Virtual-Library');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function online_exams($student_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'online_exams';
        $page_data['page_title'] = "Online exams";
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
	
	 function descargar_libro($libro_code)
    {
        $file_name = $this->db->get_where('libreria', array(
            'libro_code' => $libro_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/libreria/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

   function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
            ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
            ))->row();
            
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'index.php?student/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'index.php?student/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'index.php?student/invoice/paypal_success');
            $this->paypal->submit_paypal_post();
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
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
            redirect(base_url() . 'index.php?student/invoice/', 'refresh');
        }
        if ($param1 == 'paypal_success') 
        {
            redirect(base_url() . 'index.php?student/invoice/', 'refresh');
        }
        $student_profile         = $this->db->get_where('student', array(
            'student_id'   => $this->session->userdata('student_id')
        ))->row();
        $student_id              = $student_profile->student_id;
        $page_data['invoices']   = $this->db->get_where('invoice', array(
            'student_id' => $student_id
        ))->result_array();
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('Student-Payment');
        $this->load->view('backend/index', $page_data);
    }

    function listado_de_reportes($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('student_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create')
        {
            $this->crud_model->create_report();
            redirect(base_url(), 'refresh');
        }

        $page_data['page_title'] =   get_phrase('Teacher-Report');
        $page_data['page_name']  = 'listado_de_reportes';
        $this->load->view('backend/index', $page_data);
    }

    function crear_reporte() 
    {
        $page_data['page_name'] = 'crear_reporte';
        $page_data['page_title'] = get_phrase('New');
        $this->load->view('backend/index', $page_data);
    }

    function create_note() 
    {
        $this->crud_model->create_note();
    }

    function circulares($param1 = '', $param2 = '') 
    {
        $page_data['page_name'] = 'circulares';
        $page_data['page_title'] = get_phrase('News');
        $this->load->view('backend/index', $page_data);
    }

    function school_bus($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'school_bus';
        $page_data['page_title'] = get_phrase('School-Bus');
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            redirect(base_url() . 'index.php?student/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);
            redirect(base_url() . 'index.php?student/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('Private-Messages');
        $this->load->view('backend/index', $page_data);
    }
    
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('student_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info_for_student();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('Study-Material');
        $this->load->view('backend/index', $data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('Library');
        $this->load->view('backend/index', $page_data);
    }

    function homeworkroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'file') 
        {
            $page_data['room_page']    = 'homework_file';
            $page_data['homework_code'] = $param2;
        }  

        else if ($param1 == 'details') {
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        }

        $page_data['page_name']   = 'homework_room'; 
        $page_data['page_title']  = get_phrase('My-Homework');
        $page_data['page_title'] .=  " : " . $this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function reload_homeworkroom_details($homework_code = '') {
        $page_data['homework_code'] =   $homework_code;
        $this->load->view('backend/student/homework_details' , $page_data);
    }

    function homework_file($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('student_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $homework_code = $this->db->get_where('homework', array('homework_id'))->row()->homework_code;
        if ($param1 == 'upload')
        {
            $this->crud_model->upload_homework_file($param2);
            redirect(base_url() . 'index.php?student/homeworkroom/file/' . $param2, 'refresh');
        }

        else if ($param1 == 'download')
        {
            $this->crud_model->download_homework_file($param2);
        }
    }

     function reload_homeworkroom_file_list($homework_code = '') 
    {
        $page_data['homework_code'] =   $homework_code;
        $this->load->view('backend/student/homework_file_list' , $page_data);
    }

     function reload_homework_list() {
        $this->load->view('backend/student/homework_list');
    }

    function forumroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($param1 == 'comment') 
        {
            $page_data['room_page']    = 'comments';
            $page_data['post_code'] = $param2; 
        }

        else if ($param1 == 'posts') 
        {
            $page_data['room_page'] = 'post';
            $page_data['post_code'] = $param2; 
        }

        $page_data['page_name']   = 'forum_room'; 
        $page_data['page_title']  = "Foro del Curso";
        $page_data['page_title'] .=  " : " . $this->db->get_where('forum',array('post_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function newsroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) 
        {
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
        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php?student/newsroom/overview/' . $param2, 'refresh');
        }
    }

    function forum_message($param1 = '', $param2 = '', $param3 = '')
     {
        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'add') 
        {
            $this->crud_model->create_post_message($param2); 
            redirect(base_url() . 'index.php?student/forumroom/posts/' . $param2, 'refresh');
        }
    }

    function forum($param1 = '', $param2 = '', $student_id = '') 
    {
        if ($param1 == 'create') 
        {
            $post_code = $this->crud_model->create_post();
            redirect(base_url() . 'index.php?student/forumroom/post/' . $post_code , 'refresh');
        }
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = get_phrase('ClassForum');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }
}