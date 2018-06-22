<?php
/**
 * Created by PhpStorm.
 * User: Mfuon
 * Date: 06/22/2018
 * Time: 10:50 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}