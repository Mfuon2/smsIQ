<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');		
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/admin_dashboard', 'refresh');
    }

    function admin_dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'admin_dashboard';
        $page_data['page_title'] = get_phrase('Admin-Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function admins($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') 
        {
            $this->crud_model->admin_create();
            redirect(base_url() . 'index.php?admin/admins/', 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud_model->admin_edit($param2);
            redirect(base_url() . 'index.php?admin/admin_profile/'.$param2, 'refresh');
        }
        if ($param1 == 'delete')
        {
            $this->crud_model->admin_delete($param2);
        redirect(base_url() . 'index.php?admin/admins/', 'refresh');
        }
        if ($param1 == 'change_password') 
        {
           $this->crud_model->admin_pass($param2);
            redirect(base_url() . 'index.php?admin/admin_profile/'. $param2, 'refresh');
        }
        $page_data['page_name']     = 'admins';
        $page_data['page_title']    = get_phrase('Admins');
        $this->load->view('backend/index', $page_data);
    }
    
    function admin_profile($admin_id)
    {
        if ($this->session->userdata('admin_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'admin_profile';
        $page_data['page_title'] =  get_phrase('Profile');
        $page_data['admin_id']  =  $admin_id;
        $this->load->view('backend/index', $page_data);
    }
    
    function teacher_profile($teacher_id)
    {
        if ($this->session->userdata('admin_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_profile';
        $page_data['page_title'] =  get_phrase('Profile');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }
    
    function teachers($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') 
        {
            $data['name']        = $this->input->post('name');
            $data['username']        = $this->input->post('username');
            $data['salary']        = $this->input->post('salary');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['password']    = sha1($this->input->post('password'));
            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher_profile/'.$teacher_id, 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['username']        = $this->input->post('username');
            $data['salary']      = $this->input->post('salary');
            $data['birthday']        = $this->input->post('birthday');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher_profile/'. $param2, 'refresh');
        }
        if ($param1 == 'change_password') 
        {
           $data['new_password'] = sha1($this->input->post('new_password'));
        $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) 
            {
                $this->db->where('teacher_id', $param2);
                $this->db->update('teacher', array('password' => $data['new_password']));
            } 
            redirect(base_url() . 'index.php?admin/teacher_profile/'. $param2, 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            redirect(base_url() . 'index.php?admin/teachers/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = get_phrase('Manage-Teachers');
        $this->load->view('backend/index', $page_data);
    }
    
    function add_student()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'add_student';
        $page_data['page_title'] = get_phrase('New-Student');
        $this->load->view('backend/index', $page_data);
    }

    function create_exam($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1 == 'create')
        {
            $this->crud_model->create_online_exam();
            redirect(base_url() . 'index.php?admin/create_exam/', 'refresh');
        }

        $page_data['page_name']  = 'create_exam';
        $page_data['page_title'] = "Add New Online Exam";
        $this->load->view('backend/index', $page_data);
    }

    function exam_detail($param1 = '', $exam_id)
    {
        if ($this->session->userdata('admin_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if($param1 == 'questionadd')
        {
            $data['exam_id'] = $this->input->post('exam_id');
            $data['question'] = $this->input->post('question');
            $data['optiona'] = $this->input->post('optiona');
            $data['optionb'] = $this->input->post('optionb');
            $data['optionc'] = $this->input->post('optionc');
            $data['optiond'] = $this->input->post('optiond');
            $data['correctanswer'] = $this->input->post('correctanswer');
            $data['marks'] = $this->input->post('marks');
            $this->db->insert('questions' , $data);
            redirect(base_url() . 'index.php?admin/exam_detail/'. $exam_id, 'refresh');
        }

        $page_data['page_name']  = 'exam_detail';
        $page_data['page_title'] =  "Details Exam";
        $page_data['exam_id']  =  $exam_id;
        $this->load->view('backend/index', $page_data);
    }

    function manage_exams($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

       if($param1 == 'edit')
        {
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['availablefrom'] = $this->input->post('availablefrom');
            $data['availableto'] = $this->input->post('availableto');
            $data['duration'] = $this->input->post('duration');
            $data['pass'] = $this->input->post('pass');
            $data['questions'] = $this->input->post('questions');
            $this->db->where('exam_id', $param2);
            $this->db->update('exams', $data);
            redirect(base_url() . 'index.php?admin/manage_exams/', 'refresh');
        }
        if($param1 == 'delete')
        {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exams');
            redirect(base_url() . 'index.php?admin/manage_exams/', 'refresh');
        }
       
        $page_data['exams']   = $this->db->get('exams')->result_array();
        $page_data['page_name']  = 'manage_exams';
        $page_data['page_title'] = "Manage Online Exams";
        $this->load->view('backend/index', $page_data);
    }

    function student_bulk($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if($param1 == 'add_bulk_student') {
            $names     = $this->input->post('name');
            $rolls     = $this->input->post('roll');
            $emails    = $this->input->post('username');
            $passwords = $this->input->post('password');
            $date           = strtotime(date("d M,Y"));
            $phones    = $this->input->post('phone');
            $genders   = $this->input->post('sex');
            $student_entries = sizeof($names);
            for($i = 0; $i < $student_entries; $i++) {
                $data['name']     =   $names[$i];
                $data['username']    =   $emails[$i];
                $data['password'] =   sha1($passwords[$i]);
                $data['date']           = strtotime(date("d M,Y"));
                $data['phone']    =   $phones[$i];
                $data['sex']      =   $genders[$i];
                if($data['name'] == '' || $data['username'] == '' || $data['password'] == '')
                    continue;
                $this->db->insert('student' , $data);
                $student_id = $this->db->insert_id();
                $data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
                $data2['student_id']    =   $student_id;
                $data2['class_id']      =   $this->input->post('class_id');
                if($this->input->post('section_id') != '') {
                    $data2['section_id']    =   $this->input->post('section_id');
                }
                $data2['roll']          =   $rolls[$i];
                $data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
                $data2['year']          =   $this->db->get_where('settings' , array(
                                                'type' => 'running_year'
                                            ))->row()->description;
                $this->db->insert('enroll' , $data2);
            }
            redirect(base_url() . 'index.php?admin/students_area/' . $this->input->post('class_id') , 'refresh');
        }           
        $page_data['page_name']  = 'student_bulk';
        $page_data['page_title'] = get_phrase('Student-Bulk');
        $this->load->view('backend/index', $page_data);
    }

    function student_portal($student_id, $param1='')
    {
         if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;

        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $system = $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;

        $page_data['page_name']  = 'student_portal';
        $page_data['page_title'] =  get_phrase('Student-Portal') . " - " . $system;
        $page_data['student_id']  =  $student_id;
        $page_data['class_id']   =   $class_id;

        $this->load->view('backend/index', $page_data);
    }

    function get_sections($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/student_bulk_sections' , $page_data);
    }

    function manage_pages($param1 = "", $page_id = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }       

        if ($param1 == "delete")
        {
            $this->crud_model->delete_page($page_id);
            redirect(base_url() . 'index.php?admin/manage_pages');
        }
        $data['pages_info']             = $this->crud_model->get_pages();
        $data['page_name']              = 'manage_pages';
        $data['page_title']             = "Administrar Páginas Estáticas";
        $this->load->view('backend/index', $data);
    }

    function pages_view($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function static_page_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  = 'static_page_add';
        $page_data['page_title'] = get_phrase('NewPage');
        $this->load->view('backend/index', $page_data);
    }


    function pages($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        
        if ($param1 == 'create') 
        {
            $data['title']           = $this->input->post('title');
            $data['description']           = $this->input->post('description');
            $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
            $this->db->insert('pages', $data);
            
            redirect(base_url() . 'index.php?admin/manage_pages/', 'refresh');
        }
    }


     function request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($param1 == "accept")
        {
            $data['status'] = 1;
            $this->db->update('request', $data, array('request_id' => $param2));
            redirect(base_url() . 'index.php?admin/request', 'refresh');
        }
                
        if ($param1 == "reject")
        {
            $data['status'] = 2;
            $this->db->update('request', $data, array('request_id' => $param2));
            redirect(base_url() . 'index.php?admin/request', 'refresh');
        }
        
        $data['page_name']  = 'request';
        $data['page_title'] = get_phrase('Lists-Perms');
        $this->load->view('backend/index', $data);
    }

    function request_student($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
                
        if ($param1 == "accept")
        {
            $data['status'] = 1;
            $this->db->update('students_request', $data, array('request_id' => $param2));
            redirect(base_url() . 'index.php?admin/request_student', 'refresh');
        }
                
        if ($param1 == "reject")
        {
            $data['status'] = 2;
            $this->db->update('students_request', $data, array('request_id' => $param2));
            redirect(base_url() . 'index.php?admin/request_student', 'refresh');
        }
        
        $data['page_name']  = 'request_student';
        $data['page_title'] = get_phrase('Lists-Perms');
        $this->load->view('backend/index', $data);
    }

    function report_list($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('admin_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete')
            $this->crud_model->delete_report($param2);
        $page_data['page_title'] =   get_phrase('Report-Teacher-List');
        $page_data['page_name']  = 'report_list';
        $this->load->view('backend/index', $page_data);
    }

     function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $this->input->post('student_id');
            $data2['title']             =   $this->input->post('title');
            $data2['description']       =   $this->input->post('description');
            $data2['payment_type']      =  'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data2);
            redirect(base_url() . 'index.php?admin/payments', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?admin/students_payments', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'index.php?admin/students_payments', 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function looking_report($report_code = '') 
    {
        if ($this->session->userdata('admin_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['report_code'] = $report_code;
        $page_data['page_name'] = 'looking_report';
        $page_data['page_title'] = get_phrase('Viewing-Report');
        $this->load->view('backend/index', $page_data);
    }

    function reload_report_list() 
    {
        $this->load->view('backend/admin/report_list');
    }

    function reload_looking_report($report_code = '') 
    {
        $page_data['ticket_code'] = $ticket_code;
        $this->load->view('backend/admin/reload_looking_report', $page_data);
    }

    function reload_student() 
    {
        $this->load->view('backend/admin/students_area');
    }

	function students_area($class_id = '')
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		$page_data['page_name']  	= 'students_area';
		$page_data['page_title'] 	= get_phrase('Students') ." - ".get_phrase('Class')." : ".
		$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}

    function marks_area($student_id = '') 
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'marks_area';
        $page_data['page_title'] =   get_phrase('Marks-Of') . ' ' . $student_name;
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['username']           = $this->input->post('username');
            $data['birthday']       = $this->input->post('birthday');
            $data['date']           = strtotime(date("d M,Y"));
            $data['sex']            = $this->input->post('sex');
            $data['address']        = $this->input->post('address');
            $data['phone']          = $this->input->post('phone');
            $data['email']          = $this->input->post('email');
            $data['password']       = sha1($this->input->post('password'));
            $data['parent_id']      = $this->input->post('parent_id');
            $data['dormitory_id']  = $this->input->post('dormitory_id');
            $data['transport_id']  = $this->input->post('transport_id');
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            $data2['student_id']     = $student_id;
            $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
            $data2['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data2['section_id'] = $this->input->post('section_id');
            }
            $data2['roll']           = $this->input->post('roll');
            $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data2['year']           = $running_year;
            $this->db->insert('enroll', $data2);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            redirect(base_url() . 'index.php?admin/add_student/', 'refresh');
        }
        if ($param1 == 'do_update') 
        {
            $data['name']           = $this->input->post('name');
            $data['username']           = $this->input->post('username');
            $data['phone']          = $this->input->post('phone');
            $data['address']        = $this->input->post('address');
            $data['parent_id']      = $this->input->post('parent_id');
            $data['birthday']       = $this->input->post('birthday');
            $data['dormitory_id']   = $this->input->post('dormitory_id');
            $data['transport_id']   = $this->input->post('transport_id');
            $data['student_session'] = $this->input->post('student_session');
            $data['email']          = $this->input->post('email');
            $this->db->where('student_id', $param2);
            $this->db->update('student', $data);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/student_portal/' . $param2, 'refresh');
        }
    }

    function email_exists($email)
    {
        
    }

    function student_promotion($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if($param1 == 'promote') {
            $running_year  =   $this->input->post('running_year');  
            $from_class_id =   $this->input->post('promotion_from_class_id'); 
            $students_of_promotion_class =   $this->db->get_where('enroll' , array(
                'class_id' => $from_class_id , 'year' => $running_year
            ))->result_array();
            foreach($students_of_promotion_class as $row) {
                $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
                $enroll_data['student_id']      =   $row['student_id'];
                $enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
                $enroll_data['year']            =   $this->input->post('promotion_year');
                $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
                $this->db->insert('enroll' , $enroll_data);
            } 
            redirect(base_url() . 'index.php?admin/student_promotion' , 'refresh');
        }
        $page_data['page_title']    = get_phrase('Student-Promotion');
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

    function get_students_to_promote($class_id_from , $class_id_to , $running_year , $promotion_year)
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector' , $page_data);
    }

    function parents($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        			= $this->input->post('name');
            $data['username']        			= $this->input->post('username');
            $data['email']       			= $this->input->post('email');
            $data['password']    			= sha1($this->input->post('password'));
            $data['phone']       			= $this->input->post('phone');
            $data['address']     			= $this->input->post('address');
            $data['profession']  			= $this->input->post('profession');
            $this->db->insert('parent', $data);
            $parent_id     =   $this->db->insert_id();
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $parent_id . '.jpg');
            redirect(base_url() . 'index.php?admin/parents/', 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $data['name']                   = $this->input->post('name');
            $data['username']        		= $this->input->post('username');
            $data['email']                  = $this->input->post('email');
            $data['phone']                  = $this->input->post('phone');
            $data['address']                = $this->input->post('address');
            $data['profession']             = $this->input->post('profession');
            $this->db->where('parent_id' , $param2);
            $this->db->update('parent' , $data);
            redirect(base_url() . 'index.php?admin/parents/', 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            redirect(base_url() . 'index.php?admin/parents/', 'refresh');
        }
        $page_data['page_title'] 	= get_phrase('Manage-Parents');
        $page_data['page_name']  = 'parents';
        $this->load->view('backend/index', $page_data);
    }

    function events($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') 
        {
            $data['title']         = $this->input->post('title');
            $data['description']   = $this->input->post('description');
            $data['datefrom']      = $this->input->post('datefrom');
            $data['dateto']        = $this->input->post('dateto');
            $this->db->insert('events', $data);
            redirect(base_url() . 'index.php?admin/events/', 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $data['title']         = $this->input->post('title');
            $data['description']   = $this->input->post('description');
            $data['datefrom']      = $this->input->post('datefrom');
            $data['dateto']        = $this->input->post('dateto');
            $this->db->where('event_id' , $param2);
            $this->db->update('events' , $data);
            redirect(base_url() . 'index.php?admin/events/', 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('event_id' , $param2);
            $this->db->delete('events');
            redirect(base_url() . 'index.php?admin/events/', 'refresh');
        }
        $page_data['page_title']    = get_phrase('Events');
        $page_data['page_name']  = 'events';
        $this->load->view('backend/index', $page_data);
    }

    function courses($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('subject', $data);
            redirect(base_url() . 'index.php?admin/courses/'.$data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') 
        {
            $data['name']       = $this->input->post('name');
            $data['la1']       = $this->input->post('la1');
            $data['la2']       = $this->input->post('la2');
            $data['la3']       = $this->input->post('la3');
            $data['la4']       = $this->input->post('la4');
            $data['la5']       = $this->input->post('la5');
            $data['la6']       = $this->input->post('la6');
            $data['la7']       = $this->input->post('la7');
            $data['la8']       = $this->input->post('la8');
            $data['la9']       = $this->input->post('la9');
            $data['final']       = $this->input->post('final');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            redirect(base_url() . 'index.php?admin/courses/'.$data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?admin/courses/'.$param3, 'refresh');
        }
		$page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'coursess';
        $page_data['page_title'] = get_phrase('Manage-Subjects');
        $this->load->view('backend/index', $page_data);
    }

    function manage_classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
            $this->db->insert('section' , $data2);
            redirect(base_url() . 'index.php?admin/manage_classes/', 'refresh');
        }
        if ($param1 == 'do_update')
        {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            
            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            redirect(base_url() . 'index.php?admin/manage_classes/', 'refresh');
        } else if ($param1 == 'edit') 
        {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            redirect(base_url() . 'index.php?admin/manage_classes/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'manage_class';
        $page_data['page_title'] = get_phrase('Manage-Classes');
        $this->load->view('backend/index', $page_data);
    }

    function get_subject($class_id) 
    {
        $subject = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function virtual_library($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'virtual_library';
        $page_data['page_title'] = get_phrase('Virtual-Library');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function upload_book()
    {
        $data['libro_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['nombre']                 =   $this->input->post('nombre');
        $data['autor']                  =   $this->input->post('autor');
        $data['description']            =   $this->input->post('description');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']             =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/libreria/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');
        $data['file_name'] = $_FILES['file_name']['name'];
        $this->db->insert('libreria', $data);
        redirect(base_url() . 'index.php?admin/virtual_library/' . $data['class_id'] , 'refresh');
    }

    function download_book($libro_code)
    {
        $file_name = $this->db->get_where('libreria', array('libro_code' => $libro_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/libreria/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

    function delete_book($libro_id)
    {
        $this->crud_model->delete_book($libro_id);
        redirect(base_url() . 'index.php?admin/virtual_library/' . $data['class_id'] , 'refresh');
    }

    function section($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;
        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('Manage-Sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);    
    }

    function gallery_category($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
    
        $page_data['page_name']  = 'gallery_category';
        $page_data['page_title'] = get_phrase('Gallery');
        $this->load->view('backend/index', $page_data);    
    }

    function video_detail($category_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($category_id == '')
            $category_id           =   $this->db->get('gallery_category')->first_row()->category_id;
        $page_data['page_name']  = 'video_detail';
        $page_data['page_title'] = get_phrase('Gallery');
        $page_data['category_id']   = $category_id;
        $this->load->view('backend/index', $page_data);    
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->insert('section' , $data);
            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->where('section_id' , $param2);
            $this->db->update('section' , $data);
            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            redirect(base_url() . 'index.php?admin/section' , 'refresh');
        }
    }

    function gall_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') 
        {
            $data['title']         =  $this->input->post('title');
            $data['embed']          =   $this->input->post('embed');
            $data['description']  =   $this->input->post('description');
            $this->db->insert('gallery_category' , $data);
            $category_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/screen/' . $category_id . '.jpg');
            redirect(base_url() . 'index.php?admin/gallery_category/', 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $data['title']       =   $this->input->post('title');
            $data['embed']          =   $this->input->post('embed');
            $data['description']   =   $this->input->post('description');
            $this->db->where('category_id' , $param2);
            $this->db->update('gallery_category' , $data);
            redirect(base_url() . 'index.php?admin/gallery_category/', 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('category_id' , $param2);
            $this->db->delete('gallery_category');
            redirect(base_url() . 'index.php?admin/gallery_category' , 'refresh');
        }
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array('class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
        echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array('class_id' => $class_id
        ))->result_array();
        foreach ($subjects as $row) 
        {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_students($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
        }
    }

    function semesters($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') 
        {
            $data['name']    = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('exam', $data);
            redirect(base_url() . 'index.php?admin/semesters/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') 
        {
            $data['name']    = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            redirect(base_url() . 'index.php?admin/semesters/', 'refresh');
        } else if ($param1 == 'edit') 
        {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            redirect(base_url() . 'index.php?admin/semesters/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'semester';
        $page_data['page_title'] = get_phrase('Semesters');
        $this->load->view('backend/index', $page_data);
    }

    function upload_marks()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  =   'upload_marks';
        $page_data['page_title'] = get_phrase('Upload-Marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_upload($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
        $page_data['page_name']  =   'marks_upload';
        $page_data['page_title'] = get_phrase('Upload-Marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $data['exam_id']    = $this->input->post('exam_id');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        $query = $this->db->get_where('mark' , array(
                    'exam_id' => $data['exam_id'],
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']))->result_array();
            foreach($students as $row) 
            {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
        redirect(base_url() . 'index.php?admin/marks_upload/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] , 'refresh');
    }

    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->db->get_where('mark' , array(
        'exam_id' => $exam_id, 'class_id' => $class_id,
        'section_id' => $section_id, 'year' => $running_year,
        'subject_id' => $subject_id))->result_array();
        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $labouno = $this->input->post('lab_uno_'.$row['mark_id']);
            $labodos = $this->input->post('lab_dos_'.$row['mark_id']);
            $labotres = $this->input->post('lab_tres_'.$row['mark_id']);
            $labocuatro = $this->input->post('lab_cuatro_'.$row['mark_id']);
            $labocinco = $this->input->post('lab_cinco_'.$row['mark_id']);
            $laboseis = $this->input->post('lab_seis_'.$row['mark_id']);
            $labosiete = $this->input->post('lab_siete_'.$row['mark_id']);
            $laboocho = $this->input->post('lab_ocho_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
            $labonueve = $this->input->post('lab_nueve_'.$row['mark_id']);
            $labototal = $obtained_marks + $labouno + $labodos + $labotres + $labocuatro + $labocinco + $laboseis + $labosiete + $laboocho + $labonueve;

            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'labuno' => $labouno
            , 'labdos' => $labodos, 'labtres' => $labotres, 'labcuatro' => $labocuatro, 'labcinco' => $labocinco, 'labseis' => $laboseis
                , 'labsiete' => $labosiete, 'labocho' => $laboocho, 'labnueve' => $labonueve, 'labtotal' => $labototal, 'comment' => $comment));
        }
        redirect(base_url().'index.php?admin/marks_upload/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }

    function tab_sheet($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] , 'refresh');
            } else {
                redirect(base_url() . 'index.php?admin/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'tab_sheet';
        $page_data['page_title'] = get_phrase('Tabulation');
        $this->load->view('backend/index', $page_data);
    
    }

    function tab_sheet_print($class_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $this->load->view('backend/admin/tab_sheet_print' , $page_data);
    }

    function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/marks_get_subject' , $page_data);
    }

    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine_add/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('class_routine' , array('class_routine_id' => $param2))->row()->class_id;
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $class_id, 'refresh');
        } 
    }

    function exam_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['fecha']          = $this->input->post('fecha');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('horarios_examenes', $data);
            redirect(base_url() . 'index.php?admin/add_exam_routine/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['fecha']          = $this->input->post('fecha');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->where('horario_id', $param2);
            $this->db->update('horarios_examenes', $data);
            redirect(base_url() . 'index.php?admin/looking_routine/' . $data['class_id'], 'refresh');
        } else if ($param1 == 'edit') 
        {
            $page_data['edit_data'] = $this->db->get_where('horarios_examenes', array(
                'horaio_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('horarios_examenes' , array('horario_id' => $param2))->row()->class_id;
            $this->db->where('horario_id', $param2);
            $this->db->delete('horarios_examenes');
            redirect(base_url() . 'index.php?admin/looking_routine/' . $class_id, 'refresh');
        }
    }

    function looking_routine($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'looking_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = "Horarios de evaluaciones";
        $this->load->view('backend/index', $page_data);
    }

    function add_exam_routine()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'add_exam_routine';
        $page_data['page_title'] = get_phrase('Exam-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function videos()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'videos';
        $page_data['page_title'] = get_phrase('GalleryPic');
        $this->load->view('backend/index', $page_data);
    }

    function add_gallery_image()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'add_gallery_image';
        $page_data['page_title'] = get_phrase('GalleryPic');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_add';
        $page_data['page_title'] = get_phrase('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_view($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_view';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_section_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector' , $page_data);
    }

    function section_subject_edit($class_id , $class_routine_id)
    {
        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_subject_edit' , $page_data);
    }

    function attendance()
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        
        $page_data['page_name']  =  'attendance';
        $page_data['page_title'] =  get_phrase('Attendance');
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance($class_id = '' , $section_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('Attendance');
        $this->load->view('backend/index', $page_data);
    }

    function get_section($class_id) 
    {
          $page_data['class_id'] = $class_id; 
          $this->load->view('backend/admin/manage_attendance_section_holder' , $page_data);
    }

    function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
        $query = $this->db->get_where('attendance' ,array(
            'class_id'=>$data['class_id'],
                'section_id'=>$data['section_id'],
                    'year'=>$data['year'],
                        'timestamp'=>$data['timestamp']));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
        redirect(base_url().'index.php?admin/manage_attendance/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
    }

    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));
        }
        redirect(base_url().'index.php?admin/manage_attendance/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
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
         if($this->session->userdata('admin_login')!=1)
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

    function news_view($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        else if ($param1 == 'details') 
        {
            $page_data['room_page'] = 'details';
            $page_data['news_code'] = $param2;
        }
        $page_data['page_name']   = 'news_room'; 
        $page_data['page_title']  = get_phrase('Details');
        $page_data['page_title'] .=  ": " . $this->db->get_where('news',array('news_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function news_message($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') 
        {
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php?admin/news_view/details/' . $param2, 'refresh');
        }
    }

    function notice_message($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') 
        {
            $this->crud_model->create_notice_message($param2);
        }
    }

    function reload_comment($news_code = '') 
    {
        $page_data['news_code'] =   $news_code;
        $this->load->view('backend/admin/comment' , $page_data);
    }

     function reload_comment_notice($notice_code = '') 
    {
        $page_data['notice_code'] =   $notice_code;
        $this->load->view('backend/admin/comment_notice' , $page_data);
    }

    function news($param1 = '', $param2 = '') 
    {
        if ($param1 == 'create') 
        {
            $news_code = $this->crud_model->create_news();
            redirect(base_url() . 'index.php?admin/news_view/details/' . $news_code , 'refresh');
        }
        if ($param1 == 'mark_as_archive') 
        {
            $this->db->where('news_code' , $param2);
            $this->db->update('news' , array('news_status' => 0));
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('news_code' , $param2);
            $this->db->delete('news');
            redirect(base_url() . 'index.php?admin/news/', 'refresh');
        }

        $page_data['page_name'] = 'news';
        $page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('backend/index', $page_data);
    }

    function enviar_noticia() 
    {
        $page_data['page_name'] = 'enviar_noticia';
        $page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url().'index.php?admin/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'],'refresh');
    }

    function unit_content($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;
        $page_data['page_name']  = 'unit_content';
        $page_data['page_title'] = get_phrase('Semester-Content');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function upload_unit_content()
    {
        $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['title']                  =   $this->input->post('title');
        $data['description']            =   $this->input->post('description');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']             =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/syllabus/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');
        $data['file_name'] = $_FILES['file_name']['name'];
        $this->db->insert('academic_syllabus', $data);
        redirect(base_url() . 'index.php?admin/unit_content/' . $data['class_id'] , 'refresh');
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

    function delete_unit_content($academic_syllabus_id)
    {
        $this->crud_model->delete_unit($academic_syllabus_id);
        redirect(base_url() . 'index.php?admin/unit_content/' . $data['class_id'] , 'refresh');
    }

    function students_payments($param1 = '' , $param2 = '')
    {
       if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']  = 'students_payments';
        $page_data['page_title'] = get_phrase('StudentPayment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data); 
    }

    function payments($param1 = '' , $param2 = '' , $param3 = '') 
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']  = 'payments';
        $page_data['page_title'] = get_phrase('Students-Payments');
        $this->load->view('backend/index', $page_data); 
    }

    function expense($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data);
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->where('payment_id' , $param2);
            $this->db->update('payment' , $data);
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('payment_id' , $param2);
            $this->db->delete('payment');
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('Expense');
        $this->load->view('backend/index', $page_data); 
    }

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            redirect(base_url() . 'index.php?admin/expense');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            redirect(base_url() . 'index.php?admin/expense');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            redirect(base_url() . 'index.php?admin/expense');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('Expense-Category');
        $this->load->view('backend/index', $page_data);
    }

    function school_bus($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['driver_name'] = $this->input->post('driver_name');
            $data['driver_phone'] = $this->input->post('driver_phone');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->insert('transport', $data);
            redirect(base_url() . 'index.php?admin/school_bus', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['driver_name']       = $this->input->post('driver_name');
            $data['driver_phone']       = $this->input->post('driver_phone');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            redirect(base_url() . 'index.php?admin/school_bus', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                'transport_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            redirect(base_url() . 'index.php?admin/school_bus', 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'school_bus';
        $page_data['page_title'] = get_phrase('Manage-School-Bus');
        $this->load->view('backend/index', $page_data); 
    }

    function classrooms($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') 
        {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            $this->db->insert('dormitory', $data);
            redirect(base_url() . 'index.php?admin/classrooms', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description']    = $this->input->post('description');
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            redirect(base_url() . 'index.php?admin/classrooms', 'refresh');
        } else if ($param1 == 'edit') 
        {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                'dormitory_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            redirect(base_url() . 'index.php?admin/classrooms', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'classroom';
        $page_data['page_title']  = get_phrase('Manage-Classrooms');
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'send_new') 
        {
            $message_thread_code = $this->crud_model->send_new_private_message();
            redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') 
        {
            $this->crud_model->send_reply_message($param2);
            redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
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

    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {
             
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);
 
            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('rtl');
            $this->db->where('type' , 'rtl');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('running_year');
            $this->db->where('type' , 'running_year');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'socials') {
             
            $data['description'] = $this->input->post('facebook_url');
            $this->db->where('type' , 'facebook_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twitter_url');
            $this->db->where('type' , 'twitter_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('google_url');
            $this->db->where('type' , 'google_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('linkedin_url');
            $this->db->where('type' , 'linkedin_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('pinterest_url');
            $this->db->where('type' , 'pinterest_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('instagram_url');
            $this->db->where('type' , 'instagram_url');
            $this->db->update('settings' , $data);
 
            $data['description'] = $this->input->post('dribbble_url');
            $this->db->where('type' , 'dribbble_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('youtube_url');
            $this->db->where('type' , 'youtube_url');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'ad') {
            $data['description'] = $this->input->post('ad');
            $this->db->where('type' , 'ad');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }

        if ($param1 == 'upload_slider') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider1.png');
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_slider2') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider2.png');
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_slider3') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider3.png');
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if($param1 == 'skin_colour')
        {
            $data['description'] = $this->input->post('skin_colour');
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('System-Settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function academic_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'do_update') {
             
            $data['description'] = $this->input->post('limit_upload');
            $this->db->where('type' , 'limit_upload');
            $this->db->update('academic_settings' , $data);

            $data['description'] = $this->input->post('allowed_marks');
            $this->db->where('type' , 'allowed_marks');
            $this->db->update('academic_settings' , $data);

            $data['description'] = $this->input->post('max_mark');
            $this->db->where('type' , 'max_mark');
            $this->db->update('academic_settings' , $data);

            $data['description'] = $this->input->post('report_teacher');
            $this->db->where('type' , 'report_teacher');
            $this->db->update('academic_settings' , $data);

            $data['description'] = $this->input->post('minium_mark');
            $this->db->where('type' , 'minium_mark');
            $this->db->update('academic_settings' , $data);

            $data['description'] = $this->input->post('minium_average');
            $this->db->where('type' , 'minium_average');
            $this->db->update('academic_settings' , $data);

            $data['description'] = $this->input->post('teacher_average');
            $this->db->where('type' , 'teacher_average');
            $this->db->update('academic_settings' , $data);

            redirect(base_url() . 'index.php?admin/academic_settings/', 'refresh');
        }

        $page_data['page_name']  = 'academic_settings';
        $page_data['page_title'] = get_phrase('Academic-Settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') 
        {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['class_id']    = $this->input->post('class_id');
            $data['status']    = $this->input->post('status');
            $this->db->insert('book', $data);
            redirect(base_url() . 'index.php?admin/library', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price']       = $this->input->post('price');
            $data['author']      = $this->input->post('author');
            $data['status']    = $this->input->post('status');
            $data['class_id']    = $this->input->post('class_id');
            
            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            redirect(base_url() . 'index.php?admin/library', 'refresh');
        }
        else if ($param1 == 'edit') 
         {
            $page_data['edit_data'] = $this->db->get_where('book', array('book_id' => $param2))->result_array();
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            redirect(base_url() . 'index.php?admin/library', 'refresh');
        }
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('Library');
        $this->load->view('backend/index', $page_data);
    }

     function marks_print_view($student_id , $exam_id) 
     {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/marks_print_view', $page_data);
    }

    function get_session_changer()
    {
        $this->load->view('backend/admin/change_session');
    }

    function change_session()
    {
        $data['description'] = $this->input->post('running_year');
        $this->db->where('type' , 'running_year');
        $this->db->update('settings' , $data);
        redirect(base_url() . 'index.php?admin/dashboard/', 'refresh'); 
    }

    function files($task = "", $id_poa = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }       
        if ($task == "create")
        {
            $this->crud_model->guardar_poa();
            redirect(base_url() . 'index.php?admin/files' , 'refresh');
        }
        if ($task == "delete")
        {
            $this->crud_model->borrar_poa($id_poa);
            redirect(base_url() . 'index.php?admin/files');
        }
        $data['poa_info']    = $this->crud_model->obtener_poa();
        $data['page_name']              = 'files';
        $data['page_title']             = get_phrase('Documents-Teachers');
        $this->load->view('backend/index', $data);
    }

    function search($search_key = '') 
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ( $_POST ) {
            redirect(base_url() . 'index.php?admin/search/' . $this->input->post('search_key') , 'refresh');
        }
        $page_data['search_key']    =   $search_key;
        $page_data['page_name']     =   'search';
        $page_data['page_title']    =   get_phrase('Search-Result');
        $this->load->view('backend/index', $page_data);
    }

    function reload_search_result_body() 
    {
        $page_data['search_key']    =   $this->input->post('search_key');
        $this->load->view('backend/admin/search_result', $page_data);
    }
}