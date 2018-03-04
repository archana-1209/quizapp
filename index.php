<?php
include_once('index_src.php'); // Operations for index.php are made in this page.
include_once('general_header.php'); // Header for all html files
?>
<body id='indexBody' class="text-center">
    <form id="startQuizForm" class="form-start" action="index_src.php" method="post">
        <input type="hidden" id="isFormPosted" name="is_form_posted" value=""/>
        <img class="mb-4" src="assets/images/q_grey.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">QuizApp</h1>
            <div class="form-group">
                <input id="userName" name="username" class="form-control" placeholder="Enter your name" autofocus>
            </div>
            <div class="form-group">
                <select id="quizType" name="quiz_type" class="form-control select-quiz">
                    <option value="">Choose test</option>
                    <?php
                    foreach ($quiz_types as $quiz) {
                        echo '<option value="' . $quiz['id'] . '">' . $quiz['quiz_type'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button id="submitQuizForm" class="btn btn-lg btn-dark btn-block">Start</button>
    </form>
    <?php
    include_once('general_scripts.php'); // Scripts for all html files
    ?>
<script type="text/javascript">
    $('#startQuizForm').submit(function(e) {
        e.preventDefault();
        if (isFormValid()) { // Check if form is valid
            $('#isFormPosted').val(1);
            $('#startQuizForm')[0].submit();
        }
    });
    function isFormValid() { // Validation function
        var message = '';
        var userName = $('#userName').val();
        var quizType = $('#quizType').val();
        if (userName === '' && quizType !== '') {
            message = 'You must enter your name!';
        } else if (userName !== '' && quizType === '') {
            message = 'You must select your quiz type!';
        } else {
            message = 'You must enter your name and select your quiz type!';
        }
        if (userName === '' || quizType === '') {
            $.notify({
                message: message
            }, {
                type: 'danger'
            });
            return false;
        } else {
            return true;
        }
    }
</script>
</body>
</html>