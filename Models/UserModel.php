<?php 
class UserModel extends BaseModel{
    const TABLE_NAME="USERS";
    public function addUser($data)
    {
        $s="SELECT count(TENTAIKHOAN) AS COUNT FROM ".self::TABLE_NAME." WHERE TENTAIKHOAN='".$data['TENTAIKHOAN']."'";
        
        $kq=$this->_query($s);
        $row=mysqli_fetch_assoc($kq);
        $count=$row['COUNT'];
        
        if($count==0)
        {
            $sql="INSERT INTO ".self::TABLE_NAME."(TENTAIKHOAN, MATKHAU, IDLOAI) VALUES ('".$data['TENTAIKHOAN']."', '".$data['MATKHAU']."', ".$data['IDLOAI']." )";
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
        return "đã có tài khoản này";
    }

    public function checkUser($data)
    {
        $s="SELECT count(TENTAIKHOAN) AS COUNT FROM ".self::TABLE_NAME." WHERE TENTAIKHOAN='".$data['TENTAIKHOAN']."'";
        
        $kq=$this->_query($s);
        $row=mysqli_fetch_assoc($kq);
        $count=$row['COUNT'];
        if($count==0)
        {
            return "sai tên tài khoản";
        }
        else{
            $s="SELECT count(TENTAIKHOAN) AS COUNT FROM ".self::TABLE_NAME." WHERE MATKHAU='".$data['MATKHAU']."'"." AND TENTAIKHOAN='".$data['TENTAIKHOAN']."'";
            $kq=$this->_query($s);
            $row=mysqli_fetch_assoc($kq);
            $count=$row['COUNT'];
            if($count==1)
            {
                return "đăng nhập thành công";
            }
            else{
                return "sai mật khẩu";
            }

        }

    }

    public function deleteUser($id)
    {
        
        $dk='IDUSER='.$id.'';
        return $this->delete(self::TABLE_NAME, $dk);
    }

    public updateUser($data, $id)
    {
        $dk="IDUSER=$id";
        $this->update(self::TABLE_NAME, $data, $dk);
    }

}