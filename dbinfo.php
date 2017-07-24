<?php

	$db_users_tab = 'users';
		$db_users_id = 'user_ID';
		$db_users_login = 'login';
		$db_users_pass = 'password';
		$db_users_fname = 'first_name';
		$db_users_lname = 'last_name';
		$db_users_email = 'email';
		$db_users_function = 'user_function';
	
	$db_task_tab = 'task';
		$db_task_id = 'task_ID';
		$db_task_name = 'name';
		$db_task_description = 'description';
		$db_task_sdate = 'start_date';
		$db_task_edate = 'end_date';
		$db_task_userid = 'user_ID';
                $db_task_priority = 'priority';
                $db_task_done = 'done';
		
	$db_subtask_tab = 'subtask';	
		$db_subtask_id = 'subtask_ID';
		$db_subtask_taskid = 'task_ID';
		$db_subtask_name = 'name';
		$db_subtask_sdate = 'start_date';
		$db_subtask_edate = 'end_date';
                $db_subtask_description= 'description';
		$db_subtask_userid = 'user_ID';
                $db_subtask_done = 'done';
		
	$db_functions_tab = 'functions';
		$db_functions_id = 'function_ID';
		$db_functions_desc = 'function_description';
		
	$db_attachment_tab = 'attachment';
		$db_attachment_id = 'att_ID';
		$db_attachment_name = 'attachment';
		$db_attachment_taskid = 'task_ID';          
                
        $db_messages_tab= 'messages';
                $db_messages_id = 'message_ID';
                $db_messages_userid = 'user_ID';
                $db_messages_date = 'date';
                $db_messages_taskid = 'task_ID';
                $db_messages_text = 'text';
?>