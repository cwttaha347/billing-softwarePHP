<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
function send_notification($subject, $s_id, $in_2)
{
    global $con;
    global $mail;

    $que = mysqli_query($con, "SELECT * FROM `notifications_config` WHERE `id`='1'");
    $row_notify = mysqli_fetch_assoc($que);

    $fetch_config_notify = fetch_data("notifications_config", "=", "id", "1");
    if ($fetch_config_notify['status'] === "1") {
        $res_temp = mysqli_query($con, "SELECT * FROM temp_mail WHERE session_id='$s_id'");
        $fetch_temp = mysqli_fetch_assoc($res_temp);
        $message = '
       <!DOCTYPE html>
       <html lang="en">
       <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Invoice Details</title>
       <style>
       body {
       font-family: Arial, sans-serif;
       margin: 0;
       padding: 20px;
       background-color: #f4f4f4;
       }
       .table-container {
       width: 100%;
       max-width: 600px;
       margin: 0 auto;
       background: #ffffff;
       border-radius: 8px;
       overflow: hidden;
       box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
       }
       table {
       width: 100%;
       border-collapse: collapse;
       }
       th, td {
       padding: 12px;
       text-align: left;
       border-bottom: 1px solid #ddd;
       }
       th {
       background-color: #007bff;
       color: white;
       }
       tr:hover {
       background-color: #f1f1f1;
       }
       .footer {
       padding: 15px;
       text-align: center;
       font-size: 12px;
       color: #777;
       }
       </style>
       </head>
       <body>
       
       <div class="table-container">
       <h2 style="text-align: center;">Invoice Info</h2>
       <table>
       <thead>
       <tr>
           <th>Invoice id</th>
           <th>Product Names</th>
           <th>Product Quantities</th>
           <th>Product Serial Numbers</th>
           <th>Price</th>
       
       
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>' . $fetch_temp['invoice_id'] . '</td>
           <td>' . $fetch_temp['product_names'] . '</td>
           <td>' . $fetch_temp['qty'] . '</td>
           <td>' . $fetch_temp['serial_no'] . '</td>
           <td>' . $fetch_temp['price'] . '</td>
       
       </tr>
       
       </tbody>
       </table>
       <div class="footer">
       Software Generated Notification Developed CWT Team
       </div>
       </div>
       
       </body>
       </html>
       
       
       ';

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $row_notify['email'];
            $mail->Password = $row_notify['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($row_notify['email'], 'Al-Asif_Boutique Management System');
            $mail->addAddress($row_notify['reciever_email'], 'Al-Asif Admin');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            if ($mail->send()) {
                mysqli_query($con, "DELETE FROM `temp_mail` WHERE `id`='$in_2'");
                return true;
            } else {
                error_log("PHPMailer send failed: " . $mail->ErrorInfo);
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
