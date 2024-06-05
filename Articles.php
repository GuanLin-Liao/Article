<?php
require_once("../topicsall.connect.php");

$sql = "SELECT articles.*,articles_category.name FROM articles
JOIN articles_category ON articles.category_id = articles_category.id WHERE valid=1";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$allArticleCount = $result->num_rows;



$sqlCategory = "SELECT articles_category.* FROM articles_category ORDER BY id ASC";
$resultCate = $conn->query($sqlCategory);
$cateRows = $resultCate->fetch_all(MYSQLI_ASSOC);

$categoryArr = [];
foreach ($cateRows as $cate) {
  $categoryArr[$cate["id"]] = $cate["name"];
}




if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sqltest = "SELECT articles.*,articles_category.name FROM articles JOIN articles_category ON articles.category_id = articles_category.id WHERE articles.title LIKE '%$search%' AND valid=1";
} else if (isset($_GET["category"]) && isset($_GET["page"]) && isset($_GET["order"])) {





  $category_id = $_GET["category"];
  $page = $_GET["page"];
  $order = $_GET["order"];
  $perPage = 10;
  $firstItem = ($page - 1) * $perPage;

  $sqlArticleNum = "SELECT articles.* FROM articles  WHERE articles.category_id = $category_id AND valid=1 ";
  $resultNum = $conn->query($sqlArticleNum);
  $rowsNum = $resultNum->fetch_all(MYSQLI_ASSOC);
  $OneArticleCount = $resultNum->num_rows;

  $onepageCount = ceil($OneArticleCount / $perPage);
  $pageCount = ceil($allArticleCount / $perPage);




  switch ($order) {
    case 1:
      $sqltest = "SELECT articles.*,articles_category.name FROM articles
      JOIN articles_category ON articles.category_id = articles_category.id WHERE articles.category_id = $category_id AND articles.valid=1 ORDER BY articles.id ASC LIMIT $firstItem, $perPage ";
      break;
    case 2:
      $sqltest = "SELECT articles.*,articles_category.name FROM articles
      JOIN articles_category ON articles.category_id = articles_category.id WHERE articles.category_id = $category_id AND  articles.valid=1 ORDER BY articles.id DESC LIMIT $firstItem, $perPage ";
      break;
  }
} else if (isset($_GET["page"]) && isset($_GET["order"])) {
  $page = $_GET["page"];
  $perPage = 10;
  $firstItem = ($page - 1) * $perPage;
  $pageCount = ceil($allArticleCount / $perPage);
  $order = $_GET["order"];

  switch ($order) {
    case 1:
      $sqltest = "SELECT articles.*,articles_category.name FROM articles
      JOIN articles_category ON articles.category_id = articles_category.id WHERE articles.valid=1 ORDER BY articles.id ASC LIMIT $firstItem, $perPage ";
      break;
    case 2:
      $sqltest = "SELECT articles.*,articles_category.name FROM articles
      JOIN articles_category ON articles.category_id = articles_category.id WHERE articles.valid=1 ORDER BY articles.id DESC LIMIT $firstItem, $perPage ";
      break;
  }
} else if (isset($_GET["delpage"])) {
  $sqltest = "SELECT articles.*,articles_category.name FROM articles JOIN articles_category ON articles.category_id = articles_category.id WHERE valid=0";
} else {
  $sqltest = "SELECT articles.*,articles_category.name FROM articles
      JOIN articles_category ON articles.category_id = articles_category.id WHERE article.valid=1";
  header("location:Articles.php?page=1&order=1");
}

$resultChange = $conn->query($sqltest);
$rowsChange = $resultChange->fetch_all(MYSQLI_ASSOC);














// if (isset($_GET["category"])){

// }


