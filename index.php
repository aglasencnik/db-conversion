<?php
include "header-template.php";
?>

<h1 class="display-4">DataBase Conversion</h1>
<hr>
<p class="lead">Aplikacija omogoča pretvorbo med podatkovnimi bazami različnih podatkovnih strežnikov (MS SQL, MySQL).</p>
<img src="migration.png" class="img-fluid" style="float: right; width: 50%" alt="Database migration">
<div class="row">
    <div class="bg-light p-3">
        <h4 class="mb-3">SQL <i class="bi bi-arrow-left-right"></i> MySQL</h4>
        <p style="text-align: justify;">Za pretvorbo podatkovne baze MS SQL strežnika v MySQL podatkovno bazo moramo vnesti podatke za dostop do obeh strežnikov.</p>
        <p style="text-align: justify;">Vnesti je potrebno:</p>
        <ul>
            <li>naziv strežnika,</li>
            <li>uporabniško ime,</li>
            <li>geslo ter</li>
            <li>podatkovno bazo.</li>
        </ul>
        <p style="text-align: justify;">Če podatkovna baza na ciljnem strežniku ne obstaja, se kreira nova.</p>
    </div>
</div>

<?php
include "footer-template.php";
?>