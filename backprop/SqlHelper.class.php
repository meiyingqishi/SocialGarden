<?php
	//工具类
	class SqlHelper{
		public $conn;
		public $dbname="db_sjhy";
		var $username="sjhy";
		var $password="192837sjhy";
		public $host="localhost";
	
		//构造函数
		public function __construct(){
			$this->conn=mysqli_connect(
			$this->host,
			$this->username,
			$this->password,
			$this->dbname);
			
			if (!$this->conn){
				die("连接失败".mysqli_errno($this->conn));
			}
			mysqli_query($this->conn, "set names utf8") or die(mysqli_errno($this->conn));
		}
		
		//执行dql语句
		public function excute_dql($sql){
			$res=mysqli_query($this->conn, $sql); //or die(mysqli_errno($this->conn));//哪里开放的资源哪里关闭$array
			return $res;
		}
		
		//执行dql语句但是返回的是一个数组,玩得到早释放，效率会很高
		public function excute_dql2($sql){
			$arr=array();
			$res=mysqli_query($this->conn, $sql) or die(mysqli_errno($this->conn));//哪里开放的资源哪里关闭$array
			$i=0;
			
			while ($row=mysqli_fetch_assoc($res)) {
				$arr[$i++]=$row;
			}
			//这里就可以立即释放资源
			mysqli_free_result($res);
			return $arr;
		}
		
		//执行dml语句
		public function excute_dml($sql){
			//3
			$b=mysqli_query($this->conn, $sql) or die(mysqli_errno($this->conn));
			
			if (!$b){
				return 0;
			}else {
				if(mysqli_affected_rows($this->conn)){
					return 1;
				}else {
					return 2;//表示行没有受到影响
				}
			}
		}
		
		//关闭连接
		public function close_connect()
		{
			if (!empty($this->conn))
			{
				mysqli_close($this->conn);
			}
		}
		
	}
?>