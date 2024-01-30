<?php
require_once('includes/DatabaseConfig.php');

// mirren user-at nga databaza
$sql = "SELECT id, username, display_name, email, role FROM users";
$result = $conn->query($sql);

// shikon nese ka errors
if ($result->num_rows > 0) {
  // user-at shfaqen ne tabele
  echo "<table class='user-table'>";
  echo "<thead>";
  echo "<tr><th>ID</th><th>Username</th><th>Display Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>";
  echo "</thead>";
  echo "<tbody>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['display_name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['role'] . "</td>";
    // butonat per edit dhe delete
    echo "<td>";
    echo "<a href='#' class='edit-user' data-id='" . $row['id'] . "'>Edit</a>";
    echo "<a href='#' class='delete-user' data-id='" . $row['id'] . "'>Delete</a>";
    echo "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} else {
  echo "No users found.";
}

$conn->close(); // mbyllet lidhja e databazes
