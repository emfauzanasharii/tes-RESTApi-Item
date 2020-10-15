<?php

class M_item extends CI_Model
{
 public function get_all_item()
    {
            $hsl= $this->db->get('tbl_data');
            return $hsl->result();    
        
    }

  public function get_search($search){
$hsl=$this->db->query("SELECT * FROM tbl_data where kode='$search' or nama='$search'");
return $hsl->result();
  }

  function get_kode(){
		$q = $this->db->query("SELECT MAX(RIGHT(kode,4)) AS kd_max FROM tbl_data");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return date('dmY').$kd;
	}
	public function cek_nama($nama){
		$hsl=$this->db->query("SELECT nama from tbl_data where nama='$nama'");
		return $hsl->num_rows();
	}
	 public function simpan($data)
    {
        $this->db->insert('tbl_data', $data);
        return $this->db->affected_rows();
    }

   public function hapus($kode){
		$this->db->delete('tbl_data', ['kode'=> $kode]);
        return $this->db->affected_rows();
	}

public function cek_item($kode){
	$hsl=$this->db->query("SELECT * FROM tbl_data where kode='$kode'");
	return $hsl->row();
}

public function update($data, $kode)
    {
        $this->db->update('tbl_data', $data, ['kode'=>$kode]);
        return $this->db->affected_rows();
    }
}
