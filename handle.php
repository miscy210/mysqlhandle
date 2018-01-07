<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>数据助手/数据上传</title>
    <link href="css/charisma-app.css" rel="stylesheet">
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href='css/bootstrap-tour.min.css' rel='stylesheet'>
</head>
<body>
	<?php
		if(!isset($_COOKIE['hostname'])){
			exit('非法访问!');
		}
	?>
	<?php
		$hostname=$_COOKIE['hostname'];
	?>
 	<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">
		<div class="navbar-inner">
            <a class="navbar-brand">
                <span>DataHelper</span>
            </a>
            <div class="btn-group pull-right">
                <button class="btn btn-default" onclick="javascript:top.location='/mysqlhandle';">
                	<span>Change Host</span>
                </button>
            </div>
            <div class="btn-group pull-right">
				<button class="btn">
			    	<span><?php echo $hostname; ?></span>
			    </button>
            </div>
            <div class="btn-group pull-right">
                <button class="btn">
                	<span><?php echo "今天是 " . date("Y-m-d")  ?></span>
                </button>
            </div>
        </div>
    </div>
    <!-- topbar ends -->

    <!-- Main content starts -->
    <div class="ch-container">
	    <div class="row">

	        <!-- left menu starts -->
	        <div class="col-sm-2 col-lg-2">
	            <div class="sidebar-nav">
	                <div class="nav-canvas">
	                    <div class="nav-sm nav nav-stacked">

	                    </div>
	                    <ul class="nav nav-pills nav-stacked main-menu">
	                        <li class="nav-header">Main</li>
	                        <li><a class="ajax-link" onclick="showDatabase()"><i class="glyphicon glyphicon-home"></i><span> Show database </span></a>
	                        </li>
	                        <li><a class="ajax-link" onclick="showTables()"><i class="glyphicon glyphicon-align-justify"></i><span> Show table</span></a>
	                        </li>
	                        <li><a class="ajax-link" onclick="showFields()"><i class="glyphicon glyphicon-list-alt"></i><span> Show fields </span></a>
	                        </li>
	                        <li class="nav-header hidden-md">Options</li>
	                        <li><a class="ajax-link" onclick="uploadopt()" id="upload"><i
	                                    class="glyphicon glyphicon-arrow-up"></i><span> upload </span></a></li>
	                        <li><a class="ajax-link" onclick="downloadopt()" id="download"><i
	                                    class="glyphicon glyphicon-arrow-down"></i><span> download </span></a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <!--/span-->
	        <!-- left menu ends -->

	        <noscript>
	            <div class="alert alert-block col-md-12">
	                <h4 class="alert-heading">Warning!</h4>

	                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
	                    enabled to use this site.</p>
	            </div>
	        </noscript>

	        <div id="content" class="col-lg-10 col-sm-10">
	            <!-- content starts -->
	            <div>
					<ul class="breadcrumb">
						<li>
							<a href="#">Home</a>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
			</div>

			<!-- main content starts -->
			<div class="row">
				<div class="box col-md-8">
					<div class="box-inner homepage-box">
						<div class="box-header well" data-original-title="">
							<h2><i class="glyphicon glyphicon-calendar"></i> Forms </h2>
						</div>
						<div class="box-content">
							<!-- Begin MailChimp Signup Form -->
							<div class="mc_embed_signup">
								<form action="upload.php" method="POST" class="validate" target="_blank">
									<div>
										<label>Please fill in a database</label>
										<select id="database" name="database" onchange="getTables(this.value)">
											<option>选择数据库</option>
											<?php
												$hostname=$_COOKIE['hostname'];
												$username=$_COOKIE['username'];
												$password=$_COOKIE['password'];
												$con = mysql_connect($hostname,$username,$password);
												if (!$con)
												{
													die('Could not connect: ' . mysql_error());
												}
												mysql_select_db("information_schema", $con);
												mysql_query("set names 'utf8'");
												$result = mysql_query("SELECT SCHEMA_NAME FROM SCHEMATA");
												while($row = mysql_fetch_array($result))
												{
													echo "<option>" . $row['SCHEMA_NAME'] . "</option>" ;
												}
												mysql_close($con);
											?>
										</select>
										<label>Please fill in a table</label>
										<select id="table" name="table" onchange="showFields(this.value)">
											<option>选择数据表</option>
										</select>
										<label>Please specify the fields split by [,] or fill in [*]</label>
										<input type="text" name="fields" class="textstyle" placeholder="*" >
										<div id="options">

										</div>
										<div class="clear"><input type="submit" value="Subscribe" name="submit" class="button"></div>
									</div>
								</form>
							</div>

							<!--End mc_embed_signup-->

						</div>
					</div>
				</div>
				<div class="box col-md-4">
					<div class="box-inner">
						<div class="box-header well" data-original-title="">
							<h2><i class="glyphicon glyphicon-list-alt"></i> Show Board </h2>
						</div>

						<div class="box-content">
							<ul class="dashboard-list" id="showboard">

							</ul>
						</div>
					</div>
				</div>
			</div><!--/row-->
		</div>
	</div>
		<footer class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
			<p >&copy; Original from Open source<a href="http://usman.it" target="_blank">Muhammad
				Usman</a> 2012 - 2015 Powered by: <a
                href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
			<p> Now Big Data Tech Team, Lab 1, CDSTIC. 2017</p>
			</div>
			<div class="col-md-3">
			</div>
   		</footer>
<script src="js/myscript.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-tour.min.js"></script>
</body>
</html>
