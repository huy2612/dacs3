BaseModel
<?php 

class BaseModel extends DataBase
{
    protected $conn;
    public function getConnect()
    {
        return $this->conn;
    }

    public function __construct()
    {
        $this->conn=$this->connect();
    }

    function getAll($table, $select, $limit)
    {
        $k=$v=$row_lm="";
        if($limit!="")
        {
            foreach($limit as $key=> $value)
            {
                $k=$key;
                $v=$value;
            }

            if($v!="")
            {
                $row_lm=implode(',', $v);
            }
        }
        

        $columns=implode(', ', $select);
        
        
        //die($row_lm);

        $sql="SELECT ${columns} FROM ${table} $k ${row_lm}";
        //die($sql);
        $kq=$this->_query($sql);
        $data=[];
        while($row=mysqli_fetch_assoc($kq))
        {
            array_push($data, $row);
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        return $data;
    }

    public function getById($table, $select, $dieukien, $limit)
    {
        //echo 'dk: <br>'.$dieukien;
        $k=$v=$row_lm="";
        if($limit!="")
        {
            foreach($limit as $key=> $value)
            {
                $k=$key;
                $v=$value;
            }
            $row_lm=implode(', ', $v);
           // echo $row_lm;
        }
        
        if($dieukien!="")
        {
            $dieukien="WHERE ".$dieukien;
        }

        $columns=implode(', ', $select);
        $table=implode(', ', $table);
        
        //foreach($dieukien as $key =>)
        //die($row_lm);
        $sql="SELECT ${columns} FROM ${table} $dieukien  $k ${row_lm}";
        //die($sql);
        //echo $sql;
        //die($);
        $kq=$this->_query($sql);
        $data=[];
        $i=-1;
        while($row=mysqli_fetch_assoc($kq))
        {

            
                array_push($data, $row);
            
            
            
        }
        //die;

        return $data;
    }

    public function update($table, $data, $dieukien)
    {
        if($dieukien!="")
        {
            $dieukien="WHERE $dieukien";
        }

        $sql="UPDATE $table SET $data $dieukien";
        //die($sql);
        $this->_query($sql);
    }

    public function delete($table, $dieukien)
    {
        if($dieukien!="")
        {
            $dieukien="WHERE $dieukien";
        }
        $sql="DELETE FROM ${table} $dieukien ";
        //die($sql);
        

        $kq=$this->_query($sql);
        

    }

    public function add($data)
    {
        $this->_query($data);
    }

    public function add2($table, $column, $data)
    {
        $sql="INSERT INTO $table($column) VALUES($data)";
        //echo $sql;
        $this->_query($sql);
    }

    public function _query($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

}
