<?php
$host = 'localhost';
$dbname = 'php_d3';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $address = htmlspecialchars($_POST['address']);
        $country = htmlspecialchars($_POST['country']);
        $gender = $_POST['gender'];
        
        $skills = isset($_POST['skills']) ? implode(',', $_POST['skills']) : '';
        
        $username = htmlspecialchars($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $department = htmlspecialchars($_POST['department']);
        $sh68sa = htmlspecialchars($_POST['sh68sa']);
        
    
        $sql = "INSERT INTO users (first_name, last_name, address, country, gender, skills, username, password, department, sh68sa) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        
        if ($stmt->execute([$first_name, $last_name, $address, $country, $gender, $skills, $username, $password, $department, $sh68sa])) {
            header("Location: list.php");
            exit();
        } else {
            echo "Error: Could not save data";
        }
    }
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
