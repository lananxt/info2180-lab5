<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$context = $_GET['context'];
$countryName = htmlspecialchars($_GET['countryName']); // Sanitizing query input

$querystmt = "";

// Determine context
if($context == "cities"){
	$stmt = $pdo->prepare("SELECT ci.name, ci.district, ci.population 
		FROM cities ci INNER JOIN countries co 
		ON ci.country_code=co.code WHERE co.name=:countryName");
}else{
	$stmt = $pdo->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :countryName");
}

// Querying database
$countryName = $context == "cities" ? $countryName : "%$countryName%";
$stmt->bindParam(":countryName", $countryName);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);





exit(json_encode($results));
?>



