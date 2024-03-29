<?php

// we use session to store current log-in information
session_start();

include 'session.php';


// use for cookie hash
$db_config = "../../data/secret";
if (!file_exists($db_config)) {
  http_response_code(511);
  exit();
}
define('SECRET_WORD', file_get_contents($db_config));

function get_user($username_or_email) {
  // Query user data from the database
  $connection=get_connection();
  if ($connection->connect_errno) {
    http_response_code(503);
    exit();
  }
  
  $username = mysqli_real_escape_string($connection, $username_or_email);
  if (strpos($username, '@')) {
    $sql = "SELECT * FROM users WHERE email = '$username';";
  } else {
    $sql = "SELECT * FROM users WHERE username = '$username';";
  }

  try {
    $result = $connection->query($sql);
  } catch (Exception $e) {
    http_response_code(402);
    exit();
  }
  $connection->close();

  if ($result->num_rows !== 1) {
    http_response_code(401);
    exit();
  }
  return $result->fetch_assoc();
}

function validate_password($username, $pass) {
  // Validate supplied password with the hash from the database.
  $user = get_user($username);

  if (!$user['validated']) {
    http_response_code(401);
    exit();
  }

  if (isset($user) && password_verify($pass, $user['password'])) {
    return true;
  } else {
    return false;
  }
}

function logout() {
  // LOG-OUT on DELETE
  if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    session_unset();
    setcookie('rememberme', '', time() - 3600);
    echo "Logged out.";
    exit();
  }
}


function validate_cookie() {
  // CHECK THE SESSION COOKIE FIRST - if already logged-in
  if (isset($_SESSION['login']) && $_SESSION['login']) {
    list($c_username,$cookie_hash) = explode(',',$_SESSION['login']);
    if (password_verify($c_username.SECRET_WORD, $cookie_hash)) {
      // SESSION LOGGED IN
      return $c_username;
    }

    // WRONG SESSION COOKIE
    session_unset();
    return null;
  }

  // CHECK THE REMEMBERME COOKIE
  if (isset($_COOKIE['rememberme']) && $_COOKIE['rememberme']) {
    list($c_username,$cookie_hash) = explode(',',$_COOKIE['rememberme']);
    if (password_verify($c_username.SECRET_WORD, $cookie_hash)) {
      // SESSION LOGGED IN
      return $c_username;
    }

    // WRONG REMEMBER ME COOKIE
    setcookie('rememberme', '', time() - 3600);
    return null;
  }

}

function login_post() {
  // ...OR initiate login procedure - expect POST data: { username, password }
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit();
  }
  $_POST = json_decode(file_get_contents('php://input'), true);
  if (!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(400);
    exit();
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (validate_password($username, $password)) {
    // LOGIN COOKIE = USERNAME,HASH(USERNAME,SECRET)
    $_SESSION['login'] = $username.','.password_hash($username.SECRET_WORD, PASSWORD_DEFAULT);
  } else {
    http_response_code(401);
    exit();
  }

  // Set rememberme cookie with 30-day validity
  if (isset($_POST['rememberme']) && $_POST['rememberme']) {
    $cookie_hash = password_hash($username.SECRET_WORD, PASSWORD_DEFAULT);
    setcookie('rememberme', $username.','.$cookie_hash, time() + (3600 * 24 * 30));
  }
  return $username;


}


?>
