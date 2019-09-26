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


<h2>Knížky</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Název</th>
        <th>Jméno autora</th>
        <th>Přijmení autora</th>
        <th>ISBN</th>
        <th></th>


      </tr>
    </thead>
    <tbody>
      <?php
$sql = $mysqli->prepare("SELECT b.id_book, b.name, b.ISBN, a.firstname, a.surname 
FROM books b
JOIN books_authors ba ON b.id_book = ba.id_book
JOIN authors a ON ba.id_author = a.id_author");
$sql->execute();
$result = $sql->get_result();
while ($book = $result->fetch_assoc()) { ?>

      <a href="edit_book.php?idBook=<?php echo $book['id_book'];?>">



        <tr>
          <td>
            <?php echo $book['id_book'] ?>
          </td>
          <td>
            <?php echo $book['name'] ?>
          </td>
          <td>
            <?php echo $book['firstname'] ?>
          </td>
          <td>
            <?php echo $book['surname'] ?>
          </td>
          <td>
            <?php echo $book['ISBN'] ?>
          </td>
          
          <td>
            <a href="edit_book.php?idBook=<?= $book['id_book'] ?>" class="btn btn-primary">Upravit knihu</a>
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