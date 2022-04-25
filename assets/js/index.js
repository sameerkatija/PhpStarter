function checkLogin(userID) {
  //
  if (!userID || userID.length < 0) {
    window.location.href = "./login.php";
  } else {
    window.location.href = "./main.php";
  }
}
