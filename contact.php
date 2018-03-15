<!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/top.php");
?>

<!-- Javascript -->
<script src="assets/js_s2y/contact.js"></script>

<!-- Content -->
<section>

    <h2>Heeft u een vraag? Stel ze gerust!</h2>
    <form id="newmail" class="alt">
        <div class="row uniform" id="writemail">
            <div class="3u 12u$(small)">
                <input type="text" name="firstname" id="firstname" value="" placeholder="Voornaam" onkeydown="setBorderBackToOriginal('firstname')" required/>
            </div>
            <div class="3u 12u$(small)">
                <input type="text" name="lastname" id="lastname" value="" placeholder="Achternaam" onkeydown="setBorderBackToOriginal('lastname')" required/>
            </div>
            <div class="6u 12u$(small)">
                <input type="email" name="email" id="email" value="" placeholder="Email" onkeydown="setBorderBackToOriginal('email')" required/>
            </div>
            <div class="12u$">
                <input type="text" name="subject" id="subject" value="" placeholder="Onderwerp" onkeydown="setBorderBackToOriginal('subject')" required/>
            </div>
            <div class="12u$">
                <textarea name="message" id="message" rows="7" placeholder="Bericht" onkeydown="setBorderBackToOriginal('message')" required></textarea>
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