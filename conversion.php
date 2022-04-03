<?php
session_start();
if (isset($_POST)) { //check to see if a form has been submitted
    // merge the $_SESSION & $_POST arrays,
    // this will overwrite session variables with new post variables but keep old post variables that haven't been submitted
    $_SESSION = array_merge($_SESSION, $_POST);
}

if (isset($_POST['zbrisi_podatke'])) {
    session_destroy();
    header("Location: conversion.php");
}

include "header-template.php";
$source_db_type = "";
$source_db_server = "";
$source_db_user = "";
$source_db_pass = "";
$target_db_type = "";
$target_db_server = "";
$target_db_user = "";
$target_db_pass = "";
$potrdi = false;
$source_db_name = "";
$target_db_name = "";
$is_conversion_complete = false;

if (isset($_SESSION['source_db_submit'])) {
    $source_db_name = $_SESSION['source_db_name'];
}

if (isset($_SESSION['target_db_submit'])) {
    $target_db_name_1 = $_SESSION['target_db_name'];
    $target_db_name_2 = $_SESSION['target_db_name_new'];

    if (!empty($target_db_name_1)) {
        $target_db_name = $target_db_name_1;
    } else {
        $target_db_name = $target_db_name_2;
    }
}

if (isset($_SESSION['source_submit'])) {
    $source_db_type = $_SESSION['source_db_type'];
    $source_db_server = $_SESSION['source_db_server'];
    $source_db_user = $_SESSION['source_db_user'];
    $source_db_pass = $_SESSION['source_db_pass'];
}

if (isset($_SESSION['target_submit'])) {
    $target_db_type = $_SESSION['target_db_type'];
    $target_db_server = $_SESSION['target_db_server'];
    $target_db_user = $_SESSION['target_db_user'];
    $target_db_pass = $_SESSION['target_db_pass'];
}

if (isset($_SESSION['potrdi']) && !empty($source_db_name) && !empty($target_db_name)) {
    $potrdi = true;
}
?>

    <h1 class="display-4">Pretvorba PB</h1>
    <hr>
    <div class="row justify-content-center">

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>

