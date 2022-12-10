<?php
require "db.php";

if (isset($_GET['search'])) {
  $sql = "SELECT * FROM books WHERE book_title LIKE :search OR book_description LIKE :search";

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':search', "%{$_GET['search']}%");
  $stmt->execute();

  $books = $stmt->fetchAll();

} else {

  $sql = "SELECT * FROM books;";
  $result = $db->query($sql);

  $books = $result->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books - aror0055</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body class="text-danger bg-warning">
  <main class="main" >
    <?php include "header.php"; ?>
    <form class="form m-5 d-flex justify-content-center">
      <input type="search" class="form-control p-3 border border-dark border-4" style="width: 50%;" name="search" placeholder="Search book titles...">
    </form>
    
    <section class="books m-5">
      <div class="row">
        <?php foreach ($books as $book) : ?>
          <div class="col col-sm-2" style="margin-bottom: 5vw;">
            <a class="card shadow-sm text-decoration-none fs-4 fw-bolder" href="book.php?id=<?php echo $book['book_id']; ?>" style="height: 100%; background-color: #E64F00;">
              <?php if ($book['book_image']) : ?>
                <img src="book-covers/<?php echo $book['book_image']; ?>">
              <?php endif; ?>
              <div class="card-body text-center">
                <div class="book-title text-light"><?php echo $book['book_title']; ?></div>
              </div>
            </a>
          </div>
        <?php endforeach ?>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>