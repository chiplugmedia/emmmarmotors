<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/home/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/home/actions/process_answer.php";



$ptitle="Game Sector";
include "inc/header2.php" ?>
 
 
 
<strong><?php echo $genMsg?></strong>
<section class="max-w-4xl mx-auto px-4 mt-6 space-y-6">

  <!-- Instruction Card -->
  <div class="bg-white border border-red-100 rounded-2xl shadow-sm p-5 relative overflow-hidden">
    <!-- Decorative glowing dots -->
    <div class="absolute rounded-full bg-red-300 opacity-20 blur-2xl" style="width:28px;height:298px;left:30%;top:20%;"></div>
    <div class="absolute rounded-full opacity-20 blur-2xl" style="width:56px;height:56px;left:60%;top:10%;background:#2BB15B;"></div>
    <p class="text-gray-800 text-sm relative z-10">
      <span class="font-semibold text-red-600">Instruction:</span>
      Answer this question by choosing the correct option from (a) to (e).
    </p>
  </div>

  <?php
  $date = date("Y-m-d");
  $sql = $link->prepare("SELECT * FROM questions WHERE reference NOT IN (SELECT reference FROM user_answers WHERE username=?) AND SUBSTRING(date, 1, 10) = ?");
  $sql->bind_param("ss", $username, $date);
  $sql->execute();
  $result = $sql->get_result();
  $numrow = $result->num_rows;

  if ($numrow > 0):
    while ($row = $result->fetch_assoc()):
      $question_text = htmlspecialchars($row['question_text']);
      $reference     = htmlspecialchars($row['reference']);
  ?>

  <!-- Question + Answer Card -->
  <div class="bg-white border border-red-100 rounded-2xl shadow-sm p-6">

    <!-- Question Text -->
    <p class="text-gray-800 font-medium mb-5"><?php echo $question_text; ?></p>

    <form action="" method="POST" enctype="multipart/form-data">

      <p class="text-sm font-semibold text-red-600 mb-3">Choose One Answer:</p>

      <div class="space-y-3">
        <?php
        $sql_answers = $link->prepare("SELECT * FROM answers WHERE question_id = ?");
        $sql_answers->bind_param("i", $row['id']);
        $sql_answers->execute();
        $result_answers = $sql_answers->get_result();

        if ($result_answers->num_rows > 0):
          while ($row_answer = $result_answers->fetch_assoc()):
            $answer_text = htmlspecialchars($row_answer['answer_text']);
        ?>
        <label class="flex items-center gap-3 cursor-pointer group">
          <input
            type="radio"
            name="correct_answer"
            id="<?php echo $answer_text; ?>"
            value="<?php echo $answer_text; ?>"
            class="w-4 h-4 accent-red-500 cursor-pointer"
          >
          <span class="text-sm text-gray-700 group-hover:text-red-600 transition-colors duration-150">
            <?php echo $answer_text; ?>
          </span>
        </label>
        <?php
          endwhile;
        else:
          echo '<p class="text-sm text-gray-400">No answers available for this question.</p>';
        endif;
        ?>
      </div>

      <input type="hidden" name="reference" id="reference" value="<?php echo $reference; ?>">

      <button
        type="submit"
        name="questionqize"
        class="mt-6 w-full bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold text-sm py-2.5 px-6 rounded-xl transition-colors duration-150"
      >
        Submit
      </button>

    </form>
  </div>

  <?php
    endwhile;
  else:
  ?>

  <!-- Empty State -->
  <div class="bg-red-50 border border-red-100 rounded-2xl p-5">
    <p class="text-red-500 font-medium text-sm">No questions at the moment, check back later.</p>
  </div>

  <?php endif; ?>

</section>


<?php include "inc/footer2.php" ?>
