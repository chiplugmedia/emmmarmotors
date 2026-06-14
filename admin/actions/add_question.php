<?php
$genMsg = $question_text = $correct_answer = $charamount = $winamount="";
$answers = array();

if (isset($_POST['addquestion'])) {
    $genMsg = "";

    // Validate and sanitize inputs
    $question_text = isset($_POST['question_text']) && !empty($_POST['question_text']) 
        ? htmlspecialchars($_POST['question_text'], ENT_QUOTES, 'UTF-8') 
        : null;
    if (!$question_text) {
        $status = "error";
        $message = "Enter question";
        $genMsg = sendResponse($status, $message);
    }

    $correct_answer = isset($_POST['correct_answer']) && !empty($_POST['correct_answer']) 
        ? htmlspecialchars($_POST['correct_answer'], ENT_QUOTES, 'UTF-8') 
        : null;
    if (!$correct_answer) {
        $status = "error";
        $message = "Enter correct answer";
        $genMsg = sendResponse($status, $message);
    }

    $charamount = isset($_POST['amount']) && !empty($_POST['amount']) 
        ? (float) $_POST['amount'] 
        : null;
    if (!$charamount) {
        $status = "error";
        $message = "Enter amount to charge";
        $genMsg = sendResponse($status, $message);
    }

    $winamount = isset($_POST['winamount']) && !empty($_POST['winamount']) 
        ? (float) $_POST['winamount'] 
        : null;
    if (!$winamount) {
        $status = "error";
        $message = "Enter amount to credit";
        $genMsg = sendResponse($status, $message);
    }

    $answers = isset($_POST['answers']) && !empty($_POST['answers']) 
        ? $_POST['answers'] 
        : null;
    if (!$answers || !is_array($answers)) {
        $status = "error";
        $message = "Enter at least one answer";
        $genMsg = sendResponse($status, $message);
    }

    if (empty($genMsg)) {
        $reference = get_rand_alphanumeric(10);
        $dateTime = date("Y-m-d H:i:s"); // Current timestamp

        // Insert question into the database
        $sql = $link->prepare(
            "INSERT INTO questions (question_text, correct_answer, amount, winamount, reference, date) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $sql->bind_param("ssssss", $question_text, $correct_answer, $charamount, $winamount, $reference, $dateTime);

        if ($sql->execute()) {
            // Insert answers into another table
            $question_id = $link->insert_id; // Get the ID of the inserted question
            foreach ($answers as $answer) {
                $answer_text = htmlspecialchars($answer, ENT_QUOTES, 'UTF-8'); // Sanitize answer
                $sql_answer = $link->prepare(
                    "INSERT INTO answers (question_id, answer_text) VALUES (?, ?)"
                );
                $sql_answer->bind_param("is", $question_id, $answer_text);
                $sql_answer->execute();
            }

            $status = "success";
            $message = "Question uploaded successfully";
            $genMsg = sendResponse($status, $message);
        } else {
            $status = "error";
            $message = "Failed to upload question";
            $genMsg = sendResponse($status, $message);
        }
    }
}

if (isset($_POST['deletePost'])) {

    if (empty($_POST['id'])) {
        $status = "error";
        $message = "Something went wrong";
        $genMsg = sendResponse($status, $message);
    }

    $id = filter_string($_POST['id']);
    $sql = $link->prepare("SELECT * FROM questions WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // First delete all answers linked to this question
        $sql_delete_answers = $link->prepare("DELETE FROM answers WHERE question_id = ?");
        $sql_delete_answers->bind_param("i", $id);
        $sql_delete_answers->execute();

        // Then delete the question itself
        $sql_delete_question = $link->prepare("DELETE FROM questions WHERE id = ?");
        $sql_delete_question->bind_param("i", $id);
        if ($sql_delete_question->execute()) {
            $status = "success";
            $message = "Question deleted successfully";
            $genMsg = sendResponse($status, $message);
        } else {
            $status = "error";
            $message = "Failed to delete question";
            $genMsg = sendResponse($status, $message);
        }
    } else {
        $status = "error";
        $message = "Question not found";
        $genMsg = sendResponse($status, $message);
    }
}
?>
