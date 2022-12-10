<?php
require "db.php";

if (isset($_GET['id'])) {
  
  $sql = "SELECT * FROM books WHERE book_id = :book_id";

  $stmt = $db->prepare($sql);

  $stmt->execute([
    ':book_id' => $_GET['id']
  ]);

  $book = $stmt->fetch();

  if (!$book) {
    header('Location: index.php');
  }

  $sql = "SELECT category_name FROM categories WHERE category_id = (SELECT category_id FROM books WHERE book_id = :book_id)";

  $stmt = $db->prepare($sql);

  $stmt->execute([
    ':book_id' => $_GET['id']
  ]);

  $category = $stmt->fetch();

  $sql = "SELECT quote FROM quotes WHERE book_id = :book_id";

  $stmt = $db->prepare($sql);

  $stmt->execute([
    ':book_id' => $_GET['id']
  ]);

  $quotes = $stmt->fetchAll();

} else {
  header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $book['book_title'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body class="text-danger bg-warning" >

  <main class="main">
    <?php include "header.php"; ?>

    <section class="book-details p-5 m-5 border border-3 rounded bg-dark text-light">

      <section class="text-end ">
        <a class="book-edit text-end mb-5 fs-5 text-decoration-none text-danger border border-1 p-2 rounded bg-warning" href="edit.php?id=<?php echo $book['book_id']; ?>"><strong>Edit Book</strong></a>
      </section>

      <div class="row mt-5 text-center">
        <h2 class="book-title display-4 fw-bolder"><?php echo $book['book_title'] ?></h2>
      </div>

      <div class="row mt-5 justify-content-center ">

        <div class="col-4">
          <?php if ($book['book_image']) : ?>
            <img class="rounded float-start" style="width: 20vw;" src="book-covers/<?php echo $book['book_image']; ?>">
          <?php endif; ?>
        </div>

        <div class="col-6">
          <h1>About this Book:</h1>
          <h4 class="book-description"><?php echo $book['book_description'] ?></h4>

          <div class="mt-3">
            <div class="row mt-5 fs-4">
              <div class="col">
                <span class="book-year">Published: <?php echo $book['book_year'] ?></span>
              </div>
              <div class="col text-end">
                <span class="book-pages">Pages: <?php echo $book['book_pages'] ?></span>
              </div>
            </div>
          </div>


          <?php if ($category) : ?>
            <h4 class="category-name text-start mt-5 mb-5">Category: <?php echo $category['category_name'] ?></h4>
            <?php else : ?>
              <h3 class="my-5">There is no category provided for this book.</h3>
          <?php endif; ?>

          <?php if ($quotes) : ?>
          <h1 class="mb-3">Quotes:</h1>
          <ul class="list-group">
            <?php foreach ($quotes as $quote) : ?>
              <li class="list-group-item text-danger bg-warning">
                <blockquote class="blockquote">
                  <p class="quote-id">"<strong><?php echo $quote['quote'] ?>"</strong></p>
                </blockquote>
              </li>
            <?php endforeach ?>
          </ul>
          <?php else : ?>
            <h3 class="my-5">There are no quotes provided for this book.</h3>
          <?php endif ; ?>

        </div>

      </div>

    </section>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>