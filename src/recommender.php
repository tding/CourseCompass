<?php
    //error_reporting( error_reporting() & ~E_NOTICE );
    /*require("connection/db.php");
    $obj = new db(); 
   
   $today = getDate();*/

  /*leval_year: 1 - 4 undergraduate*/
  /*leval_year: 1 - 2 graduate*/


function getClassInformation($id,$obj){
       return $obj->select_one("SELECT * FROM Course WHERE course_id='".$id."'");
	
}
function MostPopularClasses($level_year,$level,$obj,$today,$department){
	$year = $today['year'];
	$month = $today['mon'];
	$popularClasses = array();

	if($month < 7){ //current is spring
		$popularClasses['current'] = $obj->select("SELECT course_id, count(course_id) as num  
						FROM Student,Registeration 
						Where Student.student_id = Registeration.student_id 
						and Student.level = ".$level." 
						and Student.department = ".$department."
						and semester = 1
						and (year - year_enroll) = ".($level_year-1)." 
						group by course_id order by num desc");
			

		$popularClasses['next'] = $obj->select("SELECT course_id, count(course_id) as num
						FROM Student,Registeration 
						Where Student.student_id = Registeration.student_id 
						and Student.level = ".$level." 
						and Student.department = ".$department."
						and semester = 2
						and (year - year_enroll) = ".($level_year-1)." 
						group by course_id order by num desc");
	}
   else{  //current is fall
		$popularClasses['next'] = $obj->select("SELECT course_id, count(course_id) as num
						FROM Student,Registeration 
						Where Student.student_id = Registeration.student_id 
						and Student.level = ".$level." 
						and Student.department = ".$department."
						and semester = 1
						and (year - year_enroll) = ".($level_year-1)." 
						group by course_id order by num desc");
			

		$popularClasses['current'] = $obj->select("SELECT course_id, count(course_id) as num 
						FROM Student,Registeration 
						Where Student.student_id = Registeration.student_id 
						and Student.level = ".$level." 
						and Student.department = ".$department."
						and semester = 2
						and (year - year_enroll) = ".($level_year-1)." 
						group by course_id order by num desc");
	}
	return $popularClasses;

}


function CheckCapatity($courseId,$obj,$today){
	$year = $today['year'];
	$month = $today['mon'];
	$capatity = array();
	
	if($month < 7){ //current is spring, next is fall in this year
		
	     $capatity['current']= $obj->select_one("SELECT count(*) as num  FROM Registeration 
						Where 
                        course_id = '".$courseId."'
						and year = ".$year."
						and semester  = 1
                        and type = 1");

	     $capatity['next'] = $obj->select_one("SELECT count(*) as num  FROM Registeration 
						Where 
						course_id = '".$courseId."'
						and year = ".$year."
						and semester  = 2
						and type = 1");

		  }
	else{//current is fall, next is spring in next year
	     $capatity['current'] = $obj->select_one("SELECT count(*) as num  FROM Registeration 
								Where 
								course_id = '".$courseId."'
								and year = ".$year."
								and semester  = 2
								and type = 1");

	     
	     $capatity['next'] = $obj->select_one("SELECT count(*) as num  FROM Registeration 
								Where 
								course_id = '".$courseId."'
								and year = ".($year+1)."
								and semester  = 1
								and type = 1");
	}

	return $capatity; 	
}



?>