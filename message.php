<?php
// $conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");
$conn = mysqli_connect("localhost", "chpl", "Chpl@321.", "bot") or die("Database Error");
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

if(mysqli_num_rows($run_query) > 0){
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['replies'];
    echo $replay;
} else {
    // Log the unknown query for learning
    logUserInput($getMesg, ""); // Empty response for now
    echo "Sorry, I can't understand you!";
}

// Function to log user input
function logUserInput($userQuery, $botResponse) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO user_inputs (user_query, bot_response) VALUES (?, ?)");
    $stmt->bind_param("ss", $userQuery, $botResponse);
    $stmt->execute();
    $stmt->close();
}
?>
