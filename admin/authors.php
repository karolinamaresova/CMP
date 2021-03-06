<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "header.php";
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
      <span data-feather="calendar"></span>
     
    </button>
  </div>
</div>


<h2>Autoři</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Jméno autora</th>
        <th>Přijmení autora</th>
        
        <th></th>


      </tr>
    </thead>
    <tbody>
      <?php
$sql = $mysqli->prepare("SELECT id_author, firstname, surname
FROM authors 
"
);
$sql->execute();
$result = $sql->get_result();
while ($author = $result->fetch_assoc()) { ?>

  <a href="edit_author.php?idAuthor=<?php echo $author['id_author'];?>">   



        <tr>
          <td>
            <?php echo $author['id_author'] ?>
          </td>
         
          <td>
            <?php echo $author['firstname'] ?>
          </td>
          <td>
            <?php echo $author['surname'] ?>
          </td>
          
          <td>
            <a href="edit_author.php?idAuthor=<?= $author['id_author'] ?>" class="btn btn-primary">Upravit autora</a>
          </td>
        </tr>



        <?php
  
     

}
?>

    </tbody>
  </table>
</div>

<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "footer.php";
?>