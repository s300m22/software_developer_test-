<?
class FileSystem{
    public $id;
    public $name;
    public $pid;
    public $type;
    
    private $db_host='localhost';
    private $db_name='ffdispatch_filesys';
    private $db_username='ffdispatch_filesys';
    private $db_password='UorRR[AYjs2R';
    
    private $conn;
    
    
    /**
     * data import function from json file  
     * @param string $file
     */
    public function importData($file){
        $content = file_get_contents($file);
        $nodes = json_decode( $content );
        $this->dbConn();
        $pid=0;
        $this->insertNodes($nodes,$pid);
    }
    
    /**
     * data insert function to database with 3 values name|type|pid 
     * @param array $nodes
     * @param int $pid
     */
    public function insertNodes($nodes,$pid){
        foreach($nodes as $node){
            $sql = "INSERT INTO file_system (name,type,pid) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($sql); 
            $stmt->bind_param("ssi", $node->name, $node->type, $pid );
            $stmt->execute();
            $last_id  = $this->conn->insert_id;
            if($node->contents) $this->insertNodes($node->contents,$last_id);
        }
    }
    
    /**
     * Search function 
     * @param string $query
     * @return array $nodes
     */
    public function search(string $query){
        $this->dbConn();
        $param = "%" . $query . "%";
        $sql = "select * from file_system where type<>'root' and name like ? order by id asc";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bind_param("s", $param);
        $stmt->execute();
        $result = $stmt->get_result();
        $nodes=[];
        while ($row = $result->fetch_assoc()) {
            $nodes[]=  $this->getFilePath($row['id']);
        }
        //var_dump($nodes);
        return $nodes;
    }
    
    /**
     * Get file path 
     * @param int $id
     * @return string path
     */
    public function getFilePath($id){
        $sql = "select * from file_system where id = ?";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(!$row) return '';
        if($row['type']=='root') return $row['name'].':';
        return $this->getFilePath($row['pid'])."\\".$row['name'];
    }
    
    /**
     * Connection database function
     */
    public function dbConn(){
        $this->conn = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
    }
}
?>