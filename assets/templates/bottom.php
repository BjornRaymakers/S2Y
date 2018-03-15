
</div>
</div>

<!-- Sidebar -->
<div id="sidebar">
    <div class="inner">

        <!-- Menu -->
        <nav id="menu">
            <header class="major">
                <h2>Menu</h2>
            </header>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="actions.php">Acties</a></li>
                <li><a href="pricelist.php">Prijslijst</a></li>
                <li><a href="appointment.php">Afspraak</a></li>
                <li><a href="guestbook.php">Gastenboek</a></li>
                <li>
                    <span class="opener">Inspiratie nodig?</span>
                    <ul>
                        <li><a href="#">Dames</a></li>
                        <li><a href="#">Heren</a></li>
                        <li><a href="#">Kinderen</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>

        <!-- Section -->
        <section>
            <?php
            include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");
            $messages = getPublicMessages();
            $messagescount = count($messages);

            $rnd1 = rand(0,$messagescount -1);

            do {
                $rnd2 = rand(0,$messagescount -1);
            } while ($rnd2 == $rnd1);

            do {
                $rnd3 = rand(0,$messagescount -1);
            } while ($rnd3 == $rnd2 or $rnd3 == $rnd1);

            $gbart1 = $messages[$rnd1]->getName() . " schreef: <strong>" . $messages[$rnd1]->getMessage() . "</strong>";
            $gbart2 = $messages[$rnd2]->getName() . " schreef: <strong>" . $messages[$rnd2]->getMessage() . "</strong>";
            $gbart3 = $messages[$rnd3]->getName() . " schreef: <strong>" . $messages[$rnd3]->getMessage() . "</strong>";
            ?>
            <header class="major">
                <h2>Wat vinden onze klanten</h2>
            </header>
            <div class="mini-posts">
                <article>
                    <p><?php echo $gbart1?></p>
                </article>
                <article>
                    <p><?php echo $gbart2?></p>
                </article>
                <article>
                    <p><?php echo $gbart3?></p>
                </article>
            </div>
        </section>

        <!-- Section -->
        <section>
            <header class="major">
                <h2>Get in touch</h2>
            </header>
            <p>Heeft u nog vragen? Neem gerust contact met ons op!</p>
            <ul class="contact">
                <li><a href="#!"><i class='far fa-envelope-open'></i> info@scissors2you.be</a></li>
                <li><a href="#!"><i class='fas fa-phone'></i> 0471/49.82.88</a></li>
                <li><a href="../../contact.php"><i class='far fa-comment'></i> Contact formulier</a></li>
            </ul>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <p class="copyright icon fa-copyright"> R.B 2018</p>
        </footer>

    </div>
</div>

</div>

<!-- Scripts -->
<script src="../js/jquery.min.js"></script>
<script src="../js/skel.min.js"></script>
<script src="../js/util.js"></script>
<script src="../js/main.js"></script>
<script src="../js/matomo.js"></script>
<script src="../js/fontawesome-all.js"></script>
<!--[if lte IE 8]>
<script src="../js/ie/respond.min.js"></script><![endif]-->

</body>
</html>