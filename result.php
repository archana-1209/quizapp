<?php
include_once('result_src.php'); // Operations for result.php are made in this page.
include_once('general_header.php'); // Header for all html files
?>
<body id='resultBody' class="text-center">
<div class="result">
    <img class="mb-4" src="assets/images/q_grey.png" alt="" width="72" height="72">
        <?php
        echo '<h1 class="h3 mb-3 font-weight-normal">Thanks, ' . $username . '</h1>';
        if ($correct_answer_count > 0) {
            echo '<h6 class="mb-3">You responded correctly to ' . $correct_answer_count . ' out of ' . $question_count . ' questions.</h6>';
        } else {
            echo '<h6 class="mb-3">Unfortunately you answered none of the questions correctly.</h6>';
        }
        ?>
        <a class="btn btn-dark" href="index.php" role="button">Take Another Quiz</a>
</div>
<?php
include_once('general_scripts.php'); // Scripts for all html files
?>
</body>
</html>