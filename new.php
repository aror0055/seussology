<?php
require_once "db.php";

if (isset($_POST['book_title'])) {
  $sql = "INSERT INTO books (book_title, book_title_sort,  book_year, book_pages, book_description) VALUES (:book_title, :book_title_sort, :book_year, :book_pages, :book_description)";
  $stmt = $db->prepare($sql);
  $stmt->execute([
    ":book_title" => $_POST['book_title'],
    ":book_title_sort" => $_POST['book_title_sort'],
    ":book_year" => $_POST['book_year'],
    ":book_pages" => $_POST['book_pages'],
    ":book_description" => $_POST['book_description']
  ]);

  if ($stmt->rowCount()) {
    header("Location: book.php?id={$db->lastInsertId()}");
  } else {
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body class="text-danger bg-warning">
  <main class="main">
    <?php include "header.php"; ?>
    <section class="m-5">
    <h2 class="form-title mb-5">New Book</h2>
    <form class="form border border-2 rounded p-5" method="post">
      <div class="mb-3">
        <input type="text" class="form-control" name="book_title" placeholder="Book Title" required>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="book_title_sort" placeholder="Sort Title" required>
      </div>
      <div class="mb-3">
        <input type="number" class="form-control" name="book_year" placeholder="Year" required>
      </div>
      <div class="mb-3">
        <input type="number" class="form-control" name="book_pages" placeholder="Pages" required>
      </div>
      <div class="mb-3">
        <textarea type="textarea" class="form-control" name="book_description" placeholder="Please add the book description." rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <button type="submit" class="button btn btn-success">Add book</button>
      </div>
    </form>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>