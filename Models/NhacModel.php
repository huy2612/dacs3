<?php 

class NhacModel extends BaseModel
{
    const TABLE_NAME="DANHSACH"
    public function getAllNhac($select=["*"], $limit="")
    {
        return $this->getAll(self::TABLE_NAME, $select, $limit);
    }

    public function getNhaccoDk($table=[self::TABLE_NAME], $select=["*"], $dieukien=[""], $dieukienphu="", $limit=[""])
    {
        $first=0;
        $dkString="";
        foreach($dieukien as $key=>$value)
        {
            if($first==0)
            {
                if($value!="")
                {
                    
                    if($key=='TENNHAC' || $key=='NGUOIHAT')
                    {
                        $dkString= $key." LIKE '%".$value."%'";
                    }
                    else if($key=='LINK' || $key=='ANH')
                    {
                        $dkString= $key." = '".$value."'";
                    }
                    else
                    {
                        $dkString= $key." = ".$value."";
                    }
                    $first=1;
                    
                    
                }
                    
                    
            }
            else
            {
                if($value!="")
                {
                    if($key=='TENNHAC' || $key=='NGUOIHAT')
                    {
                        $dkString=$dkString.' AND '.$key." LIKE '%".$value."%'";
                    }
                    else if($key=='LINK' || $key=='ANH')
                    {
                        $dkString= $dkString.' AND '.$key." = '".$value."'";
                    }
                    else
                    {
                        $dkString=$dkString.' AND '.$key." = ".$value."";
                    }
                    
                }
                
            }
            if($value!="")
            {
                if($key=='ID_PRODUCT')
                {
                    $dkString=$key.' IN('.$value.')';
                }
            }
            
        }

        if($dieukienphu!="" && $dkString!="")
        {
            $dkString=$dieukienphu.' AND '.$dkString;
        }
        else if($dieukienphu!="")
        {
            $dkString=$dieukienphu;
        }

        return $this->getById($table, $select, $dkString, $limit);
    }

    public function addNhac($data)
    {
         // echo '<pre>';
        //     print_r($data);
        // echo '</pre>';
        $s="SELECT count(TENNHAC) AS COUNT FROM ".self::TABLE_NAME." WHERE NGUOIHAT='".$data['NGUOIHAT']."'"." AND TENNHAC='".$data['TENNHAC']."'";
        
        $kq=$this->_query($s);
        $row=mysqli_fetch_assoc($kq);
        $count=$row['COUNT'];
        
        if($count==0)
        {
            $sql="INSERT INTO ".self::TABLE_NAME."(TENNHAC, LINK, ANH, NGUOIHAT) VALUES ('".$data['TENNHAC']."', '".$data['LINK']."', '".$data['ANH']."', '".$data['NGUOIHAT']."' )";
            $this->add($sql);
            //die($sql);
            //thêm vao  bang chi tiet
            // $id_product= mysqli_insert_id($this->conn);
            // foreach($data['SIZE'] as $key=>$value)
            // {
            //     $sql1="INSERT INTO chitietsanpham(ID_PRODUCT, SOLUONG, SIZE) VALUES ($id_product, $value, '".$key."')";
            //     $this->add($sql1);
            // }

            return "lưu thành công";
        }
        else
        return "đã có sản phẩm này";
    }

    public function addNhacvaoDSyeuthich($data)
    {
         // echo '<pre>';
        //     print_r($data);
        // echo '</pre>';
        $s="SELECT count(IDNHAC) AS COUNT FROM DANHSACHYEUTHICH WHERE IDUSER=".$data['IDUSER']." AND IDNHAC=".$data['IDNHAC']."";
        
        $kq=$this->_query($s);
        $row=mysqli_fetch_assoc($kq);
        $count=$row['COUNT'];
        
        if($count==0)
        {
            $sql="INSERT INTO DANHSACHYEUTHICH(IDUSER, IDNHAC) VALUES (".$data['IDUSER'].", ".$data['IDNHAC'].")";
            $this->add($sql);
            //die($sql);
            //thêm vao  bang chi tiet
            // $id_product= mysqli_insert_id($this->conn);
            // foreach($data['SIZE'] as $key=>$value)
            // {
            //     $sql1="INSERT INTO chitietsanpham(ID_PRODUCT, SOLUONG, SIZE) VALUES ($id_product, $value, '".$key."')";
            //     $this->add($sql1);
            // }

            return "lưu thành công";
        }
        else
        return "đã có sản phẩm này";
    }

    public function addPlayList($id)
    {
        $sql="INSERT INTO PLAYLISTS(IDUSER) VALUES(".$id.")";
        $this->add($sql);
    }

    public function addNhacvaoPlaylist($data=[""])
    {
        $sql="INSERT INTO NHACTRONGPLAYLIST(IDPLAYLIST, IDNHAC) VALUES(".$data['IDPLAYLIST'].", ".$data['IDNHAC'].")";
        $this->add($sql);
    }

    public function deletePlaylist($id="")
    {
        // $dk="";
        // foreach($id as $key=>$value)
        // {
        //     $dk=$key.'='.$value;
        // }
        $dk='IDPLAYLIST='.$id.'';
        return $this->delete(self::TABLE_NAME, $dk);
    }

    public function deleteNhacByID($id="")
    {
        // $dk="";
        // foreach($id as $key=>$value)
        // {
        //     $dk=$key.'='.$value;
        // }
        $dk='IDNHAC='.$id.'';
        return $this->delete(self::TABLE_NAME, $dk);
    }

    public function deleteNhacYeuthichByID($id="")
    {
        // $dk="";
        // foreach($id as $key=>$value)
        // {
        //     $dk=$key.'='.$value;
        // }
        $dk='IDNHACYEUTHICH='.$id.'';
        return $this->delete("DANHSACHYEUTHICH", $dk);
    }

    
    


    public function updateProductNhac($data="", $dieukien="")
    {
        // echo $data;
        // echo '<br>';
        // echo $dieukien;

        return $this->update(self::TABLE_NAME, $data, $dieukien);
    }


}