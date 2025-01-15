<?php
// Fetch animal data based on ID
if (isset($_GET['id'])) {
    require '../classes/Animal.php'; // Include the Animal class

    $animal = new Animal();
    $id = $_GET['id'];
    $animalData = $animal->getAnimalById($id); // Assuming you have a method to fetch animal by ID
} else {
    echo "Invalid ID.";
    exit;
}


// Handle form submission and image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nom' => $_POST['nom'],
        'categorie' => $_POST['categorie'],
        'age' => $_POST['age'],
        'description' => $_POST['description'],
        'prix' => $_POST['prix'],
        'image' => $animalData['image'] // Initialize with current image
    ];

    // Check if an image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imagePath = '../uploads/' . basename($imageName);

        // Move the uploaded image to the 'uploads' folder
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            $data['image'] = $imagePath; // Update with new image path
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    // Call the method to update the animal details
    $animal->editAnimal($id, $data, $data['image']); // Pass the image path

    // Redirect to the animals list page
    header("Location: animals.php");
    exit; // Make sure to exit after the redirect to stop further script execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Animal</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Animal</h1>
                        </div>

                        <!-- PHP to handle form submission -->
                        <form class="user" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="nom" class="form-control form-control-user" placeholder="Animal Name" value="<?php echo htmlspecialchars($animalData['nom']); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="categorie" class="form-control form-control-user" placeholder="Category" value="<?php echo htmlspecialchars($animalData['categorie']); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="age" class="form-control form-control-user" placeholder="Age" value="<?php echo htmlspecialchars($animalData['age']); ?>" required>
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control form-control-user" placeholder="Description" required><?php echo htmlspecialchars($animalData['description']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="number" step="0.01" name="prix" class="form-control form-control-user" placeholder="Price" value="<?php echo htmlspecialchars($animalData['prix']); ?>" required>
                            </div>

                            <!-- Image Upload Field -->
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" class="form-control form-control-user" id="image">
                                <?php if ($animalData['image']) { ?>
                                    <p>Current Image: <img src="<?php echo htmlspecialchars($animalData['image']); ?>" width="100"></p>
                                <?php } ?>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">Update Animal</button>
                        </form>

                        <!-- Return button -->
                        <div class="text-center mt-3">
                            <a href="animals.php" class="btn btn-secondary ">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
