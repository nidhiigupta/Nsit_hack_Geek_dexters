<?php
class Model_grievance extends CI_Model{
	function __construct(){
		parent ::__construct(); //calls the model constructor
	}
	function grievance_fill(){
		$qry=$this->db->get('stu_grievance_category');
		$db=$this->session->userdata('dbname');
		$uniq_id = $this->session->userdata('hash1');

		$res=$qry->result_array();
		$x=array(''=>'Choose One');
		foreach($res as $row)
		{
			$id=$row['Cat_id'];
			$cat=$row['Category'];
			$x[$id]=$cat;
		}
		$this->db->select('Branch_id');
		$this->db->where('Uniq_Id',$uniq_id);
		$que=$this->db->get($db.'.studentprimdetail');
		$res=$que->row_array();
		$branch_id=$res['Branch_id'];

		$this->db->select('code');
		$this->db->where('branch_id',$branch_id);
		$que2=$this->db->get('library_branchcode');
		$res2=$que2->row_array();
		$branch=$res2['code'];
		//$data=array('uniq_id'=>$uniq_id);
		$data=array('cat'=>$x,'branch'=>$branch);
		return $data;
	}
	function grievance_scat()
	{
		$value=$_POST['value'];
		$this->db->where('Category_Id',$value);
		$qry=$this->db->get('stu_grievance_subcat');
		$res=$qry->result_array();
		echo "<option value=''>Choose One</option>";
		foreach($res as $row)
		{
			$id=$row['Subcat_id'];
			$cat=$row['Subcategory'];
			echo "<option value='$id'>$cat</option>";
		}
	}
	function grievance_data(){
		$db=$this->session->userdata('dbname');
		$uniq_id = $this->session->userdata('hash1');
		$grievance_forwarded_to=$this->input->post('submitForm');
		$curr_date = date('Y-m-d');
		$Pub_Pri=$this->input->post('identity');
		$subcategory=$this->input->post('subcategory');
		$category=$this->input->post('category');
		$view = '0';
		$timestamp=date('Y-m-d h:i:s');
		$ins_arr = array(
			'Sugg_Date' => $curr_date,
			'Suggestion' => $this->input->post('suggest'),
			'View' => $view,
			'Anonimity'=>$Pub_Pri,
			'Subcat_Id'=>$subcategory
		);
		//var_dump($this->session->all_userdata());
		$ins_arr['Uniq_Id'] = $uniq_id;
		//var_dump($branch);
		if($grievance_forwarded_to == 'HOD')
		{

			$this->db->select('Branch_id');
			$this->db->where('Uniq_Id',$uniq_id);
			$query=$this->db->get($db.".studentprimdetail");
			$row=$query->row_array();
			$this->db->select('pmail');
			$where=array(
				'Desg' => 'PROFESSOR CUM HOD',
				'Did' => $row['Branch_id']
			);
			$this->db->where($where);
			$this->db->join('dropdown','dropdown.sno = facultyprimdetail.Dept');
			$this->db->join('dept_detail','dept_detail.Branch=dropdown.value');
			$query1=$this->db->get('facultyprimdetail');
			$row1=$query1->row_array();
			$ins_arr['Sent_To']=$row1['pmail'];
			$ins_arr['Category_Id']=$category;
			$query_ins=$this->db->insert('suggestions_student',$ins_arr);
			return $query_ins;

		}
		else if($grievance_forwarded_to == 'Concern')
		{
			$this->db->select('Pmail');
			$this->db->where('Category_Id',$category);
			$query=$this->db->get('stu_grievance_head');

			if($query->num_rows()>0){

				foreach($query->result_array() as $row)
				{
					$ins_arr['Sent_To']=$row['Pmail'];
					$ins_arr['Category_Id']=$category;
					$query_ins=$this->db->insert('suggestions_student',$ins_arr);
				}
			}

		}
		else if($grievance_forwarded_to == 'cao')
		{
			$ins_arr['Sent_To']='CAO&DIR';
			$ins_arr['Category_Id']=$category;
			$query_ins=$this->db->insert('suggestions_student',$ins_arr);
		}
		return $query_ins;
	}
	public function report()
	{
		$uniq=$this->session->userdata('hash1');
		$query3 = $this->db->query("SELECT ss.*,fp.Name from suggestions_student ss,facultyprimdetail fp where ss.pmail=fp.pmail AND ss.Uniq_Id='$uniq' ORDER BY ss.Sugg_date DESC");
		$result3 = $query3->result_array();
		$data=array();
		$data['sugg']=$result3;
		return $data;
	}
	function mentor_data($uniroll)
	{
		$data=array();
		$db=$this->session->userdata('dbname');
		/*$this->db->select('*');
		$this->db->where('Uniq_Id',$uniroll);
		$query=$this->db->get('mentorActivitesapproval');
		//echo($this->db->last_query());
		$row=$query->result_array();*/
		//echo($row);
		/*foreach ($row as $result) {

		$data['Activities']=$result['Activities'];


		echo($result['Activities']);*/
		$this->db->select('Activities,Status');
		$this->db->where('Uniq_Id',$uniroll);
		$query=$this->db->get('mentorActivitesapproval');
		$res=$query->result_array();
		//var_dump($res);
		//echo($this->db->last_query());
		/*	if('Activities'==''&& 'Status'=='')
		{
		return null ;
	}
	if('Activities'!=''&& 'Status'!='')
	{
	return $res ;
}*/
//echo($this->db->last_query());
$arr=array();
$act=array();
$i=0;

foreach ($res as $result) {
	//ECHO($res);

	$act[$i]=$result['Status'];
	$arr[$i]=$result['Activities'];


	//echo json_encode($data['Status']);
	// echo json_encode($data['Activities']);
	//$data['Status']=$result['Status'];
	$i++;

}

$data['Activities']=$arr;
$data['Status']=$act;
//echo json_encode($data);
return $data;

/*$this->db->select(	'Activities');
$this->db->where('Uniq_Id',$uniroll);
$query=$this->db->get('mentorActivitesapproval');
$res=$query->row_array();
echo($this->db->last_query());
return $res;
echo($this->db->last_query());*/
}
function mentor_form($uniroll)
{
	$data = $this->input->post(NULL, TRUE);
	$activity1 = $this->input->post('activity1');
	$activity2 = $this->input->post('activity2');
	$activity3 = $this->input->post('activity3');
	var_dump($activity2);
	var_dump($activity1);
	var_dump($activity3);
	if($activity1){
		foreach ($activity1 as $activity)
		{
			if($activity!=''){
				$data = array(
					'Uniq_Id' => $uniroll,
					'Activities' => $activity,
					'Session' => '2017-2018',
					'Status' => 'PENDING',
					'Type' => 0,
					'Time' =>  $date = date('Y-m-d H:i:s')

				);
				$this->db->insert('mentorActivitesapproval', $data);
			}
		}}
		if($activity2){
			foreach ($activity2 as $activity)
			{
				if($activity!=''){
					$data = array(
						'Uniq_Id' => $uniroll,
						'Activities' => $activity,
						'Session' => '2017-2018',
						'Status' => 'PENDING',
						'Type' => 1,
						'Time' =>  $date = date('Y-m-d H:i:s')

					);
					$this->db->insert('mentorActivitesapproval', $data);
				}
			}}
			if($activity3){
				foreach ($activity3 as $activity)
				{
					if($activity!=''){
						$data = array(
							'Uniq_Id' => $uniroll,
							'Activities' => $activity,
							'Session' => '2017-2018',
							'Status' => 'PENDING',
							'Type' => 2,
							'Time' =>  $date = date('Y-m-d H:i:s')

						);
						$this->db->insert('mentorActivitesapproval', $data);
					}
				}
			}
		}
	}
