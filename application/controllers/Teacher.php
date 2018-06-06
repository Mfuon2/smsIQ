<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends CI_Controller
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
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/teacher_dashboard', 'refresh');
    }
    
     function video_detail($category_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'videos';
        $page_data['page_title'] = get_phrase('GalleryPic');
        $this->load->view('backend/index', $page_data);
    }


    function events($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_title']    = get_phrase('Events');
        $page_data['page_name']  = 'events';
        $this->load->view('backend/index', $page_data);
    }

    function courses($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'coursess';
        $page_data['page_title'] = get_phrase('Manage-Subjects');
        $this->load->view('backend/index', $page_data);
    }
    
    function teacher_dashboard()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'teacher_dashboard';
        $page_data['page_title'] = get_phrase('Teacher-Dashboard');
        $this->load->view('backend/index', $page_data);
    }

     function pages_view($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
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

    function tab_sheet($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?teacher/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] , 'refresh');
            } else {
                redirect(base_url() . 'index.php?teacher/tab_sheet/', 'refresh');
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
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $this->load->view('backend/teacher/tab_sheet_print' , $page_data);
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
    function get_class_subject($class_id) 
    {
        $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) 
        {
            if ($this->session->userdata('login_user_id') == $row['teacher_id'])
            {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
            }
        }
    }

    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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

    function students_area($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']     = 'students_area';
        $page_data['page_title']    = get_phrase('Students') ." - ".get_phrase('Class')." : ".
        $this->crud_model->get_class_name($class_id);
        $page_data['class_id']  = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_portal($student_id, $param1='')
    {
         if ($this->session->userdata('teacher_login') != 1)
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

    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
     
        if ($param1 == 'do_update') 
        {
            $data['la1']       = $this->input->post('la1');
            $data['la2']       = $this->input->post('la2');
            $data['la3']       = $this->input->post('la3');
            $data['la4']       = $this->input->post('la4');
            $data['la5']       = $this->input->post('la5');
            $data['la6']       = $this->input->post('la6');
            $data['la7']       = $this->input->post('la7');
            $data['la8']       = $this->input->post('la8');
            $data['la9']       = $this->input->post('la9');
            $data['final']     = $this->input->post('final');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            redirect(base_url() . 'index.php?teacher/teacher_dashboard', 'refresh');
        } 
		else if ($param1 == 'edit') {
         $page_data['edit_data'] = $this->db->get_where('subject', array('subject_id' => $param2))->result_array();
        }

		$page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1,
            'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('Subjects');
        $this->load->view('backend/index', $page_data);
    }
    
	function viendo_horarios($class_id)
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'viendo_horarios';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('Exam-Routine');
        $this->load->view('backend/index', $page_data);
    }
    
    function upload_marks()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name']  =   'upload_marks';
        $page_data['page_title'] = get_phrase('Upload-Marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_upload($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
        if ($this->session->userdata('teacher_login') != 1)
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
                                    'year' => $data['year']
                ));

        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) 
            {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
        redirect(base_url() . 'index.php?teacher/marks_upload/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] , 'refresh');
        
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
            $labonueve = $this->input->post('lab_nueve_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
             $labototal = $obtained_marks + $labouno + $labodos + $labotres + $labocuatro + $labocinco + $laboseis + $labosiete + $laboocho + $labonueve + $labfinal;
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'labuno' => $labouno
            , 'labdos' => $labodos, 'labtres' => $labotres, 'labcuatro' => $labocuatro, 'labcinco' => $labocinco, 'labseis' => $laboseis
                , 'labsiete' => $labosiete, 'labocho' => $laboocho, 'labnueve' => $labonueve, 'labtotal' => $labototal, 'comment' => $comment));
        }
        redirect(base_url().'index.php?teacher/marks_upload/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }

    function virtual_library($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'virtual_library';
        $page_data['page_title'] = get_phrase('Virtual-Library');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function files($task = "", $id_poa = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }       

        $data['poa_info']    = $this->crud_model->obtener_poa();
        $data['page_name']              = 'files';
        $data['page_title']             = get_phrase('Documents-Teachers');
        $this->load->view('backend/index', $data);
    }

    function subir_libro()
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
        redirect(base_url() . 'index.php?teacher/virtual_library/' . $data['class_id'] , 'refresh');
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

    function newsroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
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

    function noticeroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'wall') {
            $page_data['room_page']    = 'notice_wall';
            $page_data['notice_code'] = $param2; 
        }
        else if ($param1 == 'overview') {
            $page_data['room_page'] = 'notice_overview';
            $page_data['notice_code'] = $param2;
        }

        $page_data['page_name']   = 'notice_room'; 
        $page_data['page_title']  = get_phrase('Details');
        $page_data['page_title'] .=  ": " . $this->db->get_where('news_teacher',array('notice_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function news_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php?teacher/newsroom/overview/' . $param2, 'refresh');
        }
    }

    function notice_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_notice_message($param2);
        }
    }

    function reload_projectroom_wall($news_code = '') {
        $page_data['news_code'] =   $news_code;
        $this->load->view('backend/teacher/project_wall' , $page_data);
    }

    function reload_noticeroom_wall($notice_code = '') {
        $page_data['notice_code'] =   $notice_code;
        $this->load->view('backend/teacher/notice_wall' , $page_data);
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

    function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/teacher/marks_get_subject' , $page_data);
    }

    function homework($param1 = '', $param2 = '') 
    {
        if ($param1 == 'create') 
        {
            $homework_code = $this->crud_model->homework_create();
            redirect(base_url() . 'index.php?teacher/homeworkroom/details/' . $homework_code , 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud_model->update_homework($param2);
            redirect(base_url() . 'index.php?teacher/homeworkroom/edit/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete'){
            $this->crud_model->delete_homework($param2);
            redirect(base_url() . 'index.php?teacher/homework', 'refresh');
        }

        $page_data['page_name'] = 'homework';
        $page_data['page_title'] = get_phrase('Homework');
        $this->load->view('backend/index', $page_data);
    }

    function homework_add() 
    {    
        $page_data['page_name'] = 'homework_add';
        $page_data['page_title'] = get_phrase('Send-Homework');
        $this->load->view('backend/index', $page_data);
    }

    function unit_content($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
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
        redirect(base_url() . 'index.php?teacher/unit_content/' . $data['class_id'] , 'refresh');
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
    
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
            redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('My-Profile');
        $page_data['edit_data']  = $this->db->get_where('teacher', array(
            'teacher_id' => $this->session->userdata('teacher_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function class_routine($class_id)
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance($class_id)
    {
        if($this->session->userdata('teacher_login')!=1)
            redirect(base_url() , 'refresh');

        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['page_name']  =  'manage_attendance';
        $page_data['class_id']   =  $class_id;
        $page_data['page_title'] =  get_phrase('Daily-Attendance') . ' ' . $class_name;
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance_view($class_id = '' , $section_id = '' , $timestamp = '')
    {
        if($this->session->userdata('teacher_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_view';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('Daily-Attendance') . ' ' . $class_name . ' : ' . get_phrase('Section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
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
                        'timestamp'=>$data['timestamp']
        ));
        if($query->num_rows() < 1) {
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
        redirect(base_url().'index.php?teacher/manage_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
    }

    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) 
        {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));
        }
        redirect(base_url().'index.php?teacher/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }
    
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        } 
        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            redirect(base_url() . 'index.php?teacher/study_material' , 'refresh');
        }
        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            redirect(base_url() . 'index.php?teacher/study_material' , 'refresh');
        }
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(base_url() . 'index.php?teacher/study_material');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('Study-Material');
        $this->load->view('backend/index', $data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');

        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('Library');
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            redirect(base_url() . 'index.php?teacher/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);
            redirect(base_url() . 'index.php?teacher/message/message_read/' . $param2, 'refresh');
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

    function request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }    
        if ($param1 == "create")
        {
            $this->crud_model->permission_request();
            redirect(base_url() . 'index.php?teacher/request', 'refresh');
        }
        
        $data['page_name']  = 'request';
        $data['page_title'] = get_phrase('My-Permissions');
        $this->load->view('backend/index', $data);
    }

    function homeworkroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
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
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }

        $page_data['page_name']   = 'homework_room'; 
        $page_data['page_title']  = get_phrase('Homework');
        $page_data['page_title'] .=  " : " . $this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function reload_homeworkroom_details($homework_code = '') {
        $page_data['homework_code'] =   $homework_code;
        $this->load->view('backend/teacher/homework_details' , $page_data);
    }

    function homework_file($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $homework_code = $this->db->get_where('homework', array('homework_id'))->row()->homework_code;
        if ($param1 == 'upload')
        {
            $this->crud_model->upload_homework_file($param2);
        }
        else if ($param1 == 'download')
        {
            $this->crud_model->download_homework_file($param2);
        }
        else if ($param1 == 'delete')
        {
            $this->crud_model->delete_homework_file($param2);
            redirect(base_url() . 'index.php?teacher/homeworkroom/details/' . $homework_code , 'refresh');
        }
    }

    function reload_homework_list() {
        $this->load->view('backend/teacher/homework_list');
    }

    function forum($param1 = '', $param2 = '') 
    {
        if ($param1 == 'create') 
        {
            $post_code = $this->crud_model->create_post();
            redirect(base_url() . 'index.php?teacher/forumroom/posts/' . $post_code , 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud_model->update_post($param2);
            redirect(base_url() . 'index.php?teacher/forumroom/edit/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete')
            $this->crud_model->delete_post($param2);

        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = get_phrase('ClassForum');
        $this->load->view('backend/index', $page_data);
    }

    function create_exam($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1 == 'create')
        {
            $this->crud_model->create_online_exam();
            redirect(base_url() . 'index.php?teacher/create_exam/', 'refresh');
        }

        $page_data['page_name']  = 'create_exam';
        $page_data['page_title'] = "Add New Online Exam";
        $this->load->view('backend/index', $page_data);
    }

    function manage_exams($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if($param1 == 'delete')
        {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exams');
            redirect(base_url() . 'index.php?teacher/online_exams/', 'refresh');
        }
    }

    function online_exams($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($param1 == 'edit') 
        {
            $this->crud_model->update_exam($param2);
            redirect(base_url() . 'index.php?teacher/examroom/exam/' . $param2 , 'refresh');
        }
        if ($param1 == 'questions') 
        {
            $this->crud_model->add_questions();
            redirect(base_url() . 'index.php?teacher/examroom/exam_questions/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete_questions') 
        {
            $this->crud_model->delete_questions($param2);
            redirect(base_url() . 'index.php?teacher/online_exams/', 'refresh');

        }
        if ($param1 == 'delete'){
            $this->crud_model->delete_exam($param2);
            redirect(base_url() . 'index.php?teacher/online_exams', 'refresh');
        }

        $page_data['page_name'] = 'online_exams';
        $page_data['page_title'] = get_phrase('ClassForum');
        $this->load->view('backend/index', $page_data);
    }

    function examroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'exam') 
        {
            $page_data['room_page'] = 'exam';
            $page_data['exam_code'] = $param2; 
        }
        else if ($param1 == 'exam_questions') 
        {
            $page_data['room_page'] = 'exam_questions';
            $page_data['exam_code'] = $param2;
        }
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'exam_edit';
            $page_data['exam_code'] = $param2;
        }

        $page_data['page_name']   = 'exam_room'; 
        $page_data['page_title']  = "Foro del Curso";
        $page_data['page_title'] .=  " : " . $this->db->get_where('exams',array('exam_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function post_add() 
    {    
        $page_data['page_name'] = 'post_add';
        $page_data['page_title'] = "Create Post";
        $this->load->view('backend/index', $page_data);
    }

    function forumroom($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
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
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'post_edit';
            $page_data['post_code'] = $param2;
        }

        $page_data['page_name']   = 'forum_room'; 
        $page_data['page_title']  = "Foro del Curso";
        $page_data['page_title'] .=  " : " . $this->db->get_where('forum',array('post_code'=>$param2))->row()->title;
        $this->load->view('backend/index', $page_data);
    }

    function forum_message($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') 
        {
            $this->crud_model->create_post_message($param2);
            redirect(base_url() . 'index.php?teacher/forumroom/posts/' . $param2, 'refresh');
        }
    }
}