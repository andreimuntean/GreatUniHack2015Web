<?php
session_start();
if(!isset($_SESSION['username']))
{
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WebSite</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="select2/dist/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="css/custom.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">hI-Dare</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                  <li>
                    <input type="text" class="navbar-search" placeholder="Search...">
                    <i class="fa fa-search"></i>
                  </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="server.php?logout=true" class="page-scroll">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <?php
                          $dares = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/dares"), 1)["data"];
                          foreach($dares as $key => $dare)
                          {
                        ?>
                          <li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" class="<?=!$key?'active':''?>"></li>
                      <?php
                        }
                      ?>
                      </ol>
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <?php
                          $dares = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/dares"), 1)["data"];
                          foreach($dares as $key => $dare)
                          {
                            $name = $dare["Title"];
                            $description = $dare["Description"];
                            $id = $dare["Id"];

                        ?>
                          <div class="item <?=$key==0?'active':''?>" id="<?=$id?>">
                            <div class="card">
                              <div class="card-title">
                                <h3>
                                  <?=$name?>
                                </h3>
                              </div>
                              <div class="card-body">
                                <?=$description?>
                              </div>
                            </div>
                          </div>
                      <?php
                        }
                      ?>
                      </div>
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>

                    <form role="search" id="new_challenge">
                      <div class="input-group form-group">
                        <span class="input-group-addon iconn"><i class="fa fa-user"></i></span>
                        <input id="challenge_email" type="text" class="form-control" placeholder="Email/username of challenge receiver">
                      </div>
                      <div class="input-group form-group">
                        <span class="input-group-addon iconn"><i class="fa fa-money"></i></span>
                        <input id="challenge_money" type="text" class="form-control" placeholder="Amount I'm willing to donate">
                      </div>
                      <div class="input-group form-group">
                        <span class="input-group-addon iconn"><i class="fa fa-smile-o"></i></span>
                        <select id="challenge_cause" class="form-control">
                          <?php
                            $causes = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/causes"), 1)["data"];
                            foreach ($causes as $key => $cause) 
                            {
                              $title = $cause["name"];
                              $desc = $cause["description"];
                              $logo = $cause["logoAbsoluteUrl"];
                              ?>
                              <option>
                                <img src="<?=$logo?>"><h4><?$title?></h4><p><?=$desc?></p>
                              </option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                      <span id="#challenge_waiting" class="success-message"></span>
                      <span id="#challenge_error" class="error-message"></span>
                      <p><input type="submit" class="btn btn-default btn-xl" value="CHALLENGE"></p>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center">
                  <a href="#pending" role="tab" data-toggle="tab" class="tabb">
                    <div class="service-box active" role="presentation" onclick="$('.service-box').removeClass('active'); $(this).addClass('active');">
                      <i class="fa fa-4x fa-user wow bounceIn text-primary"></i>
                      <h3>Pending Challenges</h3>
                      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                  <a href="#completed" role="tab" data-toggle="tab" class="tabb">
                    <div class="service-box" role="presentation" onclick="$('.service-box').removeClass('active'); $(this).addClass('active');">
                      <i class="fa fa-4x fa-money wow bounceIn text-primary" data-wow-delay=".1s"></i>
                      <h3>Completed challenges</h3>
                      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </a>
                </div>
                <div class="col-lg-4 col-md-6 text-center" role="presentation">
                  <a href="#stats" role="tab" data-toggle="tab" class="tabb">
                    <div class="service-box" onclick="$('.service-box').removeClass('active'); $(this).addClass('active');">
                      <i class="fa fa-4x fa-pie-chart wow bounceIn text-primary" data-wow-delay=".2s"></i>
                      <h3>Stats</h3>
                      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                  </a>
                </div>
            </div>
        </div>
    </section>
    <div class="hrr">
      <hr class="nice-hr">
    <div>
    <section id="stats">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="pending">
                <ul id="the_list_active">
                  <?php
                    @$challenges = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/active-dares/" . urlencode($_SESSION['email'])), 1)["data"];
                    if(!count($challenges))
                    {
                      ?>
                      <li>
                        <div class="card" id="<?=$id?>">
                          <div class="card-body">
                            No pending challenges yet
                          </div>
                        </div>
                      </li>
                      <?php
                    }
                    foreach($challenges as $key => $challenge)
                    {
                      $name = $challenge["DareTitle"];
                      $id = $challenge["DareId"];
                      $receiver = $challenge["ReceiverEmail"];
                      $sender = $challenge["SenderEmail"];
                      $money = $challenge["Amount"];
                      $cause = $challenge["CauseId"];
                      $description = $challenge["DareDescription"];
                      $cause_name = $challenge["CauseName"];
                      $date = $challenge["Date"];
                  ?>
                  <li>
                    <div class="card" id="<?=$id?>">
                      <div class="card-title">
                        <h3><?=$name?><?=($receiver==$_SESSION['email'])?"<span class='pull-right'>From ".$sender."</span>":"<span class='pull-right'>Sent to ".$receiver."</span>"?></h3>
                        <p>Created on <?=$date?></p>
                      </div>
                      <div class="card-body">
                        <?=$description?>
                      </div>
                      <div class="card-footer">
                        <?php
                          if($receiver == $_SESSION['email'])
                          {
                            ?>
                              <a class="btn btn-default" style="border:1px solid orange">Upload Proof</a>
                            <?php 
                          }
                          else
                          {
                            ?>
                              If completed, I have to donate &pound;<?=$money?> for <?=$cause_name?>.
                            <?php
                          }
                        ?>
                      </div>
                    </div>
                  </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
              <div role="tabpanel" class="tab-pane" id="completed">
                <ul id="the_list_completed">
                  <?php
                    @$challenges = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/completed-dares/" . $_SESSION['email']), 1)["data"];
                    if(!count($challenges))
                    {
                      ?>
                      <li>
                        <div class="card" id="<?=$id?>">
                          <div class="card-body">
                            No completed challenges yet
                          </div>
                        </div>
                      </li>
                      <?php
                    }
                    foreach($challenges as $key => $challenge)
                    {
                      $name = $challenge["DareTitle"];
                      $id = $challenge["DareId"];
                      $receiver = $challenge["ReceiverEmail"];
                      $sender = $challenge["SenderEmail"];
                      $money = $challenge["Amount"];
                      $cause = $challenge["CauseId"];
                      $description = $challenge["DareDescription"];
                      $cause_name = $challenge["CauseName"];
                      $date = $challenge["Date"];
                      $json = htmlentities(json_encode($challenge));
                  ?>
                  <li>
                    <div class="card" id="<?=$id?>">
                      <div class="card-title">
                        <h3><?=$name?><?=($receiver==$_SESSION['email'])?"<span class='pull-right'>From ".$sender."</span>":"<span class='pull-right'>Sent to ".$receiver."</span>"?></h3>
                        <p>Created on <?=$date?></p>
                      </div>
                      <div class="card-body">
                        <?=$description?>
                      </div>
                      <div class="card-footer">
                        <?php
                          if($receiver == $_SESSION['email'])
                          {
                            ?>
                              <a class="btn btn-default" style="border:1px solid orange">Upload Proof</a>
                            <?php 
                          }
                          else
                          {
                            ?>
                              <a data-toggle="modal" data-target="#myModal" onclick="modalFillSHIT('<?=$json?>');" class="btn btn-default pull-right" style="border:1px solid orange">Donate &pound;<?=$money?></a>
                            <?php
                          }
                        ?>
                      </div>
                    </div>
                  </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
              <div role="tabpanel" class="tab-pane" id="stats">stats</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">email@domain.com</a></p>
            </div>
        </div>
    </aside>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Donate now</h4>
          </div>
          <div class="modal-body">
            <p>Donate &pound;<span id="modal_money"></span> for <span id="modal_cause_name"></span>. Thank you for being so generous. Please spread the message through social media and help raise awareness.</p>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" style="border:1px solid orange;" class="btn btn-default" data-dismiss="modal">Close</button>
            <a id="donate_button" href=""><img src="http://developer.justgiving.com/ui-2013/devportal/img/donate-button.png" alt="Donate with JustGiving"></a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="select2/dist/js/select2.full.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>
    <script src="js/search.js"></script>
    <script src="js/login.js"></script>

</body>

</html>
