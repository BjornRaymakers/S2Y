<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$class = $_POST['class'];
$action = $_POST['action'];

switch (strtolower($class)) {
    case 'client':
        switch (strtolower($action)) {
            case 'save':
                $result = saveClient($_POST);
                echo $result;
                break;
            case 'del':
                $result = deleteClient($_POST["custid"]);
                echo $result;
                break;
        }
        break;
    case 'guestbook':
        switch (strtolower($action)) {
            case 'toggle':
                $result = toggleMessage($_POST['id']);
                echo $result;
                break;
            case 'del':
                $result = deleteMessage($_POST['id']);
                echo $result;
                break;
        }
        break;
    case 'article':
        switch (strtolower($action)) {
            case 'save':
                $result = saveArticle($_POST);
                echo $result;
                break;
            case 'del':
                $result = deleteArticle($_POST["priceid"]);
                echo $result;
                break;
        }
        break;
    case 'appointment':
        switch (strtolower($action)) {
            case 'save':
                $result = saveAppointment($_POST);
                echo $result;
                break;
            case 'del':
                $result = deleteAppointment($_POST['appid']);
                echo $result;
                break;
            case 'bill':
                $result = createBill($_POST['id']);
                echo $result;
                break;
            case 'mail':
                $appointment = getAppointmentByID($_POST['appid']);
                $client = $appointment->getClient();

                $mail_body = createAppointmentDeal($appointment);
                $mail_subject = 'Afspraak bevestiging bij Scissors 2 You';

                $sended = false;
                if ($mail_body) {
                    $sended = sendMail($client->getEmail(), $client->getFirstname(), $client->getLastname(), $mail_subject, $mail_body, 'info@scissors2you.be', false);
                }

                $sql = 'UPDATE appointments SET mail_send=' . $sended. ' WHERE id=' . $appointment->getId();
                update_db($sql);

                $result = json_encode(array('send' => $sended, 'fullname' => $client->getFullname(), 'body' => $mail_body, 'subject' => $mail_subject));

                echo $result;
                break;
        }
        break;
    case 'bill':
        switch (strtolower($action)) {
            case 'del':
                $result = deleteBill($_POST['id'], $_POST['appid']);
                echo $result;
                break;
        }
        break;
    case 'gift':
        switch (strtolower($action)) {
            case 'del':
                $result = deleteGift($_POST['id']);
                echo $result;
                break;
            case 'save':
                $result = saveGift($_POST);
                echo $result;
                break;
        }
        break;
    case 'act':
        switch (strtolower($action)) {
            case 'save':
                $result = saveAction($_POST);
                echo $result;
                break;
            case 'del':
                $result = deleteAction($_POST['actid']);
                echo $result;
                break;
        }
        break;
    case 'tempclients':
        switch (strtolower($action)) {
            case 'flush':
                $result = flushTemporaryClients();
                echo $result;
                break;
        }
        break;
    default:
        echo json_encode(array('string' => '', 'id' => '', 'redirect' => false));

}

?>