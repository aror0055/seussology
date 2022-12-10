<?php
require_once "db.php";

if (isset($_POST['book_id'])) {
  $sql = "UPDATE books SET 
                            book_title = :book_title,
                            book_title_sort = :book_title_sort,
                            book_year = :book_year,
                            book_pages = :book_pages,
                            book_description = :book_description
                            
                            WHERE book_id = :book_id";

  $stmt = $db->prepare($sql);
  $stmt->execute([
                            ":book_title" => $_POST['book_title'],
                            ":book_title_sort" => $_POST['book_title_sort'],
                            ":book_year" => $_POST['book_year'],
                            ":book_pages" => $_POST['book_pages'],
                            ":book_description" => $_POST['book_description'],
                            ":book_id" => $_POST['book_id']
  ]);

  //echo($stmt);


  // if ($stmt->rowCount()) {
  //   header("Location: book.php?id={$_POST['book_id']}");
  // }
} 


if (isset($_GET['id'])) {
  // prepared statement
  $sql = "SELECT * FROM books WHERE book_id = :book_id";

  // send the prepared statement
  $stmt = $db->prepare($sql);

  // Bind value
  $stmt->execute([
    ':book_id' => $_GET['id']
  ]);

  $book = $stmt->fetch();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body class="text-danger bg-warning">
  <main class="main">
    <?php include "header.php"; ?>
  
    <h2 class="form-title text-center text-bolder fs-1">Edit book</h2>
    <section class="p-5 m-5 border border-2 rounded">
    <form class="form" method="post">
      <div class="mb-3">
      <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="book_title" placeholder="Book Title" required value="<?php echo $book['book_title']; ?>">
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="book_title_sort" placeholder="Book Title Sort" required value="<?php echo $book['book_title_sort']; ?>">
      </div>
      <div class="mb-3">
        <input type="number" class="form-control" name="book_year" placeholder="Year" required value="<?php echo $book['book_year']; ?>">
      </div>
      <div class="mb-3">
        <input type="number" class="form-control" name="book_pages" placeholder="Pages" required value="<?php echo $book['book_pages']; ?>">
      </div>
      <div class="mb-3">
        <textarea type="textarea" class="form-control" name="book_description" placeholder="Please add the book description." rows="4" required ><?php echo $book['book_description']; ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update book</button>
    </form>
    </section>

    <form class="form px-5 mb-5 d-flex flex-row-reverse" method="POST" action="delete.php">
      <input hidden name="book_id" value="<?php echo $book['book_id']; ?>">
      <button type="submit" class="btn btn-danger">Delete book</button>
    </form>
  </main>
</body>

</html>