<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function query_cek_login($u,$p)
    {
        //$u = set_value('a');
        //$p = set_value('b');

        //Query db
        $result =  $this->db->where('usnm',$u)
                            //->where('password',md5($password))
                            ->where('pasw',$p)
                            ->limit(1)
                            ->get('tb_user');

        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return FALSE;
        }
    }

}

