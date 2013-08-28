<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
	<title>LastAutoIndex | <?php echo PATH_URI; ?></title>
	
	<link rel="stylesheet" href="<?php echo PATH_THEME; ?>/css/foundation.min.css">
	<link rel="stylesheet" href="<?php echo PATH_THEME; ?>/css/webicons.css">
	<link rel="stylesheet" href="<?php echo PATH_THEME; ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo PATH_THEME; ?>/markdown.css.php">
	<link rel="stylesheet" href="<?php echo PATH_THEME; ?>/css/custom.css.php">
	
	<link href="<?php echo PATH_THEME; ?>/js/vendor/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />

	<script src="<?php echo PATH_THEME; ?>/js/vendor/jquery-1.10.2.min.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/vendor/custom.modernizr.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/vendor/google-code-prettify/prettify.js"></script>
	<script type="text/javascript" >
		$("img").error(function () { 
			// $(this).hide();
			$(this).css({visibility:"hidden"}); 
		});
	</script>
	
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo PATH_THEME; ?>/css/responsive-tables/ie.css">
	<![endif]-->
	
	
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	
	
	
	
	
	
	<div class="row">
		<div class="large-12 columns">
			
			<div class="row">
				<div class="large-12 columns directory-contents">
					<?php
					
					// show negative messages
					if (isset($_lai->register) && $_lai->register->errors) {
						foreach ($_lai->register->errors as $error) {
							?>
					<div data-alert class="alert-box alert radius">
						<?php echo $error; ?>
						<a href="#" class="close">&times;</a>
					</div>
							<?php
						}
					}

					// show positive messages
					if (isset($_lai->register) && $_lai->register->messages) {
						foreach ($_lai->register->messages as $message) {
							?>
					<div data-alert class="alert-box success radius">
						<?php echo $message; ?>
						<a href="#" class="close">&times;</a>
					</div>
							<?php
						}
					}
					
					?>
					
					<?php
					
					// show negative messages
					if (isset($_lai->login) && $_lai->login->errors) {
						foreach ($_lai->login->errors as $error) {
							?>
					<div data-alert class="alert-box alert radius">
						<?php echo $error; ?>
						<a href="#" class="close">&times;</a>
					</div>
							<?php
						}
					}

					// show positive messages
					if (isset($_lai->login) && $_lai->login->messages) {
						foreach ($_lai->login->messages as $message) {
							?>
					<div data-alert class="alert-box success radius">
						<?php echo $message; ?>
						<a href="#" class="close">&times;</a>
					</div>
							<?php
						}
					}
					
					?>
				</div>
			</div>
			
			
			<div class="row">
				<div class="large-12 columns directory-contents">
					
					
					<h2>Directory &nbsp;&nbsp;<small><code>
					<a href="/" style="font-size:1.2em;"><i class="icon-home"></i>/</a><?php
						
						$backdirs = explode('/',trim(PATH_URI,'/'));
						$prevdir = '';
						foreach ($backdirs as $backdir) {
							$prevdir .= $backdir.'/';
							if($backdir == ''){continue;}
							echo sprintf('<a href="/%1$s">%2$s/</a>',$prevdir,urldecode($backdir));
						}
					?>
					
					</code></small></h2>
					<div class="dir-bar">
						<div class="row">
							<div class="large-4 columns">
								<span class="valign-middle dir-bar-content">
									<a class="dir-bar-button valign-middle" href="javascript:history.go(-1)"><i class="icon-caret-left fa-icon same"></i>Back</a>
									
									<a class="dir-bar-button valign-middle dir-up-button" href="<?php echo PATH_URI.'..'; ?>">../</a>
									<a class="dir-bar-button valign-middle dir-up-button" href="<?php echo PATH_URI.'../..'; ?>">../../</a>
								</span>
							</div>
							<?php if(isset($_lai->login) && $_lai->login->isUserLoggedIn()){ ?>
							<div class="large-4 columns text-center">
								<span class="valign-middle dir-bar-content">
									<span class="dir-bar-button valign-middle">
										Welcome back, <?php echo $_lai->login->getUsername(); ?>
									</span>
								</span>
							</div>
							<?php } ?>
							<div class="large-4 columns text-right">
								<a href="#" class="dir-bar-button valign-middle" data-dropdown="options-dropdown">Options</a>
								<ul id="options-dropdown" class="f-dropdown" data-dropdown-content>
									<li><center>This will work later</center><hr></li>
									<li><a href="#">Download</a></li>
									<li><a href="#">View Source</a></li>
									<li><a href="#">Delete</a></li>
								</ul>
								<a class="dir-bar-button valign-middle" href="#" data-dropdown="drop2">Search</a>
								<div id="drop2" class="f-dropdown medium content" data-dropdown-content>
									<form method="post" accept-charset="utf-8">
										<input type="text">
										<span class="left"><input type="radio" name="place" value=""> From Server Root<br /></span>
										<span class="left"><input type="radio" name="place" value=""> In this Directory<br /></span>
										<a class="dir-bar-button valign-middle right" href="#"><i class="icon-search"></i></a>
									</form>
								</div>
							</div>
						</div>
					</div>
					<table class="responsive dir-items" style="width:100%;">
						<tbody>
							<tr>
								<th style="width:35%;">Name</th>
								<th class="hide-for-small">Description</th>
								<th style="min-width:15%">Size</th>
								<th style="min-width:15%">Type</th>
							</tr>
							
							<?php
								$tally = array('dir'=>0,'file'=>0);
								$this_dir = $_lai->dir->all();
								foreach ($this_dir as $item) {
									$is_dir = '<i class="icon-code"></i> ';
									if($item['is_dir']){
										$is_dir = '<i class="icon-folder-close-alt"></i> ';
										$filesize = '-';
										$tally['dir']++;
									}else{
										if(stripos(strtolower($item['filename']),'readme') !== FALSE){
											$readme = SER_DOC_ROOT.PATH_URI.$item['filename'].'.'.$item['ext'];
											$readme_name = $item['filename'].'.'.$item['ext'];
										}
										$tally['file']++;
									}
									if(stripos($item['name'], '.git')!==FALSE) {
										$is_dir = '<i class="icon-github"></i> ';
									}
									?>
							<tr>
								<td style="width:35%;"><a href="<?php echo $item['path']; ?>"><?php echo $is_dir.$item['name']; ?></a></td>
								<td class="hide-for-small"><?php echo $item['filename']; ?></td>
								<td style="min-width:15%"><?php echo $item['size']; ?></td>
								<td style="min-width:15%"><?php echo $item['ext']; ?></td>
							</tr>
									<?php
								}
							?>
							
						</tbody>
					</table>
					<div class="info-bar">
						<div class="row">
							<div class="small-6 large-5 columns text-center">
								<?php echo sprintf('%1$s Directorie%2$s | %3$s File%4$s',
									$tally['dir'],
									(($tally['dir']==1)?'':'s'),
									$tally['file'],
									(($tally['file']==1)?'':'s')
								); ?>
							</div>
							<div class="small-6 large-2 columns text-center">
								<?php echo sprintf('%1$s Item%2$s',count($this_dir),((count($this_dir)==1)?'':'s')); ?>
							</div>
							<div class="large-5 columns text-center">
							<?php
							if(isset($_lai->login) && $_lai->login->isUserLoggedIn()){
							?>
								<a href="?logout">Logout</a> | 
								<a href="#" data-reveal-id="settings-lai-modal">LAI Settings</a> | 
								<a href="#" data-reveal-id="settings-theme-modal">Theme Settings</a>
							<?php
							} else {
							?>
								<a href="#" data-reveal-id="login-modal">Login</a> | <a href="#" data-reveal-id="register-modal">Register</a>
							<?php
							}
							?>
							</div>
						</div>
					</div>
					
					
					<?php
						if (isset($readme) && file_exists($readme) && is_file($readme)) {
							$handle = fopen($readme, "r");
							$readme_text = fread($handle, filesize($readme));
							fclose($handle);
							?>
								<div class="markdown-wrapper">
									<center><h2><?php echo $readme_name; ?></h2></center>
									<div class="markdown-content readme">
										
										<?php
										echo $_lai->markdown->read($readme_text);
										?>
										
									</div>
								</div>
							<?php
						}
					?>
					
					<?php if(isset($_GET['symbols'])){ 
						$symbols = array(
							'bitbucket-sign',
							'chevron-up',
							'windows',
							'skype',
							'youtube-sign',
							'youtube-play',
							'sort-by-alphabet',
							'sort-by-alphabet-alt',
							'stackexchange',
							'apple',
							'android',
							'linux',
							'sun',
							'moon',
							'bug',
							'beaker',
							'camera',
							'code',
							'code-fork',
							'desktop',
							'download',
							'external-link',
							'eye-open',
							'eye-close',
							'film',
							'folder-open-alt',
							'folder-close-alt',
							'globe',
							'home',
							'lock',
							'unlock',
							'move',
							'ok',
							'ok-circle',
							'ok-sign',
							'pencil',
							'minus-sign-alt',
							'plus-sign-alt',
							'puzzle-peice',
							'question',
							'quote-right',
							'quote-left',
							'search',
							'sort-up',
							'sort-down',
							'terminal',
							'time',
							'trash',
							'warning-sign',
							'css3',
							'html5',
							'facebook-sign',
							'twitter-sign'
						);
						
						?>
					<h3>Symbols</h3>
					<table class="responsive" style="width:100%;">
						<tbody>
							<tr>
								<th>Name</th>
								<th>Example</th>
							</tr>
							
							<?php 
								foreach ($symbols as $ex) {
									?>
							<tr>
								<td><a href="#"><?php echo $ex; ?></a></td>
								<td><?php echo sprintf('<i class="icon-%1$s" style="font-size:16px"></i> <i class="icon-%1$s" style="font-size:24px"></i> <i class="icon-%1$s" style="font-size:32px"></i> <i class="icon-%1$s" style="font-size:64px"></i>',$ex); ?></td>
							</tr>
									<?php
								}
							?>
							
						</tbody>
					</table>
					<?php } // end IF LAI_ENV == 'DEV' ?>
					
				</div>
			</div>
			
		<!-- End Content -->
			
			
		<!-- Footer -->
			
			<footer>
					
					<div class="large-7 columns">
						<a href="#" data-reveal-id="social-modal">
							<span class="webicon coderwall" title="Share on Coderwall"></span>
							<span class="webicon facebook" title="Share on Facebook"></span>
							<span class="webicon twitter" title="Share on Twitter"></span>
							<span class="webicon github" title="See the project on Github"></span>
							<span class="webicon mail" title="Send us feedback"></span>
						</a>
					</div>
					
					<div class="large-5 columns">
						<p title="<?php runtime('STOP','RUNTIME'); echo RUNTIME; ?>" class="copyright">Copyright &copy; Nicholas Jordon &mdash; All Right Reserved</p>
					</div>
					
				</div>
			</footer>
			
			<!-- End Footer -->
			
		</div>
	</div>
	
	
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.alerts.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.clearing.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.cookie.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.dropdown.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.forms.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.joyride.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.magellan.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.orbit.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.reveal.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.section.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.tooltips.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.topbar.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.interchange.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.placeholder.js"></script>
	<script src="<?php echo PATH_THEME; ?>/js/foundation/foundation.abide.js"></script>
	
	<script>
		$(document).foundation();
		prettyPrint();
	</script>
	
	
	<div id="social-modal" class="reveal-modal small">
		<div class="row">
			<div class="large-12 columns">
				<span class="webicon coderwall" title="Share on Coderwall"></span>
				<span class="webicon facebook" title="Share on Facebook"></span>
				<span class="webicon twitter" title="Share on Twitter"></span>
				<span class="webicon github" title="See the project on Github"></span>
				<span class="webicon mail" title="Send us feedback"></span>
				This will work later
			</div>
		</div>
		
		<a class="close-reveal-modal">&#215;</a>
	</div>
	
	
	
	<div id="settings-lai-modal" class="reveal-modal large">
		<h2>LastAutoIndex Settings</h2>
		<form action="#" class="settings" id="lai-settings">
			<div class="row">
				<div class="large-12 columns">
					
				</div>
			</div>
		</form>
		
		<a class="close-reveal-modal">&#215;</a>
	</div>
	
	<div id="settings-theme-modal" class="reveal-modal large">
		<h2>Theme Settings</h2>
		<form action="#" class="settings" id="theme-settings">
			<div class="row">
				<div class="large-12 columns">
					
				</div>
			</div>
		</form>
		
		<a class="close-reveal-modal">&#215;</a>
	</div>
	
	<div id="login-modal" class="reveal-modal large">
		<h2>Login</h2>
		<div class="row">
			<div class="large-12 columns">
				<form method="post" action="?login" name="loginform">
					<label for="login_input_username">Username</label><br/>
					<input id="login_input_username" class="login_input" type="text" name="user_name" required /><br/><br/>
					<label for="login_input_password">Password</label><br/>
					<input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required /><br/><br/>
					<input type="checkbox" id="login_input_rememberme" name="user_rememberme" value="1" /> Keep me logged in (for 2 weeks)<br/><br/>
					<input type="submit"  name="login" value="Log in" /><br/><br/>
				</form>
			</div>
		</div>
		
		<a class="close-reveal-modal">&#215;</a>
	</div>
	
	<div id="register-modal" class="reveal-modal large">
		<h2>Register</h2>
		<div class="row">
			<div class="large-12 columns">
				
				<form method="post" action="?register" name="registerform">   
					
					<!-- NOTE: those <br/> are bad style and only there for basic formatting. remove them when you use real .css -->
					
					<!-- the user name input field uses a HTML5 pattern check -->
					<label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label><br/>
					<input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9-_]{2,64}" name="user_name" required /><br/><br/>
					
					<!-- the email input field uses a HTML5 email type check -->
					<label for="login_input_email">User's email (please provide a real email adress, you'll get a verification mail with an activation link)</label><br/>
					<input id="login_input_email" class="login_input" type="email" name="user_email" required /><br/><br/>
					
					<label for="login_input_password_new">
							Password (min. 6 characters!
					</label><br/>
					<input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /><br/><br/>  
					
					<label for="login_input_password_repeat">Repeat password</label><br/>
					<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /><br/><br/>        
					
					<!-- generate and display a captcha and write the captcha string into session -->
					<img src="<?php echo PATH_THIRD_PARTY; ?>/simple-php-login/tools/showCaptcha.php" /><br/>
					
					<label>Please enter those characters</label><br/>
					<input type="text" name="captcha" required /><br/><br/>
					
					<input type="submit"  name="register" value="Register" /><br/><br/>
					
				</form>
				
			</div>
		</div>
		
		<a class="close-reveal-modal">&#215;</a>
	</div>
	
</body>
</html>
