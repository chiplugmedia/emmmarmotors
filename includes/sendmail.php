<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'] . "$stream/mailer/src/Exception.php";
require $_SERVER['DOCUMENT_ROOT'] . "$stream/mailer/src/PHPMailer.php";
require $_SERVER['DOCUMENT_ROOT'] . "$stream/mailer/src/SMTP.php"; 


function sendMail($email, $fullname, $message, $subject, $type="") {
    $sitelink = "aimvest.com.ng";
    
    // Base CSS for all email templates
    $baseCSS = "
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Nunito', sans-serif !important;
                background-color: #f8fafc;
                margin: 0;
                padding: 20px;
            }
            
            .email-container {
                max-width: 600px;
                margin: 0 auto;
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            
            .email-header {
                background: linear-gradient(135deg, #032021 0%, #032021 100%);
                padding: 30px 20px;
                text-align: center;
            }
            
            .email-logo {
                height: 50px;
                width: auto;
            }
            
            .email-body {
                padding: 40px 30px;
                color: #334155;
                line-height: 1.6;
            }
            
            .email-title {
                color: #1e293b;
                font-size: 24px;
                font-weight: 700;
                margin-bottom: 20px;
            }
            
            .email-greeting {
                color: #1e293b;
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 15px;
            }
            
            .email-content {
                margin-bottom: 25px;
                color: #475569;
            }
            
            .email-button {
                display: inline-block;
                background: linear-gradient(49deg, #ebbb44, #ebbb44);
                color: #000;
                padding: 14px 32px;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 16px;
                border: 2px solid transparent;
                transition: all 0.3s ease;
                text-align: center;
                margin: 20px 0;
            }
            
            .email-button:hover {
                background: transparent;
                color: #000;
                border: 2px solid #ebbb44;
                box-shadow: 0 0 15px #ebbb44;
            }
            
            .info-box {
                background: #f1f5f9;
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0;
                border-left: 4px solid #ebbb44;
            }
            
            .info-label {
                color: #64748b;
                font-weight: 600;
                margin-bottom: 5px;
            }
            
            .info-value {
                color: #1e293b;
                font-weight: 500;
            }
            
            .contact-info {
                background: #f8fafc;
                padding: 20px;
                border-radius: 8px;
                margin: 25px 0;
                text-align: center;
            }
            
            .contact-link {
                color: #32e6e3;
                text-decoration: none;
                font-weight: 600;
            }
            
            .contact-link:hover {
                text-decoration: underline;
            }
            
            .email-footer {
                background: #1e293b;
                color: white;
                text-align: center;
                padding: 25px 20px;
                font-size: 14px;
            }
            
            .footer-text {
                margin-bottom: 10px;
                color: #cbd5e1;
            }
            
            .copyright {
                color: #94a3b8;
                font-size: 13px;
            }
            
            .warning-text {
                color: #dc2626;
                background: #fef2f2;
                padding: 15px;
                border-radius: 8px;
                margin: 20px 0;
                border-left: 4px solid #dc2626;
                font-weight: 600;
            }
            
            .social-links {
                margin: 20px 0;
            }
            
            .social-link {
                color: #32e6e3;
                text-decoration: none;
                margin: 0 10px;
            }
           .contact-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #32e6e3;
    text-decoration: none;
}

.contact-link img {
    vertical-align: middle;
}


        </style>
    ";
    
    // Start building the email body
    $body = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'>
            <link href='https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap' rel='stylesheet'>
            " . $baseCSS . "
        </head>
        <body>
    ";
    
    // Forgot Password Template
    if ($type == "forgotPsw") {
        $fullname = $message['fullname'];
        $pswToken = $message['pswToken'];
        
        $body .= "
            <div class='email-container'>
                <div class='email-header text-center py-4'>
  <span class='text-2xl font-extrabold text-yellow-400'>American Investment</span><br>
  <span class='text-sm font-semibold text-gray-300'>Mining Platform</span>
</div>

                
                <div class='email-body'>
                    <h1 class='email-title'>Reset Your Password</h1>
                    
                    <p class='email-greeting'>Hello, $fullname</p>
                    
                    <div class='email-content'>
                        <p>We received a request to reset your password. Click the button below to create a new password:</p>
                    </div>
                    
                    <div style='text-align: center;'>
                        <a href='https://$sitelink/reset-password.php?tkn=$pswToken' class='email-button'>
                            Reset Password
                        </a>
                    </div>
                    
                    <div class='warning-text'>
                        <p><strong>Important:</strong> This link will expire in 2 minutes for security reasons.</p>
                    </div>
                    
                    <div class='info-box'>
                        <p>If you didn't request this password reset, please ignore this email. Your account remains secure.</p>
                    </div>
                    
                 


                </div>
                
                <div class='email-footer'>
                    <p class='footer-text'>This is an automated email. Please do not reply to this message.</p>
                    <p class='copyright'>&copy; " . date('Y') . " American Investment mining platform. All rights reserved.</p>
                </div>
            </div>
        ";
    }
    
    // Welcome Email Template
    else if ($type == "welcomeMail") {
        $body .= "
            <div class='email-container'>
                <div class='email-header'>
                    <img src='https://$sitelink/mailer/hivelink.png' alt='Hirelink Logo' class='email-logo'>
                </div>
                
                <div class='email-body'>
                    <h1 class='email-title'>Welcome to Hirelink! ðŸŽ‰</h1>
                    
                    <p class='email-greeting'>Hello, $fullname</p>
                    
                    <div class='email-content'>
                        <p>We're thrilled to welcome you to Hirelink! You've joined the simplest platform for all your account needs.</p>
                        
                        <p>Whether you're looking for marketing solutions, brand promotion, newsletters, or other services, we've got you covered.</p>
                        
                        <p>Our dedicated support team is always ready to assist you on your journey through Hirelink. We're committed to making your experience smooth and successful.</p>
                    </div>
                    
                    <div class='contact-info'>
                        <h3 style='color: #1e293b; margin-bottom: 15px;'>Get In Touch</h3>
                        <p><strong>Email:</strong> <a href='mailto:info@$sitelink' class='contact-link'>info@$sitelink</a></p>
                        
                        <div class='social-links'>
                            <p><strong>Join our community:</strong></p>
                            <a href='https://t.me/+huq-AgqvOU0wMzg0' class='social-link'>ðŸ“± Telegram Group</a>
                        </div>
                    </div>
                    
                    <div class='info-box'>
                        <p><strong>Remember:</strong> We're always just one step away to assist you with whatever you need to make your journey smooth and successful.</p>
                    </div>
                    
                    <div style='text-align: center; margin: 30px 0; padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 8px;'>
                        <p style='color: #1e293b; font-weight: 600;'>Thank you for choosing Hirelink!</p>
                        <p style='color: #475569; margin-top: 10px;'>We're excited to be part of your journey.</p>
                    </div>
                    
                      <div class='contact-info'>
    <p><strong>Follow & Contact Us</strong></p>

    <p>
        <a href='https://t.me/HIRELINK_GLOBAL_WORKPLACE' target='_blank' class='contact-link'>
            <img src='https://cdn-icons-png.flaticon.com/512/2111/2111646.png' width='20' alt='Telegram'>
            Telegram
        </a>
    </p>

    <p>
        <a href='https://www.tiktok.com/@hirelink.glob.workplace' target='_blank' class='contact-link'>
            <img src='https://cdn-icons-png.flaticon.com/512/3046/3046126.png' width='20' alt='TikTok'>
            TikTok
        </a>
    </p>
</div>

                
                <div class='email-footer'>
                    <p class='footer-text'>Welcome aboard! We're here to help you succeed.</p>
                    <p class='copyright'>&copy; " . date('Y') . " American Investment mining platform. All rights reserved.</p>
                </div>
            </div>
        ";
    }
    
    // Login Notification Template
    else if ($type === "loginNotify") {
        $ip = $message['ip'];
        $datetime = $message['datetime'];
        
        $body .= "
            <div class='email-container'>
                 <div class='email-header text-center py-4'>
  <span class='text-2xl font-extrabold text-yellow-400'>American Investment</span><br>
  <span class='text-sm font-semibold text-gray-300'>Mining Platform</span>
</div>
                
                <div class='email-body'>
                    <h1 class='email-title'>New Login Detected</h1>
                    
                    <p class='email-greeting'>Hello, $fullname</p>
                    
                    <div class='email-content'>
                        <p>We detected a successful login to your AIM account.</p>
                    </div>
                    
                    <div class='info-box'>
                        <div class='info-label'>Login Details:</div>
                        <div class='info-value'>Date & Time: $datetime</div>
                        <div class='info-value'>IP Address: $ip</div>
                    </div>
                    
                    <div class='warning-text'>
                        <p><strong>Security Alert:</strong> If this wasn't you, please change your password immediately and contact our support team.</p>
                    </div>
                    
                      <div class='contact-info'>
    <p><strong>Follow & Contact Us</strong></p>

 <p>
    <a href='https://wa.me/15136878216?text=Hello%20I%20need%20help'
       target='_blank'
       class='contact-link flex items-center gap-2'>

        <img src='https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg'
             width='20'
             height='20'
             alt='WhatsApp'>

        <span>Chat on WhatsApp</span>
    </a>
</p>

   
</div>

                
                <div class='email-footer'>
                    <p class='footer-text'>Protect your account. Never share your login details.</p>
                    <p class='copyright'>&copy; " . date('Y') . " American Investment mining platform. All rights reserved.</p>
                </div>
            </div>
        ";
    }
    
    // Admin Notification Template
    else if ($type == "adminMail") {
        $body .= "
            <div class='email-container'>
                <div class='email-header'>
                    <img src='https://$sitelink/mailer/hivelink.png' alt='American Investment mining platform Logo' class='email-logo'>
                </div>
                
                <div class='email-body'>
                    <h1 class='email-title'>New Pending Deposit</h1>
                    
                    <div class='email-content'>
                        <p>Hello Admin,</p>
                        <p>A new deposit requires your approval.</p>
                    </div>
                    
                    <div class='info-box'>
                        <div class='info-label'>User:</div>
                        <div class='info-value'>$fullname</div>
                        
                        <div class='info-label'>Status:</div>
                        <div class='info-value'>Pending Approval</div>
                    </div>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <p>Please log in to the admin panel to review this deposit.</p>
                    </div>
                </div>
                
                <div class='email-footer'>
                    <p class='footer-text'>Admin Notification - Action Required</p>
                    <p class='copyright'>&copy; " . date('Y') . " American Investment mining platform. All rights reserved.</p>
                </div>
            </div>
        ";
    }
    
    // Message to Users Template
    else if ($type == "messagetousers") {
        $body .= "
            <div class='email-container'>
                <div class='email-header'>
                    <img src='https://$sitelink/mailer/hivelink.png' alt='American Investment mining platform Logo' class='email-logo'>
                </div>
                
                <div class='email-body'>
                    <h1 class='email-title'>Important Message</h1>
                    
                    <p class='email-greeting'>Hello, $fullname</p>
                    
                    <div class='email-content'>
                        $message
                    </div>
                    
                    <div class='contact-info'>
                        <p><strong>Need assistance?</strong> Our support team is here to help:</p>
                        <p><a href='mailto:support@$sitelink' class='contact-link'>support@$sitelink</a></p>
                    </div>
                </div>
                
                <div class='email-footer'>
                    <p class='footer-text'>Thank you for being a valued member of American Investment mining platform.</p>
                    <p class='copyright'>&copy; " . date('Y') . " American Investment mining platform. All rights reserved.</p>
                </div>
            </div>
        ";
    }
    
    // Default Template (for generic messages)
    else {
        $body .= "
            <div class='email-container'>
                <div class='email-header'>
                    <img src='https://$sitelink/mailer/hivelink.png' alt='American Investment mining platform Logo' class='email-logo'>
                </div>
                
                <div class='email-body'>
                    <h1 class='email-title'>$subject</h1>
                    
                    <div class='email-content'>
                        $message
                    </div>
                    
                    <div class='contact-info'>
                        <p>For any questions, contact us at <a href='mailto:support@$sitelink' class='contact-link'>support@$sitelink</a></p>
                    </div>
                </div>
                
                <div class='email-footer'>
                    <p class='copyright'>&copy; " . date('Y') . " American Investment mining platform. All rights reserved.</p>
                </div>
            </div>
        ";
    }
    
    $body .= "
        </body>
        </html>
    ";
    
    // PHPMailer configuration remains the same
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = 'mail.aimvest.com.ng';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@aimvest.com.ng';
        $mail->Password = '7FzdQ8qeu14F5#2K';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        $mail->setFrom('info@aimvest.com.ng', 'American Investment mining platform');
        $mail->addAddress($email, $fullname);
        $mail->addReplyTo('info@aimvest.com.ng', 'American Investment mining platform Support');
        
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);
        
        if ($mail->send()) {
            $response = array("status" => "success", "message" => "Mail sent to recipient");
        } else {
            throw new Exception("Mail could not be sent.");
        }
    } catch (Exception $e) {
        $message = $mail->ErrorInfo;
        $response = array("status" => "failed", "message" => $message);
    }
    
    return $response;
}
?>