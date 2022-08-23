<?php
require_once "inc/header.php";
require_once "config/config.php";
require_once "libraries/Database.php";

if (isset($_SESSION['name'])) {

    $db = new Database();

    $id = $_POST['quiz'];
    $data = $_POST;
    $email = $_SESSION['email'];


    $remove = array_pop($data);


    $db->query("SELECT * from users where email=:Email");
    $db->bind(":Email", $email);
    $user = $db->resultset();

    $userId = $user[0]['id'];

    $db->query("select * from question where subject_id = :id");
    $db->bind(":id", $id);
    $db->resultset();
    $num = $db->rowCount();

    $score = 0;
    // $db->query("select * from choice where subject = :id");
    // $db->bind(":id", $id);
    // $result = $db->resultset();

    foreach ($data as $res) {
        $no = (int)$res;
        $db->query("SELECT * from choice where c_id = $no and is_correct = '1' ");
        $ss = $db->resultset();
        $count = $db->rowCount();
        $score += $count;
    }

    $db->query("insert into result (user_id,subject_id,total) values (:User,:Subject,:Total)");
    $db->bind(":User", $userId);
    $db->bind(":Subject", $id);
    $db->bind(":Total", $score);
    $db->execute();
?>
    <div class="container" style="max-width: 600px;">
        <div class="card">
            <div class="card-header bg-primary p-2 text-white">
                <h3>Quiz Results</h3>
            </div>
            <div class="card-body p-4">
                <p>Total Questions: <?php echo $num; ?></p>
                <h3 class="my-3">Your Results: <b><?php echo $score; ?></b> </h3>
                <a href="home.php" class="btn btn-sm btn-success">Go Home</a>
            </div>
        </div>
    </div>
<?php
}
