<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Share</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <?php include "header.php"; ?>
    <main>
        <div class="form-container">
            <h2>UPLOAD YOUR RECIPE</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder=" Enter Recipe Name" required><br>
                <textarea name="description" placeholder="Description" required></textarea><br>
                <input type="file" name="image" accept="image/*" required><br>
                <button type="submit">Upload</button>
            </form>
        </div>
    </main>
      <?php include "footer.php"; ?>
</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name =$_POST['name'];
    $desc = $_POST['description'];
    $imagePath = '';

    if (!empty($_FILES['image']['tmp_name']) &&
        ($_FILES['image']['type'] === 'image/jpeg' ||
         $_FILES['image']['type'] === 'image/jpg' ||
         $_FILES['image']['type'] === 'image/png')) {

        $imgName = time() . '_' . basename($_FILES['image']['name']);
        $target = 'uploaded_images/' . $imgName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $imagePath = $target;
        }
    }

    if ($imagePath !== '') {
        $data = [
            'name' => $name,
            'description' => $desc,
            'image' => $imagePath
        ];

        $jsonFile = 'recipes.json';
        $existing = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
        $existing[] = $data;
        file_put_contents($jsonFile, json_encode($existing, JSON_PRETTY_PRINT));
        echo "<script> 
        alert('Recipe Uploaded Successfully'); 
       location.href = 'index.php';
        </script>";
    } else {
         echo "<script> 
         alert('Invalid image type. Only JPG, JPEG, PNG allowed.'); 
         </script>";
    }
}
?>