<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>新增文章</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    label {
        font-weight: bold;
    }
    input[type="text"], textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<form action="" method="post">
    <label for="title">文章標題:</label><br>
    <input type="text" id="title" name="title" required><br>
    <label for="content">文章內容:</label><br>
    <textarea id="content" name="content" rows="8" required></textarea><br>
    <label for="choose">文章種類</label>
    <select name="choose" id="choose">
    </select> <br>
    <input type="submit" value="提交">
    
      
    </select>
</form>

</body>
</html>