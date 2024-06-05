<?php 
 require_once("../topicsall.connect.php");

 $id = $_GET["id"];
 


 $sql = "SELECT articles.*,articles_category.name FROM articles JOIN articles_category ON articles.category_id = articles_category.id WHERE articles.id = $id ";

 $result = $conn->query($sql);
 
 $rows = $result->fetch_assoc();



//  var_dump($rows);
// var_dump($rows["article_images"]);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <?php include("../css.php")?>
        <style>
            .imgSize{
                max-width: 800px;
                object-fit: cover;
                background-size: cover;
            }
            .content{
               margin: 0 auto;
                max-width: 800px;
            }
        </style>
    </head>

    <body>
        <a href="dashboard.php"><button class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>返回</button></a>
        
      <table class="table table-bordered container">
        <thead>
            <tr>
                <th class="text-center "><h1 class="fw-bold">
                <?php echo $rows["title"];?>
                </h1></th>
            </tr>
            <tbody>
            <tr>
                    <td class="text-center">
                        <!-- <img src="../images/tea.png" alt=""> -->
                        <img class="imgSize" src="../images/Articles_image/<?= $rows["article_images"]?>" alt="<?= $rows["name"]?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <div class="content">
                        <?= $rows["content"];?>
                        </div>
                    </td>
                   
                </tr>
                
            </tbody>
        </thead>
      </table>
    <?php include("../js.php") ?>
    </body>
</html>
