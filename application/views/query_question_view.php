<?php 
	$num=$query->num_rows();
	foreach($query->result() as $row):
	
		echo "题目:".$row->title."<br />";		
		
		$question=$row->question;	
		$question_json=json_decode($question,true);	
		
		echo "选项A".$question_json['A']."&nbsp;&nbsp;&nbsp;";
		echo "选项B".$question_json['B']."&nbsp;&nbsp;&nbsp;";
		echo "选项C".$question_json['C']."&nbsp;&nbsp;&nbsp;";
		echo "选项D".$question_json['D']."&nbsp;&nbsp;&nbsp;";
		echo "<br />";
		
		echo "选项A".form_radio('question','op1','选项A');
		echo "选项B".form_radio('question','op1','选项B');
		
		echo "<br />";
		echo "答案".$row->key."<hr />";

endforeach;



?>