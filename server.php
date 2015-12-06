<?php
session_start();
$error = 0;
if(isset($_POST['login_email'], $_POST['login_password']))
{
  $email = htmlentities($_POST['login_email']);
  $password = $_POST['login_password'];
  @$data = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/login/" . $email . "/" . $password), 1);
  if($data)
  {
    if($data["status"] == "success")
    {
      
    }
    else
    {
      $error = 1;
    }
  }
  else
  {
    $error = 1;
  }

  if(!$error)
  {
    @$user = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/users/" . $email), 1)["data"];

    $_SESSION["email"] = $user["Email"];

    echo json_encode(array("status" => "success"));
    exit();
  }
  else
  {
    echo json_encode(array("status" => "error"));
    exit();
  }
}

if(isset($_POST["register_email"], $_POST["register_password"]))
{
  $email = htmlentities($_POST["register_email"]);
  $password = $_POST["register_password"];

  @$data = json_decode(file_get_contents("http://guh2015-api.azurewebsites.net/users/" . $email . "/" . $password), 1);
  $error = 0;
  if($data)
  {
    if($data["status"] == "success")
    {
      $_SESSION["email"] = $email;

      echo json_encode(array("status" => "success"));
      exit();
    }
    else
    {
      $error = 1;
    }
  }
  else
  {
    $error = 1;
  }

  if(!$error)
  {
    
  }
  else
  {
    echo json_encode(array("status" => "error"));
    exit();
  }
}

if(isset($_GET['logout']) && $_GET['logout'])
{
  unset($_SESSION['email']);
  header("Location: ./");
  exit();
}

if(isset($_POST['challenge_id'], $_POST['challenge_money'], $_POST['challenge_email'], $_POST['challenge_cause']))
{
  $error = 0;
  $challenge_id = htmlentities($_POST['challenge_id']);
  $challenge_money = htmlentities($_POST['challenge_money']);
  $challenge_email = htmlentities($_POST['challenge_email']);
  $challenge_cause = htmlentities($_POST['challenge_cause']);
  @$email = $_SESSION['email'];

  @$data = json_decode(file_get_contents("http://www.guh2015-api.azurewebsites.net/add_dare/" . $email . "/" . $challenge_id . "/" . $challenge_email . "/" . $challenge_cause . "/" . $challenge_money), 1);

  if($data)
  {
    if($data["status"] == "success")
    {
      $token = $data["token"];
    }
    else
    {
      $error = 1;
    }
  }
  else
  {
    $error = 1;
  }

  $error = 0;
  $data["id"] = 1212;
  $data["description"] = "muie";
  $data["name"] = "suji cariciu";
  $data["cause_description"] = "muicica";

  if(!$error)
  {
    echo json_encode(array("status" => "success", "data" => array("challenge_id" => $data["id"], "challenge_description" => $data["description"], "challenge_name" => $data["name"], "cause_description" => $data['cause_description'])));
    exit();
  }
  else
  {
    echo json_encode(array("status" => "error"));
    exit();
  }

}

?>