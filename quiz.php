<?php
include_once('quiz_src.php'); // Operations for quiz.php are made in this page.
include_once('general_header.php'); // Header for all html files
?>
<body id='body_<?php echo $quiz_type; ?>' class="text-center">
    <form id="startQuestionForm" class="form-quiz" action="quiz_src.php" method="post">
        <img class="mb-4" src="assets/images/q_grey.png" alt="" width="72" height="72">
            <?php
            echo '<input id="questionId" type="hidden" name="question_id" value="' . $question['id'] . '"/>';
            echo '<input id="quizType" type="hidden" name="quiz_type" value="' . $question['quiz_type'] . '"/>';
            echo '<input id="questionNumber" type="hidden" name="question_number" value="' . $question_number . '"/>';
            echo '<input id="questionCount" type="hidden" name="question_count" value="' . $question_count['count'] . '"/>';
            echo '<h1 id="question" class="h3 mb-3 font-weight-normal">' . $question['question'] . '</h1>';
            ?>
            <div id="answersRow" class="row">
                <?php
                foreach ($answers as $answer) {
                    if ($answer['is_option_true']) {
                        echo '<input type="hidden" name="which_option_true" value="' . $answer['id'] . '"/>';
                    }
                    echo '
                    <div class="form-group col-sm-6">
                        <label class="btn btn-outline-dark">
                            <input type="radio" name="answer_options" value="' . $answer['id'] . '"> ' . $answer['option'] . '
                        </label>
                    </div>';
                }
                ?>
            </div>
            <div class="progress mb-4">
                <?php
                echo '<div id="dynamicProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="' . ($progress_bar_value) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . ($progress_bar_value) . '%">';
                echo '<span id="progressBarText" class="text-dark">' . $progress_bar_value . '%</span>';
                echo '</div>';
                ?>
            </div>
            <button id="submitQuestionForm" class="btn btn-lg btn-dark btn-block">Next Question</button>
            <a id="resultId" class="btn btn-dark" style="display: none;" href="result.php" role="button">Show My Result</a>
    </form>
    <?php
    include_once('general_scripts.php'); // Scripts for all html files
    ?>
<script type="text/javascript">
    $('#startQuestionForm').submit(function(e) {
        e.preventDefault();
        if (isFormValid()) { // Check if form is valid
            var formData = {
                'question_id': $('input[name=question_id]').val(),
                'quiz_type': $('input[name=quiz_type]').val(),
                'question_number': $('input[name=question_number]').val(),
                'question_count': $('input[name=question_count]').val(),
                'which_option_true': $('input[name=which_option_true]').val(),
                'answer_options': $('input[name=answer_options]:checked').val(),
            };

            $.ajax({
                type: 'POST',
                url: 'quiz_src.php',
                data: formData,
                dataType: 'json',
                encode: true,
                success: function(data) {
                    if (!data['show_result']) { // If last question is not answered, this part will work
                        $('#question').html(data['question']['question']); // Changes the question text after first question is answered
                        $("#dynamicProgressBar") // Changes the progress bar value and text after first question is answered
                                .css("width", data['progress_bar_value'] + "%")
                                .attr("aria-valuenow", data['progress_bar_value']);
                        $("#progressBarText").attr("class", "text-white").text(data['progress_bar_value'] + "%");
                        var answers = data['answers'];
                        var answerOptionsHtmlPart = '';
                        $.each(answers, function(index, answer) { // Changes the answer option radio buttons and hidden input that stores which option is true after first question is answered
                            if (answer['is_option_true'] === '1') {
                                answerOptionsHtmlPart += '<input type="hidden" name="which_option_true" value="' + answer['id'] + '"/>'
                            }
                            answerOptionsHtmlPart += '<div class="form-group col-sm-6"><label class="btn btn-outline-dark"><input type="radio" name="answer_options" value="' + answer['id'] + '"> ' + answer['option'] + '</label></div>';
                        });
                        $('#answersRow').html(answerOptionsHtmlPart);
                        $('#questionId').val(data['question']['id']);
                        $('#quizType').val(data['question']['quiz_type']);
                        $('#questionNumber').val(data['question_number']);
                        $('#questionCount').val(data['question_count']);
                    } else { // If last question is answered, this part will work
                        $('#submitQuestionForm').hide();
                        $('#resultId').show();
                        $("#dynamicProgressBar")
                                .css("width", data['progress_bar_value'] + "%")
                                .attr("aria-valuenow", data['progress_bar_value']);
                        $("#progressBarText").attr("class", "text-white").text(data['progress_bar_value'] + "%");
                        $("#answersRow").hide();
                        $("#question").html('You have successfully finished the quiz!');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { // Handles error
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    });
    function isFormValid() { // Checks if form is valid
        var message = '';
        var isAnAnswerSelected = $("input[name='answer_options']:checked").val(); // Checks if at least one radio button is selected
        if (!isAnAnswerSelected) {
            $.notify({
                message: 'You have to select one of the options!'
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