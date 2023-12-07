<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/like_favorite.js"></script>
<?php
session_start();

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";
$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}
$characterId = (int)$_SESSION['characterId'];
$character = queryByIdForGuide($db,"characters", $characterId);
if (empty($_GET['guideSorting'])) $guides = queryForeignKeyForGuide($db,"guides","characterID",$_SESSION['characterId']);
else{
    $guideSorting = $_GET['guideSorting'];

    if ($guideSorting == 0) $guides = sortingGuideData($db, "user_like", "ASC", $characterId);
    else if ($guideSorting == 1) $guides = sortingGuideData($db, "user_like", "DESC", $characterId);
    else if ($guideSorting == 2) $guides = sortingGuideData($db, "user_favorite", "ASC", $characterId);
    else if ($guideSorting == 3) $guides = sortingGuideData($db, "user_favorite", "DESC", $characterId);
    else $guides = queryForeignKeyForGuide($db,"guides","characterID",$_SESSION['characterId']);
}


echo "<h2>Guides for " . $character['name'] . "</h2>";
showGuideCard($db,$guides);


function sortingGuideData($db, $table, $order, $id){
    $query = "SELECT g.*, COALESCE(i.count, 0) AS count ";
    $query .= "FROM guides g ";
    $query .= "LEFT JOIN (";
    $query .= "SELECT guideID, COUNT(*) as count ";
    $query .= "FROM " . $table;
    $query .= " GROUP BY guideID) ";
    $query .= "i ON g.guideID = i.guideID ";
    $query .= "WHERE g.characterID = " . $id . " ORDER BY i.count " . $order;

    $result = $db->query($query);
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }
    return $allRows;
}

function queryForeignKeyForGuide($db, $table, $condition ,$foreignKey){
    if (!is_numeric($foreignKey)) {
        echo "Invalid foreign key";
        return null;
    }

    $stmt = $db->prepare("SELECT * FROM " . $table . " WHERE " . $condition ." = ?");
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }

    $stmt->bind_param('i', $foreignKey);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }

    return $allRows;
}

function queryByIdForGuide($db, $table, $id){
    if (!is_numeric($id)) {
        echo "Invalid ID";
        return null;
    }

    $stmt = $db->prepare('SELECT * FROM ' . $table . ' WHERE id = ?');
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }

    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    return $result->fetch_assoc();
}

function showGuideCard($db, $guides){
    foreach ($guides as $data) {
        $bestWeapon = queryByIdForGuide($db,"weapons",$data['bestWeaponID']);
        $replacementWeapon = queryByIdForGuide($db,"weapons",$data['replacementWeaponID']);
        $artifact_1 = queryByIdForGuide($db,"artifacts",$data['artifactID_1']);
        $artifact_2 = queryByIdForGuide($db,"artifacts",$data['artifactID_2']);
        $publisher = queryForeignKeyForGuide($db,"users", "uid", $data['userID']);
        $postDateTimestamp = strtotime($data['postDate']);
        $formattedDate = date('Y-m-d', $postDateTimestamp);

        echo "<div class='guideCard' id='guideID_" . $data['guideID'] . "'>";
        echo "<h2>" . $data['guideTitle'] . "</h2>";
        echo "<div class='horizontal-layout'>";

        echo "<div class='equipment'>";
        echo "<div class='vertical-layout'>";
        echo "<div><p><strong>Best Weapon</strong></p>";
        echo "<img src='../res/WeaponImages/" . $bestWeapon['image'] . "' width=100>";
        echo "</div>";

        echo "<div><p><strong>Artifacts (2pcs)</strong></p>";
        echo "<img src='../res/ArtifactImages/" . $artifact_1['image'] . "' width=75>";
        echo "</div>";
        echo "</div>";

        echo "<div class='vertical-layout'>";
        echo "<div><p><strong>Replacement Weapon</strong></p>";
        echo "<img src='../res/WeaponImages/" . $replacementWeapon['image'] . "' width=100>";
        echo "</div>";

        echo "<div><p><strong>Artifacts (2pcs)</strong></p>";
        echo "<img src='../res/ArtifactImages/" . $artifact_2['image'] . "' width=75>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<div class='guide-info'>";
        echo "<div>";
        echo "<p><strong>Description</strong></p>";
        echo "<p class='guide-description'>" . $data['guideDescription'] . "</p>";
        echo "<p>Published by <strong>" . $publisher[0]['userName'] . "</strong></p>";
        echo "<p>" . $formattedDate . "</p>";
        echo "</div>";

        echo "<div class='guide-buttons'>";
        echo "<button class='svg-button userLike' data-guide-id='" . $data['guideID'] . "'>";
        showUserAmount($db, "user_like", $data['guideID']);
        showHeart();
        echo "</button>";
        echo "<button class='svg-button userFavorite' data-guide-id='" . $data['guideID'] . "'>";
        showUserAmount($db, "user_favorite", $data['guideID']);
        showStar();
        echo "</button>";
        echo "<a href='#'>See More Details and Comments</a>";
        echo "</div>";
        echo "</div>";

        echo "</div>";
        echo "</div>";
    }
}


