<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/Menu.css"/>
    <meta charset='utf-8'>
  <title>CLIENT DASHBOARD</title>
</head>
<body>
<?php include "Include/Menu.php"; ?>

<header>
  <form>
    <h2>Client info</h2>
    <label for="lname">Nom:</label><br>
    <input type="text" id="fname" name="fname"><br>
    <label for="fname">Prénom:</label><br>
    <input type="text" id="lname" name="lname">
  </form>
</header>


<section>

    <h2>Consommation par mois</h2>
    <form>
      <label><em></em>Mois:</label>
      <select >
        <option value="Janvier">Janvier</option>
        <option value="Février">Février</option>
        <option value="Mars">Mars</option>
        <option value="Avril">Avril</option>
        <option value="Mai">Mai</option>
        <option value="Juin">Juin</option>
        <option value="Juillet">Juillet</option>
        <option value="Aout">Aout</option>
        <option value="Septembre">Septembre</option>
        <option value="Octobre">Octobre</option>
        <option value="Novembre">Novembre</option>
        <option value="Décembre">Décembre</option>

      </select>
      <br><br>
      <label>Consommation:</label>
      <input> <br>

    </form>

</section>

<aside>

    <h2>Factures non payées</h2>
    <form>
      <label><em>Année:</em></label>

      <select name="cars" id="cars">
        <option >2021</option>
        <option >2020</option>
        <option >2019</option>
        <option >2018</option>
        <option >2017</option>
        <option >2016</option>
        <option >2015</option>
      </select>
      <br><br>

    </form>

    <label>Consommation:</label>
    <input> <br><br>

    <input type="submit" value="Payer">

</aside>

<footer>
  <center><input type="submit" value="Logout"></center>
</footer>
</body>
</html>
