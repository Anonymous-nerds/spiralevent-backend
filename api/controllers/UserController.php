<?php


include './config/database.php'; // Include the database connection

// Function to register a user
function registerUser($db, $name, $email, $password) {
    // Check if the email already exists
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        http_response_code(400);
        echo json_encode(['message' => 'Email already exists']);
        return;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Generate verification code
    $verificationCode = bin2hex(random_bytes(16));

    // Insert the user
    $stmt = $db->prepare(
        "INSERT INTO users (name, email, password, verification_code) VALUES (:name, :email, :password, :verification_code)"
    );
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
        'verification_code' => $verificationCode
    ]);

    // Send verification email (pseudo function for now)
    sendVerificationEmail($email, $verificationCode);

    http_response_code(201);
    echo json_encode(['message' => 'User registered successfully! Check your email for verification.']);
}

// Function to log in a user
function loginUser($db, $email, $password) {
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        if (!$user['is_verified']) {
            http_response_code(403);
            echo json_encode(['message' => 'Email not verified.']);
            return;
        }

        // Create a basic JWT token (replace with real implementation for security)
        $token = base64_encode(json_encode(['id' => $user['id'], 'email' => $user['email']]));

        echo json_encode(['message' => 'Login successful', 'token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid email or password']);
    }
}

// Function to update a user
function updateUser($db, $id, $name, $email) {
    $stmt = $db->prepare("UPDATE users SET name = :name, email = :email, updated_at = NOW() WHERE id = :id");
    $stmt->execute(['id' => $id, 'name' => $name, 'email' => $email]);

    echo json_encode(['message' => 'User updated successfully']);
}

// Function to delete a user
function deleteUser($db, $id) {
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo json_encode(['message' => 'User deleted successfully']);
}

// Function to send verification email (pseudo)
function sendVerificationEmail($email, $code) {
    // Use a library like PHPMailer here
    // For example:
    // $subject = "Verify Your Email";
    // $body = "Click this link to verify your email: https://yourdomain.com/verify?code=$code";
    // mail($email, $subject, $body);

    echo "Verification email sent to $email with code $code (mock)";
}
?>