?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <?php include("../css.php"); ?>
  <style>
    :root {
      --aside-witch: 200px;
      --header-height: 50px;
    }

    .logo {
      width: var(--aside-witch);
    }

    .aside-left {
      padding-top: var(--header-height);
      width: var(--aside-witch);
      top: 20px;
      overflow: auto;
    }

    .main-content {
      margin: var(--header-height) 0 0 var(--aside-witch);
    }

    .testt {
      white-space: nowrap;
      overflow-x: auto;
      width: 100%;
    }

    .table {

      white-space: nowrap;
      overflow-x: auto;

    }

    input[type="text"] {
      border: 1px solid #ccc;
      /* border */
    }

    input[type="text"]:focus {
      outline: none;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .testTT {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
</head>

<body>
  <header class="main-header bg-dark d-flex fixed-top shadow justify-content-between align-items-center">
    <a href="" class="p-3 bg-black text-white text-decoration-none">
      tea
    </a>

    <div class="text-white me-3">
      Hi,adain
      <a href="" class="btn btn-dark">登入</a>
      <a href="" class="btn btn-dark">登出</a>
    </div>
  </header>
  <aside class="aside-left position-fixed bg-white border-end vh-100 ">
    <ul class="list-unstyled">
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-house-fill me-2"></i>首頁
        </a>
      </li>
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-cart4 me-2"></i></i>商品
        </a>
      </li>
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-cash me-2"></i>優惠券
        </a>
      </li>
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-flag me-2"></i>課程
        </a>
      </li>
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-clipboard2-data me-2"></i> 訂單
        </a>
      </li>
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-book me-2"></i> 文章管理
        </a>
      </li>
      <li>
        <a class="d-block p-2 px-3 text-decoration-none" href="">
          <i class="bi bi-paypal me-2"></i> 付款方式
        </a>
      </li>

    </ul>
  </aside>
  <main class="main-content p-3">
    <div class="d-flex justify-content-between">
      <h1>文章管理</h1>

      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </div>
    </div>
    <ul class="nav nav-underline mb-3">
      <li class="nav-item ">
        <a class="nav-link <?php if (!isset($_GET["category"]) && !isset($_GET["search"]) &&!isset($_GET["delpage"])) echo "active"; ?>" href="Articles.php">全部</a>
      </li>

      <?php foreach ($cateRows as $category) : ?>
        <li class="nav-item">
          <a class="nav-link <?php if (isset($_GET["category"]) && $category_id == $category["id"]) echo "active"; ?>" href="Articles.php?page=1&order=1&category=<?= $category["id"] ?>"><?= $category["name"] ?>
          </a>

        </li>
      <?php endforeach; ?>
      <li class="nav-item ">
        <a class="nav-link <?php if(isset($_GET["delpage"])) echo "active" ?> "   href="Articles.php?delpage">下架文章</a>
      </li>
    </ul>
    <div class="d-flex justify-content-between">

      <div class="d-flex gap-3">
        <form action="">

          <div class="input-group">
            <?php if (isset($_GET["search"])) : ?>

              <a class="btn btn-primary" href="Articles.php">
                <i class="fa-solid fa-rotate-left"></i>
              </a>

            <?php endif; ?>
            <input type="text" class="search" name="search">
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>

      </div>

      <div>

        <?php if (isset($_GET["page"]) && isset($_GET["order"]) && !isset($_GET["category"])) : ?>
          <div class="btn-group">

            <a href="?page=<?= $page ?>&order=1" class="btn btn-primary">id <i class="fa-solid fa-arrow-down-short-wide"></i></a>
            <a href="?page=<?= $page ?>&order=2" class="btn btn-primary">id<i class="fa-solid fa-arrow-down-wide-short"></i></a>
          <?php elseif (isset($_GET["page"]) && isset($_GET["order"]) && isset($_GET["category"])) : ?>
            <div class="btn-group">

              <a href="?page=<?= $page ?>&order=1&category=<?= $category_id ?>" class="btn btn-primary">id <i class="fa-solid fa-arrow-down-short-wide"></i></a>
              <a href="?page=<?= $page ?>&order=2&category=<?= $category_id ?>" class="btn btn-primary">id<i class="fa-solid fa-arrow-down-wide-short"></i></a>
            <?php endif; ?>
            </div>
            <a class=" mt-2" href="addArticleUI.php"><button class="btn btn-primary">新增文章</button></a>
          </div>



      </div>
      <hr>
      <!---------------------------------------------這裡是內容 ------------------------------------->
      <?php if ($result->num_rows > 0) : ?>
        <div class="testt mb-2">
          <table class="table">
            <thead>
              <tr>

                <th>文章編號</th>
                <th>文章標題</th>
                <th>文章種類</th>
                <th>建立時間</th>
                <th>修改時間</th>
                <th></th>
                <th class=""></th>

              </tr>
              <tr class="">

                <?php if (isset($_GET["search"]) || isset($_GET["page"])) : ?>
                  <?php foreach ($rowsChange as $row) : ?>

                    <div class="modal fade" id="deleteModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">再次確認</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            確認刪除文章?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="deleteArticle.php?id=<?= $row["id"] ?>" type="button" class="btn btn-primary">確認</a>
                          </div>
                        </div>
                      </div>
                    </div>

              <tr class="">

                <th><?= $row["id"] ?></th>
                <th class="testTT"><?= $row["title"] ?></th>
                <th><?= $row["name"] ?></th>
                <th><?= $row["created_at"] ?></th>
                <th><?= $row["updated_at"] ?></th>

                <th class="text-center">
                  <span class="d-inline-block"><a class="d-inline-block me-1" href="lookArticles.php?id=<?php echo $row["id"] ?>"><button class="btn btn-primary"><i class="bi bi-eye-fill"></i></button></a>
                    <a class="d-inline-block me-1" href="editArticle.php?id=<?= $row["id"] ?>"><button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row["id"] ?>"><i class="bi bi-trash3-fill"></i></button></span>
                </th>



              </tr>
            <?php endforeach; ?>
          <?php elseif (isset($_GET["delpage"])) : ?>
            <?php foreach ($rowsChange as $row) : ?>

              <div class="modal fade" id="addModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">再次確認</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      要重新上架此文章?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="backArticle.php?id=<?= $row["id"] ?>" type="button" class="btn btn-primary">確認</a>
                    </div>
                  </div>
                </div>
              </div>

              <tr class="">

                <th><?= $row["id"] ?></th>
                <th class="testTT"><?= $row["title"] ?></th>
                <th><?= $row["name"] ?></th>
                <th><?= $row["created_at"] ?></th>
                <th><?= $row["updated_at"] ?></th>

                <th class="text-center">
                  <span class="d-inline-block"><a class="d-inline-block me-1" href="lookArticles.php?id=<?php echo $row["id"] ?>"><button class="btn btn-primary"><i class="bi bi-eye-fill"></i></button></a>
                    <a class="d-inline-block me-1" href="editArticle.php?id=<?= $row["id"] ?>"><button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal<?= $row["id"] ?>"><i class="fa-solid fa-rotate-left"></i></button></span>
                </th>



              </tr>
            <?php endforeach; ?>
          <?php elseif (isset($_GET["delpage"])) : ?>
            <?php foreach ($rowsChange as $row) : ?>

              <div class="modal fade" id="deleteModal<?= $row["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">再次確認</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      確認刪除文章?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="deleteArticle.php?id=<?= $row["id"] ?>" type="button" class="btn btn-primary">確認</a>
                    </div>
                  </div>
                </div>
              </div>

              <tr class="">

                <th><?= $row["id"] ?></th>
                <th class="testTT"><?= $row["title"] ?></th>
                <th><?= $row["name"] ?></th>
                <th><?= $row["created_at"] ?></th>
                <th><?= $row["updated_at"] ?></th>

                <th class="text-center">
                  <span class="d-inline-block"><a class="d-inline-block me-1" href="lookArticles.php?id=<?php echo $row["id"] ?>"><button class="btn btn-primary"><i class="bi bi-eye-fill"></i></button></a>
                    <a class="d-inline-block me-1" href="editArticle.php?id=<?= $row["id"] ?>"><button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row["id"] ?>"><i class="bi bi-trash3-fill"></i></button></span>
                </th>



              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
            </thead>
          </table>

        </div>
        <?php if (isset($_GET["page"]) && isset($_GET["order"]) && !isset($_GET["category"])) : ?>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                <li class="page-item <?php if ($i == $page) echo "active" ?>">
                  <a class="page-link" href="?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>
            </ul>
          </nav>

        <?php elseif (isset($_GET["page"]) && isset($_GET["order"]) && isset($_GET["category"])) : ?>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= $onepageCount; $i++) : ?>

                <li class="page-item <?php if ($i == $page) echo "active" ?>">
                  <a class="page-link" href="?page=<?= $i ?>&order=<?= $order ?>&category=<?= $category_id ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>
            </ul>
          </nav>


        <?php else : ?>

        <?php endif; ?>

      <?php endif; ?>















  </main>
  <?php include("../js.php") ?>
</body>

</html>