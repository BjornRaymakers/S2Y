<!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/top.php");
?>

<!-- Javascript -->
<script src="assets/js_s2y/guestbook.js"></script>

<!-- Content -->
<section>
    <div class="row 200%">
        <?php
        include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

        $messages = getPublicMessages();
        $messagesleftrow = round((count($messages) / 2), 0);
        $messagesrightrow = count($messages) - $messagesleftrow;
        
        ?>
        <div class="6u 12u$(medium)">
            <?php
            for( $i= 0 ; $i <= $messagesleftrow - 1 ; $i++ ) {
                echo "<h2>" . $messages[$i]->getName() . "</h2>";
                echo "<blockquote><strong>" . $messages[$i]->getMessage() . "</strong><br><br>Geschreven op: " . $messages[$i]->getDate() . "</blockquote>";
            }
            ?>
        </div>
        <div class="6u 12u$(medium)">
            <?php
            for( $i=$messagesleftrow ; $i <= count($messages) - 1 ; $i++ ) {
                echo "<h2>" . $messages[$i]->getName() . "</h2>";
                echo "<blockquote><strong>" . $messages[$i]->getMessage() . "</strong><br><br>Geschreven op: " . $messages[$i]->getDate() . "</blockquote>";
            }
            ?>
        </div>
    </div>
    
    <hr class="major"/>

    <h2>Wil je ook een berichtje achterlaten?</h2>
    <form id="newmessage" class="alt">
        <div class="row uniform" id="writeguestbook">
            <div class="4u 12u$(small)">
                <input type="text" name="gb_fullname" id="gb_fullname" value="" placeholder="Naam" onkeydown="setBorderBackToOriginal('gb_fullname')" required/>
            </div>
            <div class="8u 12u$(small)">
                <input type="email" name="gb_email" id="gb_email" value="" placeholder="Email" onkeydown="setBorderBackToOriginal('gb_email')" required/>
            </div>
            <div class="12u$">
                <textarea name="gb_comments" id="gb_comments" rows="3" placeholder="Bericht" maxlength="1400" onkeydown="setBorderBackToOriginal('gb_comments')" required></textarea>
            </div>
            <ul class="actions">
                <li><input type="button" onclick="sendMessage()" value="Verstuur bericht"/></li>
            </ul>
        </div>
    </form>

</section>

<!-- Bottom -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/bottom.php");
?>