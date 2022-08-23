<?php

if (isset($_SESSION['name'])) {
    $db = new Database();
    $db->query("select * from subject");
    $data = $db->resultset();

    $email = $_SESSION['email'];

    $db->query("SELECT * from users where email=:Email");
    $db->bind(":Email", $email);
    $user = $db->resultset();

    $userId = $user[0]['id'];

    $db->query("select * from result where user_id =:id ");
    $db->bind(":id", $userId);
    $result = $db->resultset();

    $sub = $result[0]['subject_id'];
    $use = $result[0]['user_id'];


?>
    <div class="container">
        <h1>Welcome <?php echo $_SESSION['name']; ?></h1>
        <table class="mt-5 table table-striped table-hover table-bordered" style="max-width:700px; width: 100%;">
            <thead class="bg-secondary text-white">
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Take Quiz</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $result) : ?>
                    <tr>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo $result['subject_name']; ?></td>
                        <td>
                            <?php if ($result['id'] == $sub) : ?>
                                <a href="#" class="btn btn-danger">Already Taken</a>
                            <?php else : ?>
                                <a href="quiz.php?quiz=<?php echo $result['id']; ?>" class="btn btn-success">Take Quiz Now</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
<?php
}