function showHeart(){
    echo  '<svg class="svg-heart" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19.3 5.71002C18.841 5.24601 18.2943 4.87797 17.6917 4.62731C17.0891 4.37666 16.4426 4.2484 15.79 4.25002C15.1373 4.2484 14.4909 4.37666 13.8883 4.62731C13.2857 4.87797 12.739 5.24601 12.28 5.71002L12 6.00002L11.72 5.72001C10.7917 4.79182 9.53273 4.27037 8.22 4.27037C6.90726 4.27037 5.64829 4.79182 4.72 5.72001C3.80386 6.65466 3.29071 7.91125 3.29071 9.22002C3.29071 10.5288 3.80386 11.7854 4.72 12.72L11.49 19.51C11.6306 19.6505 11.8212 19.7294 12.02 19.7294C12.2187 19.7294 12.4094 19.6505 12.55 19.51L19.32 12.72C20.2365 11.7823 20.7479 10.5221 20.7442 9.21092C20.7405 7.89973 20.2218 6.64248 19.3 5.71002Z" fill="#919191" class="svg-heart-color"></path> </g></svg>';
}

function showStar(){
    echo '<svg class="svg-star" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.12 9.88005C21.0781 9.74719 20.9996 9.62884 20.8935 9.53862C20.7873 9.4484 20.6579 9.38997 20.52 9.37005L15.1 8.58005L12.67 3.67005C12.6008 3.55403 12.5027 3.45795 12.3853 3.39123C12.2678 3.32451 12.1351 3.28943 12 3.28943C11.8649 3.28943 11.7322 3.32451 11.6147 3.39123C11.4973 3.45795 11.3991 3.55403 11.33 3.67005L8.89999 8.58005L3.47999 9.37005C3.34211 9.38997 3.21266 9.4484 3.10652 9.53862C3.00038 9.62884 2.92186 9.74719 2.87999 9.88005C2.83529 10.0124 2.82846 10.1547 2.86027 10.2907C2.89207 10.4268 2.96124 10.5512 3.05999 10.6501L6.99999 14.4701L6.06999 19.8701C6.04642 20.0091 6.06199 20.1519 6.11497 20.2826C6.16796 20.4133 6.25625 20.5267 6.36999 20.6101C6.48391 20.6912 6.61825 20.7389 6.75785 20.7478C6.89746 20.7566 7.03675 20.7262 7.15999 20.6601L12 18.1101L16.85 20.6601C16.9573 20.7189 17.0776 20.7499 17.2 20.7501C17.3573 20.7482 17.5105 20.6995 17.64 20.6101C17.7537 20.5267 17.842 20.4133 17.895 20.2826C17.948 20.1519 17.9636 20.0091 17.94 19.8701L17 14.4701L20.93 10.6501C21.0305 10.5523 21.1015 10.4283 21.1351 10.2922C21.1687 10.1561 21.1634 10.0133 21.12 9.88005Z" fill="#919191" class="svg-star-color"></path> </g></svg>';
}

function showUserAmount($db, $table, $guideId){
    $query = "SELECT COUNT(*) AS like_count FROM " . $table . " WHERE guideID = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('i', $guideId);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }
    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $row = $result->fetch_assoc();
    $likeCount = $row['like_count'];
    echo "<p>" . $likeCount . "</p>";
}