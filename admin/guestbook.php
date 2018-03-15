<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");
?>

<!-- Javascript -->
<script src="assets/js_s2y/guestbook.js"></script>

<!-- Post -->
<section>
    <h2>Gastenboek beheer</h2>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='1%'></th>
                <th width='1%'></th>
                <th width='10%'>Datum</th>
                <th width='10%'>Naam</th>
                <th>Bericht</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $messages = getMessages();

            foreach ($messages as &$message) {
                if ($message->isApproved()) {
                    echo "<tr>";
                    echo "<td><a href='#' class='icon' onclick='toggleVisibility(" . $message->getId() . ")'><i class='far fa-check-circle'/></a></td>";
                    echo "<td><a href='#' class='icon' onclick='deleteMessage(" . $message->getId() . ")'><i class='far fa-trash-alt'/></a></td>";
                    echo "<td>" . $message->getDate() . "</td>";
                    echo "<td>" . $message->getName() . "</td>";
                    echo "<td>" . $message->getMessage() . "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr>";
                    echo "<td><a href='#' onclick='toggleVisibility(" . $message->getId() . ")' class='icon-warning'><i class='fas fa-exclamation-circle fa-spin'/></a></td>";
                    echo "<td><a href='#' onclick='deleteMessage(" . $message->getId() . ")' title='Bericht is niet zichtbaar' class='icon'><i class='far fa-trash-alt'/></a></td>";
                    echo "<td>" . $message->getDate() . "</td>";
                    echo "<td>" . $message->getName() . "</td>";
                    echo "<td>" . $message->getMessage() . "</td>";
                    echo "</tr>";
                }
            }

            ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>	