<?php
class NhacController extends BaseController{
    private $nhacModel;
    public function __construct()
    {
        $this->loadModel("NhacModel");
        $this->nhacModel=new NhacModel;
    }

    public function danhsachNhac()
    {
        $data=$this->nhacModel->getAllNhac();

        return $this->view("user.data", [
            'danhsachNhac'=> $data,
        ]);

    }

    public function timkiemNhac()
    {
        $dieuKien=$_GET['timkiem'];
        $tkTheo=$_GET['tkTheo'];
        $data =$this->nhacModel->getNhaccoDk(["DANHSACH"],["*"], [
            $tkTheo => $dieuKien,
        ]);

        return $this->view("user.data", [
            'danhsachNhac' => $data,
        ]);
    }

    public function danhSachNhacyeuThich()
    {
        $iduser=$_SESSION['iduser'];

        $data=$this->nhacModel->getNhaccoDk(["DANHSACHYEUTHICH, DANHSACH"], ["danhsach.IDNHAC, danhsach.LINK, danhsach.ANH, danhsach.NGUOIHAT"], [
            "IDUSER"=>$iduser
        ], "danhsachyeuthich.IDNHAC= danhsach.IDNHAC");
        return $this->view("user.data", [
            'danhsachNhac' => $data,
        ]);
    }

    public function danhSachPlayList()
    {
        $iduser=$_SESSION['iduser'];

        $data=$this->nhacModel->getNhaccoDk(["PLAYLISTS"], ["*"], [
            "IDUSER"=>$iduser
        ]);
        return $this->view("user.data", [
            'danhsachNhac' => $data,
        ]);
    }

    public function danhSachPlaylist()
    {
        $idPlaylist=$_GET['idPlaylist'];

        $data=$this->nhacModel->getNhaccoDk(["NHACTRONGPLAYLIST, DANHSACH"], ["danhsach.IDNHAC, danhsach.LINK, danhsach.ANH, danhsach.NGUOIHAT"], [
            "IDPLAYLIST"=>$idPlaylist
        ], "nhactrongplaylist.IDNHAC= danhsach.IDNHAC");
        return $this->view("user.data", [
            'danhsachNhac' => $data,
        ]);
    }

    public function themNhac()
    {
        if($_SESSION['role']='user')
        {
            echo '<script>history.back();</script>';
        }
        if($_SERVER['REQUEST_METHOD']="POST")
        {
            $tenNhac=$_POST['tenNhac'];
            $linkNhac=$_POST['linkNhac'];
            $nguoihat=$_POST['nguoihat'];
            $file=$_FILES['anh'];
            //dổi tên file
            $filename=explode('.', $file['name']);
            $ext=end($filename);
            $newfilename=uniqid().'.'.$ext;
            $newPath='img/'.$newfilename;
            $allow_ext=['png', 'jpg', 'jpeg'];
            $thongbao="";
            if(in_array($ext, $allow_ext))
            {
                $upload=move_uploaded_file($file['tmp_name'], $newPath);
                if(!$upload)
                {
                    $thongbao="upload err";
                }
                else{
                    $thongbao = $this->nhacModel->addNhac([
                        'TENNHAC'=>$tenNhac,
                        'LINK' =>$linkNhac,
                        'NGUOIHAT'=> $nguoihat,
                        'ANH' => $newPath
                    ]);

                }
            }
            return $this->view("admin.nhac.addnhac",[
                'thong bao' => $thongbao,
            ]);
            
            
        }
    }



}