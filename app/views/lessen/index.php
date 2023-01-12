<?php require(APPROOT . '/views/includes/header.php'); ?>
<h2><?= $data['title']; ?></h2>

<h4>Auto van instructeur: Manhoi</h4>
<h4><?= 'E-mailadres: ' .  $data['Email'] ?></h4>
<h4><?= 'Kenteken Auto: ' .  $data['Kenteken'] ?></h4>

<table border='1'>
  <thead>
    <th>Datum</th>
    <th>Mankement</th>
  </thead>

  <tbody>

    <?= $data['rows'] ?>
  </tbody>
</table>

<br>
<a href="<?= URLROOT; ?>/mankement/create/<?= $data['AutoId']; ?>">
  <input type="button" value="Mankement Toevoegen">
</a>

<?php require(APPROOT . '/views/includes/footer.php'); ?>