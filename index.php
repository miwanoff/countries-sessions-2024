<?php
require_once "action.php";
include "header.php";
$autorized = false;
if (isset($_POST["go"])) {
    $login = $_POST["login"];
    $password = $_POST["pass"];
    echo check_role($login, $password) . "<br>";
    //echo "$login  $password";
    if (check_autorize($login, $password)) {
        $autorized = $_SESSION['authorized'];
        echo "Hello, $login";
        if (check_admin($login, $password)) {
            echo "<a href='secret-info.php?login=$login'>Просмотр отчета</a>";
        }
    } else {
        echo "You are not registered";
    }
}?>
<!-- Page content-->
<section class="py-5">
    <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i>
                </div>
                <h2 class="fw-bolder">Log in</h2>
                <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <?php
$user_form = '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="autoForm" onsubmit = "return verify(this)" >
  <div class="mb-3 mt-3">
    <label for="login" class="form-label">Name:</label>
    <input type="text" name="login" id="login" placeholder="Input login" class="form-control"  pattern="[A-Za-z]{3,10}" required>
  </div>
  <div class="mb-3">
    <label for="pass class="form-label">Password:</label>
    <input type="password" name="pass" id="pass" placeholder="Input password"  class="form-control"  pattern="[A-Za-z]{3,10}" required>
  </div>
  <input type="submit" value="Go" name="go" class="btn btn-primary">
</form>
<div id="massage"></div>';

if (!$autorized) {
    echo $user_form;
    echo "<a href='registration.php'>Sign up</a>";
} else {
    echo '<br><a href="logout.php" class="logout">logout</a>';
}
echo "</div>"
?>
                </div>
            </div>
        </div>
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i>
                </div>
                <h2 class="fw-bolder">Sorting</h2>
                <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <?php
$str_form_s = '
<form action="index.php" method="post" name="sort_form">
    <div class="mb-3 mt-3">
       <select name="sort" id="sort" size="1"  class="form-select">
         <option value="name">назва</option>
         <option value="area">площа</option>
         <option value="population">среднє населення</option>
       </select>
    </div>
    <input type="submit" name="submit" value="OK"  class="btn btn-primary">
</form>';
echo $str_form_s;

if (isset($_POST["sort"])) {
    $how_to_sort = $_POST["sort"];
    sorting($how_to_sort);
}
$out = out_countries();

if (count($out) > 0) {
    foreach ($out as $row) {
        echo $row;
    }
} else {
    echo "Empty";
}
?>
                </div>
            </div>
        </div>
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i>
                </div>
                <h2 class="fw-bolder">Search</h2>
                <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <?php
$str_form_search = "<form name='searchForm' action='index.php' method='post' onSubmit='return overify_login(this);' >
                            <input type='text' name='search' class='form-control'>
                            <input type='submit' name='gosearch' value='Confirm'  class='btn btn-primary my-2'>                       
</form>";

echo $str_form_search;

if (isset($_POST['gosearch'])) {
    $data = test_input($_POST['search']);
    $out = out_search($data);

    // виклик функції out_countries() з action.php для отримання массиву
    if (count($out) > 0) {
        foreach ($out as $row) { //вывод массива построчно
            echo $row;
        }
    } else // если нет данных
    {
        echo "Nothing found...";
    }
}?> </div>
            </div>
        </div>
        <!-- Contact cards-->
        <div class="row gx-5 row-cols-2 row-cols-lg-4 py-5">
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-dots"></i>
                </div>
                <div class="h5 mb-2">Chat with us</div>
                <p class="text-muted mb-0">Chat live with one of our support specialists.</p>
            </div>
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i>
                </div>
                <div class="h5">Ask the community</div>
                <p class="text-muted mb-0">Explore our community forums and communicate with other users.</p>
            </div>
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                        class="bi bi-question-circle"></i>
                </div>
                <div class="h5">Support center</div>
                <p class="text-muted mb-0">Browse FAQ's and support articles to find solutions.</p>
            </div>
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i>
                </div>
                <div class="h5">Call us</div>
                <p class="text-muted mb-0">Call us during normal business hours at (555) 892-9403.</p>
            </div>
        </div>
    </div>
</section>
<?php

include "footer.php";