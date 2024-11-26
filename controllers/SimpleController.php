<?php

include './config/database.php'; // Include the database connection

// Function to get data
function getData($db) {
    try {
        // Fetch data from the posts table
        $stmt = $db->prepare("SELECT * FROM posts");
        $stmt->execute(); // Execute the query

        // Check if any rows exist
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch data as associative array
            echo json_encode(['message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            // No data found
            echo json_encode(['message' => 'No data found']);
        }
    } catch (Exception $e) {
        // Handle query or execution errors
        http_response_code(500);
        echo json_encode(['message' => 'Error fetching data', 'error' => $e->getMessage()]);
    }
}


function insertData($db, $title, $content, $category_id) {
  try {
      // Check if the data already exists
      $stmt = $db->prepare("SELECT * FROM posts WHERE title = :title");
      $stmt->execute(['title' => $title]);
      if ($stmt->rowCount() > 0) {
          http_response_code(400);
          echo json_encode(['message' => 'Data with this title already exists']);
          return;
      }

      // Insert the data
      $stmt = $db->prepare(
          "INSERT INTO posts (title, content, category_id) VALUES (:title, :content, :category_id)"
      );
      $stmt->execute([
          'title' => $title,
          'content' => $content,
          'category_id' => $category_id
      ]);

      http_response_code(201);
      echo json_encode(['message' => 'Data inserted successfully!']);
  } catch (PDOException $e) {
      // Handle database errors
      http_response_code(500);
      echo json_encode(['message' => 'Database error', 'error' => $e->getMessage()]);
  }
}

function updateData($db, $id, $title, $content, $category_id) {
  try {
      // Check if the post exists
      $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
      $stmt->execute(['id' => $id]);
      if ($stmt->rowCount() === 0) {
          http_response_code(404);
          echo json_encode(['message' => 'Post not found']);
          return;
      }

      // Update the post
      $stmt = $db->prepare(
          "UPDATE posts 
           SET title = :title, content = :content, category_id = :category_id
           WHERE id = :id"
      );
      $stmt->execute([
          'id' => $id,
          'title' => $title,
          'content' => $content,
          'category_id' => $category_id
      ]);

      http_response_code(200);
      echo json_encode(['message' => 'Post updated successfully']);
  } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode(['message' => 'Database error', 'error' => $e->getMessage()]);
  }
}


function deleteData($db, $id) {
  try {
      // Check if the post exists
      $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
      $stmt->execute(['id' => $id]);
      if ($stmt->rowCount() === 0) {
          http_response_code(404);
          echo json_encode(['message' => 'Post not found']);
          return;
      }

      // Delete the post
      $stmt = $db->prepare("DELETE FROM posts WHERE id = :id");
      $stmt->execute(['id' => $id]);

      http_response_code(200);
      echo json_encode(['message' => 'Post deleted successfully']);
  } catch (PDOException $e) {
      http_response_code(500);
      echo json_encode(['message' => 'Database error', 'error' => $e->getMessage()]);
  }
}




?>
