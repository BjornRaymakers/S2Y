<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

?>
    <!-- Javascript -->
    <script src="assets/js_s2y/actions.js"></script>

    <!-- Post -->
    <section>
        <div class="row uniform">

            <div class="12u$">
                <h2>Actie beheer</h2>
            </div>

            <div class="12u$">
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th width='2%'></th>
                            <th>Title</th>
                            <th width='30%'>Duurtijd</th>
                            <th width='10%'>Actief</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $actions = getActions();

                        foreach ($actions as &$action) {
                            echo "<tr><td><a href='action?id=" . $action->getId() . "' class='icon alt fa-edit'</a></td><td>" . $action->getTitle() . "</td><td>" . $action->getDuration() . "</td><td>" . $action->getValid() . "</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="12u$">
                <ul class="actions">
                    <li><a href="action" class="button icon alt fa-plus">Nieuwe actie aanmaken</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>