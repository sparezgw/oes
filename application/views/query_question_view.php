<?php 
	$num=$query->num_rows();
	foreach($query->result() as $row):
	
		echo "��Ŀ:".$row->title."<br />";		
		
		$question=$row->question;	
		$question_json=json_decode($question,true);	
		
		echo "ѡ��A��".$question_json['A']."&nbsp;&nbsp;&nbsp;";
		echo "ѡ��B��".$question_json['B']."&nbsp;&nbsp;&nbsp;";
		echo "ѡ��C��".$question_json['C']."&nbsp;&nbsp;&nbsp;";
		echo "ѡ��D��".$question_json['D']."&nbsp;&nbsp;&nbsp;";
		echo "<br />";
		
		echo "ѡ��A".form_radio('question','op1','ѡ��A');
		echo "ѡ��B".form_radio('question','op1','ѡ��B');
		
		echo "<br />";
		echo "�𰸣�".$row->key."<hr />";

endforeach;



?>