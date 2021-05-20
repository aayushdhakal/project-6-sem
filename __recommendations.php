<?php
require_once './__connection.php';
?>

<?php
if (!isset($countOfRecomendations) && !is_numeric($countOfRecomendations)) {
   $countOfRecomendations = 4;
}

$queryForRecomendationPosts = mysqlPostRecommendation($countOfRecomendations);
$resultsForRecomendation = $connection->query($queryForRecomendationPosts);

$recomendationOfPosts = [];
while ($row = $resultsForRecomendation->fetch_assoc()) {
   array_push($recomendationOfPosts, $row);
}

// print_r($recomendationOfPosts);

?>