<?php
if ($potrdi == false) {
    ?>

    <div class="card mx-4 col-5">
        <div class="card-header bg-secondary text-white mx-0 px-0">
            <h4 class="text-center mx-0 px-0">Izvorna podatkovna baza &nbsp;<i
                        class="bi bi-box-arrow-up-right"></i>
            </h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['source_submit'])) {
                try {
                    if ($source_db_type == "mysql") {
                        $source_conn_mysql = mysqli_connect($source_db_server, $source_db_user, $source_db_pass);
                        if ($source_conn_mysql) {
                            ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Success:">
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
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Danger:">
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
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Success:">
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
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Danger:">
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
            <div class="text-muted col-md-6 m-0 p-0 mb-2"><small><kbd class="bg-light text-dark">Vrsta
                        strežnika</kbd></small></div>
            <div class="mb-0">
                <form method="post" action="conversion.php">
                    <label>Izberite vrsto strežnika:</label>
                    <select name="source_db_type" class="form-select col-md-6" required>
                        <option></option>
                        <option value="sql" <?php if ($source_db_type == "sql") echo "selected"; ?>>MS SQL strežnik
                        </option>
                        <option value="mysql" <?php if ($source_db_type == "mysql") echo "selected"; ?>>MySQL strežnik
                        </option>
                    </select>
                    <hr>
                    <div class="text-muted col-md-6 m-0 p-0 mb-2"><small><kbd class="bg-light text-dark">Prijavni
                                podatki strežnika</kbd></small></div>
                    <label class="my-2">Naziv strežnika:</label>
                    <input type="text" name="source_db_server" class="form-control col-md-6" required
                           value="<?php echo $source_db_server; ?>">
                    <label class="my-2">Uporabniško ime:</label>
                    <input type="text" name="source_db_user" class="form-control col-md-6" required
                           value="<?php echo $source_db_user; ?>">
                    <label class="my-2">Geslo:</label>
                    <input type="password" name="source_db_pass" class="form-control col-md-6"
                           value="<?php echo $source_db_pass; ?>">
                    <input type="submit" class="btn btn-dark my-4" value="Poveži" name="source_submit">
                </form>
                <hr>
                <div class="text-muted col-md-6 m-0 p-0 mb-2"><small><kbd class="bg-light text-dark">Podatkovna
                            baza</kbd></small></div>
                <div class="mb-0">
                    <form action="conversion.php" method="post">
                        <label>Izberite podatkovno bazo:</label>
                        <select name="source_db_name" class="form-select col-4" required>
                            <option value="<?php echo $source_db_name ?>"><?php echo $source_db_name ?></option>
                            <?php
                            if (isset($_SESSION['source_submit'])) {
                                if ($source_db_type == "mysql") {
                                    $conn = mysqli_connect($source_db_server, $source_db_user, $source_db_pass);
                                    $sql = "SHOW DATABASES";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value='" . $row['Database'] . "'>" . $row['Database'] . "</option>";
                                    }
                                    mysqli_close($conn);
                                } elseif ($source_db_type == "sql") {
                                    $info = array("UID" => "$source_db_user", "PWD" => "$source_db_pass");
                                    $conn = sqlsrv_connect($source_db_server, $info);
                                    $sql = "select name from sys.Databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb');";
                                    $result = sqlsrv_query($conn, $sql);
                                    while ($row = sqlsrv_fetch_array($result)) {
                                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" class="btn btn-dark my-4" value="Shrani" name="source_db_submit">
                    </form>
                    <?php
                    if (!empty($source_db_name)) {
                        ?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                 aria-label="Success:">
                                <use xlink:href="#check-circle-fill"/>
                            </svg>
                            <div>
                                Podatkovna baza uspešno izbrana!
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-5 mx-4">
        <div class="card-header bg-secondary text-white mx-0 px-0">
            <h4 class="text-center mx-0 px-0">Ciljna podatkovna baza &nbsp;<i
                        class="bi bi-box-arrow-in-down-left"></i>
            </h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['target_submit'])) {
                try {
                    if ($target_db_type == "mysql") {
                        $target_conn_mysql = mysqli_connect($target_db_server, $target_db_user, $target_db_pass);
                        if ($target_conn_mysql) {
                            ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Success:">
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
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Danger:">
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
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Success:">
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
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Danger:">
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
            <div class="text-muted col-md-6 m-0 p-0 mb-2"><small><kbd class="bg-light text-dark">Vrsta
                        strežnika</kbd></small></div>
            <div class="mb-0">
                <form method="post" action="conversion.php">
                    <label>Izberite vrsto strežnika:</label>
                    <select name="target_db_type" class="form-select col-md-6" required>
                        <option></option>
                        <option value="sql" <?php if ($target_db_type == "sql") echo "selected"; ?>>MS SQL
                            strežnik
                        </option>
                        <option value="mysql" <?php if ($target_db_type == "mysql") echo "selected"; ?>>MySQL
                            strežnik
                        </option>
                    </select>
                    <hr>
                    <div class="text-muted col-md-6 m-0 p-0 mb-2"><small><kbd class="bg-light text-dark">Prijavni
                                podatki strežnika</kbd></small></div>
                    <label class="my-2">Naziv strežnika:</label>
                    <input type="text" name="target_db_server" class="form-control col-md-6" required
                           value="<?php echo $target_db_server; ?>">
                    <label class="my-2">Uporabniško ime:</label>
                    <input type="text" name="target_db_user" class="form-control col-md-6" required
                           value="<?php echo $target_db_user; ?>">
                    <label class="my-2">Geslo:</label>
                    <input type="password" name="target_db_pass" class="form-control col-md-6"
                           value="<?php echo $target_db_pass; ?>">
                    <input type="submit" class="btn btn-dark my-4" value="Poveži" name="target_submit">
                </form>
                <hr>
                <div class="text-muted col-md-6 m-0 p-0 mb-2"><small><kbd class="bg-light text-dark">Podatkovna
                            baza</kbd></small></div>
                <div class="mb-0">
                    <form action="conversion.php" method="post">
                        <label>Izberite podatkovno bazo:</label>
                        <select name="target_db_name" class="form-select col-4">
                            <option></option>
                            <?php
                            if (isset($_SESSION['target_submit'])) {
                                if ($target_db_type == "mysql") {
                                    $conn = mysqli_connect($target_db_server, $target_db_user, $target_db_pass);
                                    $sql = "SHOW DATABASES";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value='" . $row['Database'] . "'>" . $row['Database'] . "</option>";
                                    }
                                    mysqli_close($conn);
                                } elseif ($target_db_type == "sql") {
                                    $info = array("UID" => "$target_db_user", "PWD" => "$target_db_pass");
                                    $conn = sqlsrv_connect($target_db_server, $info);
                                    $sql = "select name from sys.Databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb');";
                                    $result = sqlsrv_query($conn, $sql);
                                    while ($row = sqlsrv_fetch_array($result)) {
                                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                        <label class="my-1">ali ustvarite novo PB:</label>
                        <input type="text" name="target_db_name_new" class="form-control col-md-6"
                               value="<?php echo $target_db_name ?>">
                        <input type="submit" class="btn btn-dark my-4" value="Shrani" name="target_db_submit">
                    </form>
                    <?php
                    if (!empty($target_db_name)) {
                        ?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                 aria-label="Success:">
                                <use xlink:href="#check-circle-fill"/>
                            </svg>
                            <div>
                                Podatkovna baza uspešno izbrana!
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <form action="conversion.php" method="post">
        <input value="Potrdi" type="submit" class="btn btn-dark btn-lg my-3" name="potrdi">
    </form>
    <form action="conversion.php" method="post">
        <input value="Zbriši podatke" type="submit" class="btn btn-danger btn-lg my-3" name="zbrisi_podatke">
    </form>
    <?php
} else {
    ?>
    <?php
    if (isset($_POST['nazaj'])) {
        unset($_SESSION['potrdi']);
        header("Location: conversion.php");
    }
    ?>
    <div class="card mx-4 col-5 border-0">
        <div class="card-header bg-secondary text-white mx-0 px-0">
            <h4 class="text-center mx-0 px-0">Izvorna podatkovna baza &nbsp;<i
                        class="bi bi-box-arrow-up-right"></i>
            </h4>
        </div>
        <div class="card-body">
            <h4 class="my-3">Vrsta strežnika: <strong
                        class="text-primary"><?php echo($source_db_type == "mysql" ? "MySQL strežnik" : "MS SQL strežnik"); ?></strong>
            </h4>
            <hr>
            <h4 class="my-3">Naziv Strežnika: <strong class="text-primary"><?php echo $source_db_server; ?></strong>
            </h4>
            <hr>
            <h4 class="my-3">Uporabniško ime: <strong class="text-primary"><?php echo $source_db_user; ?></strong></h4>
            <hr>
            <h4 class="my-3">Geslo: <strong class="text-primary">**********</strong></h4>
            <hr>
            <h4 class="my-3">Podatkovna baza: <strong class="text-primary"><?php echo $source_db_name; ?></strong></h4>
            <hr>
            <form action="conversion.php" method="post">
                <input value="Pretvori" type="submit" class="btn btn-dark btn-lg my-4" name="pretvori">
                <input value="Nazaj" type="submit" class="btn btn-dark btn-lg mx-1" name="nazaj">
            </form>
            <?php
            if (isset($_POST['pretvori'])) {
                try {
                    $converter = new Converter($source_db_type, $source_db_server, $source_db_user, $source_db_pass, $source_db_name, $target_db_type, $target_db_server, $target_db_user, $target_db_pass, $target_db_name);
                    $converter->convert();
                    ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                             aria-label="Success:">
                            <use xlink:href="#check-circle-fill"/>
                        </svg>
                        <h4>
                            Pretvorba je bila uspešna!
                        </h4>
                    </div>
                    <?php
                } catch (Exception $e) {
                    ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill"/>
                        </svg>
                        <h4>
                            Pretvorba je spodletela!
                        </h4>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div class="card col-5 mx-4 border-0">
        <div class="card-header bg-secondary text-white mx-0 px-0">
            <h4 class="text-center mx-0 px-0">Ciljna podatkovna baza &nbsp;<i
                        class="bi bi-box-arrow-in-down-left"></i>
            </h4>
        </div>
        <div class="card-body">
            <h4 class="my-3">Vrsta strežnika: <strong
                        class="text-primary"><?php echo($target_db_type == "mysql" ? "MySQL strežnik" : "MS SQL strežnik"); ?></strong>
            </h4>
            <hr>
            <h4 class="my-3">Naziv Strežnika: <strong class="text-primary"><?php echo $target_db_server; ?></strong>
            </h4>
            <hr>
            <h4 class="my-3">Uporabniško ime: <strong class="text-primary"><?php echo $target_db_user; ?></strong></h4>
            <hr>
            <h4 class="my-3">Geslo: <strong class="text-primary">**********</strong></h4>
            <hr>
            <h4 class="my-3">Podatkovna baza: <strong class="text-primary"><?php echo $target_db_name; ?></strong></h4>
            <hr>
        </div>
    </div>

    <?php
}
?>

<?php
include "footer-template.php";
?>