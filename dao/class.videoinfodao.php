<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class VideoDAO{

	private $_DB;
	private $_Video;

	function VideoDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Video = new Video();

	}

	// get all the Terms from the database using the database query
	public function getAllVideos(){

		$VideoList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_video");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Video = new Video();
		    $this->_Video->setID ( $row['ID']);
		    $this->_Video->setTitle( $row['Title'] );
		    $this->_Video->setDescription( $row['Description'] );
		    $this->_Video->setLink( $row['Link'] );
		    $this->_Video->setIsEmbed( $row['IsEmbed'] );
		    $this->_Video->setTag( $row['TagID'] );
		    $VideoList[]=$this->_Video;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($VideoList);

		return $Result;
	}

	//create Term funtion with the Term object
	public function searchVideo($tag){

		$VideoList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_video WHERE TagID like '%$tag%'");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];

			$this->_Video = new Video();

		    $this->_Video->setID ( $row['ID']);
		    $this->_Video->setTitle( $row['Title'] );
		    $this->_Video->setDescription( $row['Description'] );
		    $this->_Video->setLink( $row['Link'] );
		    $this->_Video->setIsEmbed( $row['IsEmbed'] );
		    $this->_Video->setTag( $row['TagID'] );
		    $VideoList[]=$this->_Video;
   
		}	
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($VideoList);

		return $Result;
	}

	//read an Term object based on its id form Term object
	public function readVideo($Video){
		
		
		$SQL = "SELECT * FROM tbl_video WHERE ID='".$Video->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Term from the database
		$row = $this->_DB->getTopRow();

		$this->_Video = new Video();

		//preparing the Term object
	    $this->_Video->setID ( $row['ID']);
		$this->_Video->setTitle( $row['Title'] );
		$this->_Video->setDescription( $row['Description'] );
	    $this->_Video->setLink( $row['Link'] );
	    $this->_Video->setIsEmbed( $row['IsEmbed'] );
	    $this->_Video->setTag( $row['TagID'] );


	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Video);

		return $Result;
	}

	//update an Term object based on its 
	public function updateVideo($Video){

		$SQL = "UPDATE tbl_video SET Title='".$Video->getTitle()."',
		Description='".$Video->getDescription()."', 
		Link='".$Video->getLink()."' WHERE ID='".$Video->getID()."'";

		//echo $SQL;
        
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Term based on its id of the database
	public function deleteVideo($Video){


		$SQL = "DELETE from tbl_video where ID ='".$Video->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

//echo '<br> log:: exit the class.videodao.php';

?>