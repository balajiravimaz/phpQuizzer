<?php
if (isset($_SESSION['name'])) {
    $id = $_GET['quiz'];

    $db = new Database();

    $db->query("SELECT id FROM SUBJECT");
    $subject = $db->resultset();

    $subs = [];
    foreach ($subject as $sub) {
        $subs[] = $sub['id'];
    }

    if (in_array((int)$id, $subs)) {

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

        $db->query("SELECT * from question where subject_id =:id");
        $db->bind(":id", $id);
        $result = $db->resultset();
        $num = $db->rowCount();

        $db->query("SELECT * FROM choice");
        $choices = $db->resultset();

        $quest = [];

        foreach ($result as $data) {
            foreach ($choices as $choice) {
                if ($data['id'] == $choice['q_id']) {
                    $quest[] = $choice;
                }
            }
        }
        if ($id != $sub) {

?>
            <div class="container">
                <form action="process.php" method="POST" name="quiz" class="mb-4">
                    <div class="text-end">
                        <h6 class="d-inline bg-warning p-1">Time Reamining <span class="time" data-time=<?php echo $num; ?>></span></h6>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg1 mb-2">
                                <div class="card-header text-white bg-primary">
                                    Select Questions:
                                </div>
                                <div class="card-body p-4" style="background: #f5f5f5;">
                                    <div class="flex">
                                        <?php $i = 1;
                                        foreach ($result as $que) : ?>
                                            <div class="num <?php echo ($i == 1) ? "active" : false ?>" data-id="<?php echo $i ?>"><?php echo $i++; ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg1 mb-2">
                                <div class="card-header text-white bg-primary">
                                    Quiz Indications:
                                </div>
                                <div class="card-body p-4" style="background: #f5f5f5;">
                                    <div class="indi">
                                        <span class="bg-success t20"></span>
                                        <span>Answer Selected</span>
                                    </div>
                                    <div class="indi">
                                        <span class="bg-danger t20"></span>
                                        <span>Not Answered</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 bg2">
                            <?php $i = 0;
                            foreach ($result as $qq) : ?>
                                <div class="question <?php echo ($i == 0 ? "active" : false);
                                                        $i++; ?>" data-id="<?php echo $i; ?>">
                                    <div class="card card-answer">
                                        <h4 class="title">
                                            <?php echo $i ?>) <?php echo $qq['question_name'] ?>
                                        </h4>
                                        <div class="choices">
                                            <?php foreach ($quest as $choose) :
                                                if ($qq['id'] == $choose['q_id']) : ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="<?php echo $choose['q_id'] ?>" value="<?php echo $choose['c_id'] ?>" id="<?php echo $choose['c_id'] ?>" data-id="<?php echo $i; ?>">
                                                        <label class="form-check-label" for="<?php echo $choose['c_id']; ?>">
                                                            <code><?php echo $choose['answers'] ?></code>
                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="navigations my-4 text-end">
                                <button class="btn btn-primary btn-b">&larr; Previous</button>
                                <button class="btn btn-primary btn-f">Next &rarr;</button>
                            </div>
                        </div>

                    </div>
                    <div class="submit mt-5 text-end">
                        <input type="hidden" name="quiz" value="<?php echo $_GET['quiz'] ?>">
                        <input type="submit" class="btn btn-success btn-lg" value="Submit Quiz">
                    </div>
                </form>
            </div>
            <script>

            </script>
<?php }
    }
}
