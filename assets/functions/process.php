<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$class = $_POST['class'];

switch (strtolower($class)) {
    case 'appointment':
        $result = saveNewAppointmentAndClient($_POST);
        echo $result;
        break;
    case 'guestbook':
        $result = saveMessage($_POST);
        echo $result;
        break;
    case 'contact':
        $result = sendMail('info@scissors2you.be', $_POST['firstname'], $_POST['lastname'], $_POST['subject'], $_POST['message'], $_POST['email'], true);
        echo $result;
        break;
    default:
        return json_encode(array('fname' => 'N/A', 'id' => '3'));
        
}

?>