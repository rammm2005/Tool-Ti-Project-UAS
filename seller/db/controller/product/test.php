<?php
include 'includes/db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $nama = htmlspecialchars($_POST["name"]);
    $umur = intval($_POST["age"]);
    $jeniskelamin = htmlspecialchars($_POST["gender"]);
    $alamat = htmlspecialchars($_POST["address"]);
    $notelp = htmlspecialchars($_POST["phone"]);
    $member = htmlspecialchars($_POST["membership"]);


    // var_dump($nama, $umur, $jeniskelamin, $alamat, $notelp, $member);
    // Prepared statement
    $sql = "INSERT INTO members (nama, umur, jeniskelamin, alamat, notelp, member) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {  
        $stmt->bind_param("sissss", $nama, $umur, $jeniskelamin, $alamat, $notelp, $member);

       
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error during execution: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error during prepare: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <link rel="stylesheet" href="css/stylecreate.css">
</head>
<body>

    <div class="add-member-container">
        <h1 class="add-member-title">Add Member</h1>
        <h2 class="motivasi">"Tingkatkan kualitas hidupmu dengan menjadi member fitness kami.
             Jadilah lebih sehat, lebih kuat, dan lebih bahagia!"</h2>
     
        <form class="add-member-form" method="post" action="">
            <label for="name" class="input-label">Name:</label>
            <input type="text" name="name" required class="input-field">

            <label for="age" class="input-label">Age:</label>
            <input type="number" name="age" required class="input-field">

            <label for="gender" class="input-label">Gender:</label>
            <select name="gender" required class="select-field">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label for="address" class="input-label">Address:</label>
            <input type="text" name="address" required class="input-field">

            <label for="phone" class="input-label">Phone:</label>
            <input type="tel" name="phone" required class="input-field">

            <label for="membership" class="input-label">Membership:</label>
            <select name="membership" required class="select-field">
                <option value="3 months">3 months</option>
                <option value="6 months">6 months</option>
                <option value="12 months">12 months</option>
            </select>

            <button type="submit" class="submit-button">Submit</button>
        </form>
        <a href="index.php" class="back-link">Kembali ke List Member</a>
    </div>

</body>
</html>