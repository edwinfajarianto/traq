<?php
/**
 * Traq
 * Copyright (c) 2009 Rainbird Studios
 * $Id$
 */

require("global.php");

if(!$user->group->isadmin) {
	exit;
}

if($_REQUEST['action'] == "manage" || $_REQUEST['action'] == '') {
	$fetchusers = $db->query("SELECT * FROM ".DBPREFIX."users ORDER BY username ASC");
	$users = array();
	while($info = $db->fetcharray($fetchusers)) {
		$users[] = $info;
	}
	
	adminheader('Users');
	?>
	<div id="content">
		<div class="content-group">
			<div class="content-title">Users</div>
			<table width="100%" class="componentlist" cellspacing="0" cellpadding="4">
				<thead>
					<th class="component">Username</th>
					<th class="actions">Actions</th>
				</thead>
				<? foreach($users as $user) { ?>
				<tr>
					<td class="component"><a href="users.php?action=modify&uid=<?=$user['uid']?>"><?=$user['username']?></a></td>
					<td class="actions"><? /*<a href="javascript:void(0);" onclick="if(confirm('Are you sure you want to delete user: <?=$user['username']?>')) { window.location='users.php?action=delete&uid=<?=$user['uid']?>' }">Delete</a><? */ ?></td>
				</tr>
				<? } ?>
			</table>
		</div>
	</div>
	<?
	adminfooter();
} elseif($_REQUEST['action'] == "modify") {
	if($_POST['do'] == "modify") {
		$errors = array();
		if($_POST['username'] == "") {
			$errors['username'] = "You must enter a Username";
		}
		if($db->numrows($db->query("SELECT uid,username FROM ".DBPREFIX."users WHERE username='".$db->escapestring($_POST['username'])."' AND uid != '".$db->escapestring($_POST['userid'])."' LIMIT 1"))) {
			$errors['username'] = "Username is already in use";
		}
	}
	
	if(!count($errors) && isset($_POST['do'])) {
		$db->query("UPDATE ".DBPREFIX."users SET username='".$db->escapestring($_POST['username'])."', email='".$db->escapestring($_POST['email'])."' WHERE uid='".$db->escapestring($_POST['userid'])."' LIMIT 1");
		header("Location: users.php");
	} else {
		$user = $db->fetcharray($db->query("SELECT * FROM ".DBPREFIX."users WHERE uid='".$db->escapestring($_REQUEST['uid'])."' LIMIT 1"));
		adminheader('Modify User');
		?>
		<div id="content">
			<form action="users.php?action=modify" method="post">
			<input type="hidden" name="do" value="modify" />
			<input type="hidden" name="userid" value="<?=$user['uid']?>" />
			<div class="content-group">
				<div class="content-title">Modify User</div>
				<? if(count($errors)) { ?>
				<div class="content-group-content">
					<div class="errormessage">
					<? foreach($errors as $error) { ?>
					<?=$error?><br />
					<? } ?>
					</div>
				</div>
				<? } ?>
				<table width="400">
					<tr valign="top">
						<th>Username</th>
						<td><input type="text" name="username" value="<?=$user['username']?>" /></td>
					</tr>
					<tr valign="top">
						<th>Email</th>
						<td><input type="text" name="email" value="<?=$user['email']?>" /></td>
					</tr>
					<tr valign="top">
						<th></th>
						<td><button type="submit">Save</button></td>
					</tr>
				</table>
			</div>
			</form>
		</div>
		<?
		adminfooter();
	}
}
?>