<?php

class CollaborativeFiltering{
        private $obj; 
	private $top;
	private $month;
	private $year;

	function __construct($db) {
		$this->obj = $db;
		$this->top = 100;
		$today = getDate();
		
		$this->year = $today['year'];
		$this->month = $today['mon'];
	}

	function generateSimilarities($student_id) {
		$student = $this->obj->select_one("SELECT * FROM Student Where student_id='".$student_id."'");
		$others = $this->obj->select("SELECT * FROM Student Where level = ".$student['level']." and year_enroll <".$student['year_enroll'] ." and department =".$student['department']);
		//var_dump($others);
		if($others == false){
			return false;
		}
		$regs = $this->obj->select("SELECT course_id FROM Registeration Where student_id ='".$student_id."'");
		
		$similarity = array();
		$selectedCourse = array();



		for($i=0;$i<sizeof($others); $i++){
			$other = $others[$i];
			
			for($j=0;$j<sizeof($regs);$j++){
				$course = $regs[$j];
				$exits = $this->obj->select_one("SELECT course_id FROM Registeration Where student_id ='".$other['student_id']."' and course_id ='".$course['course_id']."'");
				$selectedCourse[$course['course_id']] = 1;
				if($exits != false){
                           $similarity[$other['student_id']] = $similarity[$other['student_id']] + 1;
				}
			}
		}
		
		
		if($similarity == false){
			return false;
		}

		arsort($similarity);
		
		
		$students = array();

		if(sizeof($similarity) > $this->top){
			$students = array_slice($similarity, 0, $this->top);
		}
		else{
			$students = $similarity;
		}
		
		$course_score = array();
		$c_semester = array();

		

		$period = $this->year - $student['year_enroll'];		
		

		foreach($students as $id => $student){
			//var_dump($id);
			$sel_courses = $this->obj->select("SELECT course_id, semester FROM Registeration R, Student S 
 						       Where S.student_id ='".$id."' and S.student_id = R.student_id 
                                                       and course_id is not null and ((year - year_enroll) = ".$period." or (year - year_enroll) = ".($period+1).")");
			//var_dump($sel_courses);
			
			for($l=0;$l<1;$l++){
				$cValue = $sel_courses[$l];
                                $c_id = $cValue['course_id'];
                                 
				 if(isset($selectedCourse[$cValue['course_id']])) {
					

				 }
                                 else{
				     if($c_id != ""){
				     $course_score[$c_id] = $course_score[$c_id] + 1;
				     if($course_score[$c_id] == 44){
 					 var_dump($c_id."-------------");
				     }
				     $c_semester[$c_id] = $cValue['semester'];
				 }

                                 }
				
			}
			
		}

		
		
		if(sizeof($course_score) == 0){
			return false;
		}

		
		arsort($course_score);
		
		$sub_course_score = array();
		if(sizeof($course_score) > 50){
			$sub_course_score = array_slice($course_score, 0, 50);
		}
		else{
			$sub_course_score = $course_score;
                }

		$result = array();

		$n = 0;
		$m = 0; 
		foreach($sub_course_score as $sub_key => $sub_value){
                       	$c_score = $sub_value;
			$semester = $this->month < 7 ? 1 :2;
			if($semester == $c_semester[$sub_key]){
				$result['current'][$n] = $sub_key;
				$n++;
			}
			else{
				$result['next'][$m] = $sub_key;
				$m++;
			}
		}
		
		
		return $result;

	}
	
}
?>