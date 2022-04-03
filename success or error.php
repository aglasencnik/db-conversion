<?php
if (isset($_SESSION['source_submit'])) {
    try {
        if ($source_db_type == "mysql") {
            $source_conn_mysql = mysqli_connect($source_db_server, $source_db_user, $source_db_pass);
            if ($source_conn_mysql) {
                ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je uspela!
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je spodletela!
                    </div>
                </div>
                <?php
            }
            mysqli_close($source_conn_mysql);
            ?>
            <?php
        } elseif ($source_db_type == "sql") {
            $source_conn_sql_info = array("UID" => "$source_db_user", "PWD" => "$source_db_pass");
            $source_conn_sql = sqlsrv_connect($source_db_server, $source_conn_sql_info);
            if ($source_conn_sql) {
                ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je uspela!
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je spodletela!
                    </div>
                </div>
                <?php
            }
            sqlsrv_close($source_conn_sql);
        }
    } catch (Exception $e) {
        ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill"/>
            </svg>
            <div>
                Povezava s podatkovno bazo je spodletela!
            </div>
        </div>
        <?php
    }
}
?>




<?php
if (isset($_SESSION['target_submit'])) {
    try {
        if ($target_db_type == "mysql") {
            $target_conn_mysql = mysqli_connect($target_db_server, $target_db_user, $target_db_pass);
            if ($target_conn_mysql) {
                ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je uspela!
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je spodletela!
                    </div>
                </div>
                <?php
            }
            mysqli_close($target_conn_mysql);
            ?>
            <?php
        } elseif ($target_db_type == "sql") {
            $target_conn_sql_info = array("UID" => "$target_db_user", "PWD" => "$target_db_pass");
            $target_conn_sql = sqlsrv_connect($target_db_server, $target_conn_sql_info);
            if ($target_conn_sql) {
                ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je uspela!
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <div>
                        Povezava s podatkovno bazo je spodletela!
                    </div>
                </div>
                <?php
            }
            sqlsrv_close($target_conn_sql);
        }
    } catch (Exception $e){
        ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill"/>
            </svg>
            <div>
                Povezava s podatkovno bazo je spodletela!
            </div>
        </div>
        <?php
    }
}
?>
