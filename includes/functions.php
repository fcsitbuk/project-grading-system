<?php 

	
	function excape($string) {
		
		echo isset($_POST[$string]) ? htmlentities($_POST[$string],  ENT_QUOTES, 'UTF-8') : "";
		
	}
	
	function escape($string) {
		
		return htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
		
	}
	
	function get_last() {
		
		require "connect.php";
		
		$get = $db->query("SELECT stu_no FROM gra_student ORDER BY stu_no DESC LIMIT 1") or die($db->error);
		
		if($get->num_rows) {
			
			$row = $get->fetch_assoc();
			
			$num = $row['stu_no'] + 1;
			
			echo $num;
			
		}
		
		$get->free_result();
		$db->close();
		
	}
	
	function randStr() {
		
		$result = "";
		$chars = "09CF7B83462E5A1D";
		$charsArray = str_split($chars);
		
		for($i = 0; $i <=  5; $i++) {
			$randstr = array_rand($charsArray);
			$result .= $charsArray[$randstr];
		}
		
		return $result;
		
	}
	
	function get_average_defense($reg_no)  {
		
		require "connect.php";
		
		$mark_pre = 0;
		$mark_obj = 0;
		$mark_que = 0;
		$average = 0;
		$divisor = 0;
		
		$get_data = $db->query("SELECT * FROM gra_asessor WHERE stu_reg='$reg_no'");
		
		if($get_data->num_rows) {
			
			while($row = $get_data->fetch_assoc()) {
				
				$mark_pre += $row['mark_pre'];
				$mark_obj += $row['mark_obj'];
				$mark_que += $row['mark_que'];
				
				$divisor++;
				
			}
			
			$mark_pre = ($mark_pre) / $divisor;
			$mark_obj = ($mark_obj) / $divisor;
			$mark_que = ($mark_que) / $divisor;
			
			$average = $mark_pre + $mark_obj + $mark_que;
			
			return $average;
			
		}else{
			
			$average = 0;
			
			return $average;
			
		}
		
		$get_data->free_result();
		$db->close();
	}
	
	function get_average_writeup($reg_no) {
		
		require "connect.php";
		
		$sup_mark = 0;
		
		$get_data = $db->query("SELECT mark_total FROM gra_supervisor WHERE stu_reg='$reg_no'");
		
		if($get_data->num_rows) {
			
			$row = $get_data->fetch_assoc();
			
			$sup_mark = $row['mark_total'];
			
			return $sup_mark;
			
		}else{
			
			$sup_mark = 0;
			
			return $sup_mark;
			
		}
		
		$get_data->free_result();
		$db->close();
		
	}
	
?>