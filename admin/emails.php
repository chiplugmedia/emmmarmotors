<?php 
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
//require $_SERVER['DOCUMENT_ROOT']."$stream/admin/includes/generalinclude.php";



?>




<?php
                                                    $sql=$link->prepare("SELECT * FROM users ORDER BY id DESC");
                                                    $sql->execute();
                                                    $result=$sql->get_result();
                                                    $numrow=$result->num_rows;
                                                    if($numrow > 0){
                                                        while($row=$result->fetch_assoc()){
                                                            $id=$row['id'];
                                                            $email=$row['email'];
                                                            
                                                    ?>
                                                    
                                                    <p><?php echo $email?>,</p>
                                                    
                                                    
                                                    <?php }} ?>