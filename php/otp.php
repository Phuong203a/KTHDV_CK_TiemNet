
<?php
require_once('connection.php');
function generateAndSaveOTP($email)
{
    $otp = generateOTP($email);
    return $otp;
}


function generateOTP($email)
{
    global $dbCon;
    $getCurrentOtpQuery = 'SELECT id,email,otp,status,create_date,update_date 
    FROM otp 
    WHERE status = 0 
    and create_date BETWEEN DATE_SUB(NOW(), INTERVAL 5 MINUTE) and NOW()
    and otp = :otp';
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $otp = '';
    $count = 0;
    $maxAttempts = 10;
    do {

        for ($i = 0; $i < 6 ; $i++) {
            $index = rand(0, $charactersLength - 1);
            $otp .= $characters[$index];
        }
        $count++;
        $stmt = $dbCon->prepare($getCurrentOtpQuery);
        $stmt->bindParam(':otp', $otp);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } while ($result !== false && $count < $maxAttempts);
    if ($count >= $maxAttempts) {
        return null;
    }

    $stmtInsert = $dbCon->prepare("INSERT INTO otp (email,otp,create_date,update_date,status) VALUES (:email, :otp,NOW(),NOW(),0)");
    $stmtInsert->bindParam(':email', $email);
    $stmtInsert->bindParam(':otp', $otp);
    $stmtInsert->execute();
    return $otp;
}

function verifyOTP($email,$otp)
{
    global $dbCon;
    $getOtpByEmail = 'SELECT id,email,otp,status,create_date,update_date 
    FROM otp 
    WHERE status = 0 
    and create_date BETWEEN DATE_SUB(NOW(), INTERVAL 5 MINUTE) and NOW()
    and email = :email
    and otp = :otp
    LIMIT 1';

    $stmt = $dbCon->prepare($getOtpByEmail);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':otp', $otp);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result !== false) {
        $stmtUpdate = $dbCon->prepare("UPDATE otp SET status = 1, update_date = NOW() WHERE id = :id");
        $stmtUpdate->bindParam(':id', $result['id']);
        $stmtUpdate->execute();
        return true;
    } else {
        return false; 
    }

}
?>