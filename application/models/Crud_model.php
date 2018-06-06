<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }

    function email_exists($email)
    {
        $this->db->where('email',$email);
        $query = $this->db->get('student');
        if ($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }  
    }

    function create_online_exam()
    {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['availablefrom'] = $this->input->post('availablefrom');
        $data['availableto'] = $this->input->post('availableto');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['duration'] = $this->input->post('duration');
        $data['pass'] = $this->input->post('pass');
        $data['questions'] = $this->input->post('questions');
        $data['teacher_id']  =   $this->session->userdata('login_user_id');
        $data['exam_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('exams', $data);
    }

     function create_post() {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name']         = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['timestamp'] = strtotime(date("d M,Y"));
        $data['subject_id'] = $this->input->post('subject_id');
        $data['teacher_id']  =   $this->session->userdata('login_user_id');
        $data['post_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('forum', $data);
        $post_code = $this->db->get_where('forum', array('post_id' => $this->db->insert_id()))->row()->post_code;
        $docs_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/forum/" . $_FILES["file_name"]["name"]);
        return $post_code;
    }

    function homework_create() {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end'] = $this->input->post('time_end');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name']         = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['uploader_type']  =   $this->session->userdata('login_type');
        $data['uploader_id']  =   $this->session->userdata('login_user_id');
        $data['homework_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['homework_status'] = 1;
        $this->db->insert('homework', $data);
        $homework_code = $this->db->get_where('homework', array('homework_id' => $this->db->insert_id()))->row()->homework_code;
        $doc_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/homework/" . $_FILES["file_name"]["name"]);
        return $homework_code;
    }

    function update_homework($homework_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end'] = $this->input->post('time_end');
        $this->db->where('homework_code', $homework_code);
        $this->db->update('homework', $data);
    }

    function update_post($post_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $this->db->where('post_code', $post_code);
        $this->db->update('forum', $data);
    }

    function update_exam($exam_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['availablefrom'] = $this->input->post('availablefrom');
        $data['availableto'] = $this->input->post('availableto');
        $data['pass'] = $this->input->post('pass');
        $data['questions'] = $this->input->post('questions');
        $data['duration'] = $this->input->post('duration');
        $this->db->where('exam_code', $exam_code);
        $this->db->update('exams', $data);
    }

    function add_questions() {
        $data['question'] = $this->input->post('question');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['exam_code'] = $this->input->post('exam_code');
        $data['optiona'] = $this->input->post('optiona');
        $data['optionb'] = $this->input->post('optionb');
        $data['optionc'] = $this->input->post('optionc');
        $data['optiond'] = $this->input->post('optiond');
        $data['correctanswer'] = $this->input->post('correctanswer');
        $data['marks'] = $this->input->post('marks');
        $this->db->insert('questions', $data);
    }

    function create_post_message($post_code = '') {
        $data['message'] = $this->input->post('message');
        $data['post_id'] = $this->db->get_where('forum', array('post_code' => $post_code))->row()->post_id;
        $data['date'] = date("d M Y");
        $data['user_type'] = $this->session->userdata('login_type');
        $data['user_id'] = $this->session->userdata('login_user_id');
        $this->db->insert('forum_message', $data);
    }

    function delete_homework($homework_code) {
        $this->db->where('homework_code', $homework_code);
        $this->db->delete('homework');
    }

     function delete_post($post_code) {
        $this->db->where('post_code', $post_code);
        $this->db->delete('forum');
    }

    function admin_create() {
        $data['name']         =   $this->input->post('name');
        $data['username']     =   $this->input->post('username');
        $data['email']        =   $this->input->post('email');
        $data['password']     =   sha1($this->input->post('password'));
        $data['phone']        =   $this->input->post('phone');
        $data['address']      =   $this->input->post('address');
        $data['owner_status'] =   $this->input->post('owner_status');
        $this->db->insert('admin' , $data);
        $new_admin_id     =   $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $new_admin_id . '.jpg');
    }

    function admin_edit($admin_id) {
        $data['name']         =   $this->input->post('name');
        $data['username']     =   $this->input->post('username');
        $data['email']        =   $this->input->post('email');
        $data['phone']        =   $this->input->post('phone');
        $data['address']      =   $this->input->post('address');
        $data['birthday']     =   $this->input->post('birthday');
        $data['status']       =   $this->input->post('status');
        $this->db->where('admin_id' , $admin_id);
        $this->db->update('admin' , $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $admin_id . '.jpg');
    }

    function admin_pass($admin_id){
        $data['new_password'] = sha1($this->input->post('new_password'));
        $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) 
            {
                $this->db->where('admin_id', $admin_id);
                $this->db->update('admin', array('password' => $data['new_password']));
            } 
    }

    function admin_delete($admin_id) {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin');
    }

    function delete_questions($question_id) {
        $this->db->where('question_id', $question_id);
        $this->db->delete('questions');
    }

    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_exams() {
        $query = $this->db->get_where('exam' , array(
            'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ));
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_obtained_marks( $exam_id , $class_id , $subject_id , $student_id) {
        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $subject_id,
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                                        
        foreach ($marks as $row) {
            echo $row['mark_obtained'];
            echo $row['labuno'];
            echo $row['labdos'];
            echo $row['labtres'];
            echo $row['labcuatro'];
            echo $row['labcinco'];
            echo $row['labseis'];
            echo $row['labsiete'];
            echo $row['labocho'];
            echo $row['labnueve'];
        }
    }

    function get_highest_marks( $exam_id , $class_id , $subject_id ) {
        $this->db->where('exam_id' , $exam_id);
        $this->db->where('class_id' , $class_id);
        $this->db->where('subject_id' , $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function get_image_video($type = '', $id = '') 
    {
         if (file_exists('uploads/screen/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/screen/' . $id . '.jpg';
        else $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function save_study_material_info(){
        $data['timestamp']         = strtotime(date("Y-m-d H:i:s"));
        $data['title'] 		       = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        $data['file_name'] 	       = $_FILES["file_name"]["name"];
        $data['file_type']     	   = $this->input->post('file_type');
        $data['class_id'] 	       = $this->input->post('class_id');
        $data['subject_id']         = $this->input->post('subject_id');
        $this->db->insert('document',$data);
        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }

    function guardar_poa(){
        $data['timestamp']         = strtotime($this->input->post('timestamp'));
        $data['titulo']             = $this->input->post('title');
        $data['descripcion']       = $this->input->post('description');
        $data['nombre_archivo']         = $_FILES["file_name"]["name"];
        $data['tipo_archivo']         = $this->input->post('file_type');
        $this->db->insert('poa',$data);
        $id_poa            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/poa/" . $_FILES["file_name"]["name"]);
    }
    
    function select_study_material_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array(); 
    }

    function create_news() {
        $data['title']               = $this->input->post('title');
        $data['news_code']        = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['description']         = $this->input->post('description');
        $this->db->insert('news', $data);
        $news_code = $this->db->get_where('news' , array('news_id' => $this->db->insert_id()))->row()->news_code;
        return $news_code;
    }

    function delete_news($news_code) 
    {
        $this->db->where('news_code', $news_code);
        $this->db->delete('news');
    }

    function delete_unit($academic_syllabus_id) {
        $this->db->where('academic_syllabus_id', $academic_syllabus_id);
        $this->db->delete('academic_syllabus');
    }

    function delete_book($libro_id) {
        $this->db->where('libro_id', $libro_id);
        $this->db->delete('libreria');
    }

    function create_news_message($news_code = '') 
    {
        $data['message']      = $this->input->post('message');
        $data['news_id']   = $this->db->get_where('news' , array('news_code' => $news_code))->row()->news_id;
        $data['date']         = date("d M Y");
        $data['user_type']    = $this->session->userdata('login_type');
        $data['user_id']      = $this->session->userdata('login_user_id');
        if ( $_FILES['userfile']['name'] != '')
            $data['message_file_name'] = $_FILES['userfile']['name'];
        $this->db->insert('mensaje_reporte', $data);
        if ( $_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/project_message_file/' . $_FILES['userfile']['name']);
        
    }    

     function create_notice_message($notice_code = '') 
    {
        $data['message']      = $this->input->post('message');
        $data['notice_id']   = $this->db->get_where('news_teacher' , array('notice_code' => $notice_code))->row()->notice_id;
        $data['date']         = date("d M Y");
        $data['user_type']    = $this->session->userdata('login_type');
        $data['user_id']      = $this->session->userdata('login_user_id');
        if ( $_FILES['userfile']['name'] != '')
            $data['message_file_name'] = $_FILES['userfile']['name'];
        $this->db->insert('notice_message', $data);
        if ( $_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/notice_message_file/' . $_FILES['userfile']['name']);
        
    }   

    function obtener_poa()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('poa')->result_array(); 
    }

    function get_pages()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('pages')->result_array(); 
    }
    
    function select_study_material_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $class_id   = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
                'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->row()->class_id;
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('class_id' => $class_id))->result_array();
    }
    
    function update_study_material_info($document_id)
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		= $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['class_id'] 	= $this->input->post('class_id');
        $data['subject_id']     = $this->input->post('subject_id');
        $this->db->where('document_id',$document_id);
        $this->db->update('document',$data);
    }

    function actualizar_poa($document_id)
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title']      = $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['class_id']   = $this->input->post('class_id');
        $data['subject_id']     = $this->input->post('subject_id');
        $this->db->where('document_id',$document_id);
        $this->db->update('document',$data);
    }
    
    function delete_study_material_info($document_id)
    {
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }

    function borrar_poa($id_poa)
    {
        $this->db->where('id_poa',$id_poa);
        $this->db->delete('poa');
    }

    function delete_page($page_id)
    {
        $this->db->where('page_id',$page_id);
        $this->db->delete('pages');
    }

    function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code) {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }
    
    function create_report() 
    {
        $data['title']          = $this->input->post('title');
        $data['report_code']    = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['priority']       = $this->input->post('priority');
        $data['teacher_id']     = $this->input->post('teacher_id');
        $login_type             = $this->session->userdata('login_type');
        if($login_type == 'student')
            $data['student_id']  = $this->session->userdata('login_user_id');
        else 
            $data['student_id']  = $this->input->post('student_id');
        
        $data['timestamp']      = date("d M,Y");
        $this->db->insert('reporte_alumnos', $data);
        $data2['report_code']   = $data['report_code'];
        $data2['message']       = $this->input->post('description');
        $data2['timestamp']     = date("d M,Y");
        $data2['sender_type']   = $this->session->userdata('login_type');
        $data2['sender_id']     = $this->session->userdata('login_user_id');
        if($_FILES['file']['name'] != '')
            $data2['file']          = $_FILES['file']['name'];

        $this->db->insert('reporte_mensaje', $data2);
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/reportes_alumnos/' . $_FILES['file']['name']);
    }

     function delete_report($report_code) {
        $this->db->where('report_code', $report_code);
        $this->db->delete('reporte_alumnos');
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    function permission_request()
    {
        $data['teacher_id']   = $this->session->userdata('login_user_id');
        $data['description']  = $this->input->post('description');
        $data['title']        = $this->input->post('title');
        $data['start_date']   = $this->input->post('start_date');
        $data['end_date']     = $this->input->post('end_date');

        $this->db->insert('request', $data);
    }
}