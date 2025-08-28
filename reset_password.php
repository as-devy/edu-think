<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "db.php"; // ✅ Use shared database connection

    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if token exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ?");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->store_result(); // ✅ Needed before checking num_rows

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        // Update password and clear reset token
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
        $stmt->bind_param('si', $password, $id);
        if ($stmt->execute()) {
            echo "Password has been reset.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid token.";
    }

    $stmt->close();
    $conn->close();
}
