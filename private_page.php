<?php
require_once 'inc/config.php';

if (!isset($_SESSION['logged_in'])) {
  header("Location:login.php");
}
?>
<?php require_once 'inc/header.php'; ?>
<div class="container center-align">
  <h2>Welcome, <span><?= $_SESSION['user']['username'] ?></span></h2>
    <a href="./logout.php">
      <button class="btn waves-effect waves-light">
        Logout
      </button>
    </a>
  </div>
  <div class = 'container'>
    <h5>We have a service/API that allows external applications to oder food and also pull all order status by using order id.</h5>
    <h5>You require an API key to access the API. Click the button below to generate an API key</h5>
    <button class="btn waves-effect waves-light" id="btn-api-key" data-user-id="<?= $_SESSION['user']['id']; ?>">
      Generate API key
    </button>

    <div id="api-key-info" style = 'margin-top : 10px'>
      <strong>Your API KEY: </strong>(Note: <span class="text-danger">If you generate a new API key, existing keys in your applications will be invalidated</span> )
      <div style="background: #ccc; height: 40px; width: 100%;"  id="current-api-key" data-user-id="<?= $_SESSION['user']['id']; ?>"></div>
    </div>
  </div>
</div>
<?php require_once 'inc/footer.php'; ?>