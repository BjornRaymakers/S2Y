<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$gift = getGiftByID($_GET["id"]);
?>

    <!-- Javascript -->
    <script src="assets/js_s2y/gift.js"></script>

    <!-- Post -->
    <section>
        <div class="row uniform">
            <div class="6u 12u">
                <h2>Cadeaubon <?php echo $gift->getId() ?> </h2>
            </div>
            <div class="6u 12u$">
                <h4 align="right" id="responseH"></h4>
            </div>
        </div>

        <form id="giftform" class='alt'>
            <div class="row uniform">

                <div class="2u 12u(small)">
                    <label for="giftuid">UID</label>
                    <input type="text" name="giftuid" id="giftuid" value="<?php echo $gift->getUniqid(); ?>" readonly/>
                </div>
                <div class="2u 12u(small)">
                    <label for="giftvalid">Geldig</label>
                    <input type="text" name="giftvalid" id="giftvalid" value="<?php echo $gift->getValidstring(); ?>"/>
                </div>
                <div class="6u 12u(small)">
                    <label for="giftexpires">Uiterlijke datum</label>
                    <input type="date" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
                           title="YYYY-MM-DD" name="giftexpires" id="giftexpires"
                           value="<?php echo $gift->getExpires(); ?>" placeholder="YYYY-MM-DD">
                </div>
                <div class="2u 12u$">
                    <label for="giftamount">Waarde €</label>
                    <input type="text" name="giftamount" id="giftamount" value="<?php echo $gift->getAmount(); ?>"/>
                </div>

                <ul class="actions">
                    <li><input type='button' onclick='saveGift()' name='update' value='Bewaren'/></li>
                    <li><input type='button' onclick='deleteGift()' name='delete' value='Verwijderen'/></li>
                </ul>
            </div>
        </form>
    </section>

    <!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>