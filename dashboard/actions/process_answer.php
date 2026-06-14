<?php
$genMsg = ""; // Initialize general message variable



if (isset($_POST['questionqize'])) {

    // ─────────────────────────────────────────────
    // VALIDATION
    // ─────────────────────────────────────────────
    if (empty($_POST['correct_answer']) || empty($_POST['reference'])) {

        $genMsg = sendResponse("error", "Please provide a correct answer and a reference.");

    } else {

        $correct_answer = filter_string($_POST['correct_answer']);
        $reference      = filter_string($_POST['reference']);

        // ─────────────────────────────────────────────
        // FETCH USER STATUS
        // ─────────────────────────────────────────────
        $sql = $link->prepare("SELECT unlocked, funds FROM users WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $userStatusRow = $sql->get_result()->fetch_assoc();

        $isUnlocked = (int)($userStatusRow['unlocked'] ?? 0);
        $funds      = (float)($userStatusRow['funds'] ?? 0);

        // ── BLOCK: spin restriction ──
        if ($spinWheel == "1" && $isUnlocked == 0) {

            $genMsg = sendResponse("error", "Unlock Package to access more limit");

        } else {

            // ─────────────────────────────────────────────
            // CHECK QUESTION EXISTS
            // ─────────────────────────────────────────────
            $sql = $link->prepare("SELECT * FROM questions WHERE reference = ?");
            $sql->bind_param("s", $reference);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows == 0) {

                $genMsg = sendResponse("error", "Invalid question reference.");

            } else {

                $row = $result->fetch_assoc();

                $amount         = (float)$row['amount'];
                $winamount      = (float)$row['winamount'];
                $question_text  = $row['question_text'];

                // ─────────────────────────────────────────────
                // CHECK FUNDS
                // ─────────────────────────────────────────────
                if ($amount > $funds) {

                    $genMsg = sendResponse("error", "Insufficient funds in your activity wallet.");

                } else {

                    // ─────────────────────────────────────────────
                    // DEDUCT FUNDS
                    // ─────────────────────────────────────────────
                    $sql = $link->prepare("UPDATE users SET funds = funds - ? WHERE username = ?");
                    $sql->bind_param("ds", $amount, $username);
                    $sql->execute();

                    // ─────────────────────────────────────────────
                    // CHECK IF ALREADY ANSWERED
                    // ─────────────────────────────────────────────
                    $sql = $link->prepare("
                        SELECT id FROM user_answers 
                        WHERE username = ? AND reference = ?
                    ");
                    $sql->bind_param("ss", $username, $reference);
                    $sql->execute();
                    $alreadyAnswered = $sql->get_result()->num_rows > 0;

                    if ($alreadyAnswered) {

                        $genMsg = sendResponse("error", "You have already answered this question.");

                    } else {

                        // ─────────────────────────────────────────────
                        // CHECK CORRECT ANSWER
                        // ─────────────────────────────────────────────
                        $sql = $link->prepare("
                            SELECT id FROM questions 
                            WHERE reference = ? AND correct_answer = ?
                        ");
                        $sql->bind_param("ss", $reference, $correct_answer);
                        $sql->execute();
                        $is_correct = $sql->get_result()->num_rows > 0;

                        $reward = 0;

                        if ($is_correct) {

                            $reward = $winamount;

                            // ── ADD REWARD ──
                            $sql = $link->prepare("UPDATE users SET funds = funds + ? WHERE username = ?");
                            $sql->bind_param("ds", $reward, $username);
                            $sql->execute();

                            // ── LOG EARNINGS ──
                            $type = "Game Sector";
                            $sql = $link->prepare("
                                INSERT INTO userearnings 
                                (username, type, amount, time, date)
                                VALUES (?, ?, ?, ?, ?)
                            ");
                            $sql->bind_param("ssdss", $username, $type, $reward, $dateTime, $dateTime);
                            $sql->execute();
                        }

                        // ─────────────────────────────────────────────
                        // LOG ANSWER
                        // ─────────────────────────────────────────────
                        $sql = $link->prepare("
                            INSERT INTO user_answers 
                            (username, question_text, correct_answer, amount, reference, date)
                            VALUES (?, ?, ?, ?, ?, ?)
                        ");
                        $sql->bind_param(
                            "sssiss",
                            $username,
                            $question_text,
                            $correct_answer,
                            $reward,
                            $reference,
                            $dateTime
                        );
                        $sql->execute();

                        // Click limit reduction code REMOVED

                        // ─────────────────────────────────────────────
                        // FINAL RESPONSE
                        // ─────────────────────────────────────────────
                        if ($is_correct) {
                            $genMsg = sendResponse("success", "Congratulations! Correct answer.");
                        } else {
                            $genMsg = sendResponse("error", "Sorry, your answer was incorrect.");
                        }
                    }
                }
            }
        }
    }
}
?>
