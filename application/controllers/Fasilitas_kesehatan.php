<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Fasilitas_kesehatan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //menampilkan data
    public function index_get() {

        $id = $this->get('id');
        $fasilitas=[];
        if ($id == '') {
            $data = $this->db->get('fasilitas_Kesehatan')->result();
            foreach ($data as $row=>$key):
                $fasilitas[]=["id"=>$key->id,
                            "tahun"=>$key->tahun,
                            "wilayah"=>$key->wilayah,
                            "fasilitas"=>$key->fasilitas,
                            "jumlah"=>$key->jumlah,
                            "_links"=>[(object)["href"=>"rumahsakit/{$key->id}",
                                            "rel"=>"rumahsakit",
                                            "type"=>"GET"]]
                                        /*(object)["href"=>"puskesmas/{$key->puskesmasID}",
                                            "rel"=>"puskesmas",
                                            "type"=>"GET"]]*/
                            ]; 
            endforeach;
        } else {
                $this->db->where('id', $id);
                $data = $this->db->get('fasilitas_kesehatan')->result();
            }
            $result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
                        "code"=>200,
                        "message"=>"Response successfully",
                        "data"=>$fasilitas];
            $this->response($result, 200);
            }
        }
?>