<?php
/**
*@author Olivier Peurichard & Etienne Marois
*/
    session_start();
    /**
    *Connection to database
    */
include('../model/connectionDB.php');

/**
* Connection to dashboard with two conditions :
* If the session is open or if the user is identify by his username and password
*/
if(isset($_SESSION['id_user']) && $_SESSION['id_user']!=null){
    $id_owner = $_SESSION['id_user'];
    include("../model/sqlContainers.php");

    launchDashboard();
}

else{
//if there is an username and a password entered in the fields
if(isset($_POST['username']) AND $_POST['username'] != null AND $_POST['password'] != null AND isset($_POST['password'])){
//indentfication with password
    $sql = "SELECT * FROM Users WHERE username = '".htmlspecialchars($_POST['username'])."'";
    $req = $bdd->query($sql);
    while ($data = $req->fetch()){
        $passwd = $data['passwd'];
    }

//creation of variables we will need : username and id_owner
    $username = htmlspecialchars($_POST['username']);
    $sql = "SELECT * FROM Users WHERE username = '".$username."'";
    $req = $bdd->query($sql);
    while ($data = $req->fetch()){
        $id_owner = $data['id'];
    }

    //Now, the user is identify with combination of corrects username and password
    if($_POST['password'] == $passwd){
        
        $_SESSION['id_user']=$id_owner;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $passwd;


        include("../model/sqlContainers.php");
        launchDashboard();

    }
    /**
    * If the login or password is not correct
    */
    else{
        echo 'Login or password incorrect';?>
        <head>

        <title>Return to index</title>

        <meta http-equiv="refresh" content="3; URL=../FinalApp/index.html">
        </head>
        <?php
    }
}
/**
*
*/
else{
    echo 'Please, enter your login and password';?>
        <head>

        <title>Return to index</title>

        <meta http-equiv="refresh" content="3; URL=../FinalApp/index.html">
        </head>
        <?php
}
}

//---The HTML Page----------------------------------------------------------------------------------------------------

function launchDashboard(){

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard Template for Bootstrap</title>

        <script src="../control/displayContainers.js"></script>

        <script src="bootstrap/js/jquery-1.10.2.js"></script> 
        <script src="bootstrap/js/bootstrap.js"></script> 
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <link href="gridstack.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="dashboard.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li>
                            <a id="refresh" href="dashboard.php" >Refresh</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
                        <li>
                            <a href="#">Profile</a>
                        </li>
                        <li>
                            <a href="../model/logout.php">Logout</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 sidebar col-xs-2 hidden-xs">
                    <h2>Dashboard</h2>
                    <hr></hr>
                    <div class="panel-group" id="panels1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#panels1" href="#collapse1">Choice by Type</a></h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                            <?php
                            /**
                            *Recuperation of types of user's containers
                            *initialize panel
                            */
                            $id_owner = $_SESSION['id_user'];
                            include("../model/sqlContainers.php");
                            if(isset($container_type) AND $container_type !=null){
                                
                                for($e = 0; $e<count($container_type); $e++){
                                    $varContainer = $container_type[$e];
                                ?><div class="panel-body">
                                        <a href="#" onClick="displayContainers('<?php echo $varContainer ?>')">
                                            <?php echo $container_type[$e] ?>
                                        </a>
                                    </div>
                                <?php
                                }

                            }
                            else{
                                echo 'You don\'t have containers';
                            }
                            ?>
                            </div>

                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#panels1" href="#collapse2">Other Option 2</a></h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.                            </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#panels1" href="#collapse3">Other option 3</a></h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.                            </div>
                            </div>
                        </div>
                    </div>
                    <hr></hr>
                    <form role="form">
                        <div class="form-group">
</div>
                        <div class="form-group">
</div>
                        <div class="form-group">
                            <label class="control-label" for="exampleInputFile">Pick what you want</label>
                        </div>
                        <div class="checkbox">
                            
                        <?php
                            include("../model/sqlContainers.php");
                            if(isset($container_type) AND $container_type !=null){
                                ?>
                                <label class="control-label">
                                    <input type="checkbox" checked="checked" onChange="displayContainersAll(this)">
                                    All
                                </label>
                                <?php
                                
                                for($e = 0; $e<count($container_type); $e++){
                                    $varContainer = $container_type[$e];
                                    //$idOfType = constructDivContainers($varContainer, $id_owner);
                                ?>
                                    <label class="control-label">
                                        <input type="checkbox" onChange="displayContainersCheckbox('<?php echo $varContainer ?>', this)">
                                        <?php echo $container_type[$e] ?>
                                    </label>
                                <?php
                                }
                            }
                            else{
                                echo 'You don\'t have containers';
                            }
                            ?>
                            
                        </div>
                    </form>
                    <button type="submit" class="btn btn-default">Submit</button>
                    <div class="btn-group">
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#">Action</a>
                            </li>
                            <li>
                                <a href="#">Another action</a>
                            </li>
                            <li>
                                <a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main col-sm-offset-2 col-xs-10 col-sm-10">
                    <div class="container-fluid">
                            <div class="row">

                        <div class="grid-stack" data-gs-width="4">


            </div>
            <ul class="pagination" id="pagination"></ul>
            </div> 
    </div>
</div>
                        
                            
                                




                        
                   
                    
    </div>
</div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        
    </body>

    <footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <script src="assets/js/jquery.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
        <script src="../control/gridstack.js"></script>
        <script type="text/javascript" src="bootstrap/js/parseAjax.js"></script>
    <script type="text/javascript" src="bootstrap/js/popup.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="http://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="../control/initiateGrid.js"></script>
<script src ="../control/getContainerList.js"></script>






    </footer>
</html>

        <?php
}
//end of HTML page-----------------------------------------------------------------------------------------
?>