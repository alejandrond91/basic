<?php
	foreach ($model->each() as $user) {
		echo '<p>'.$user['username'].'</p>';
	}
?>