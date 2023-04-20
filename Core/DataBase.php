DataBase
<?php 
class Database 
{
    const HOST = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DATABASE_NAME = "dacs3";
    public function connect()
    {
        //die(self::HOST);
        $conn=mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE_NAME);
        
        if(mysqli_connect_errno()==0)
        {
            return $conn;
        }
        
    }
}