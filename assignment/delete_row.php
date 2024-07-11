<html>
<head>
	<meta charset = "utf-8">
  <link rel="stylesheet" type="text/css" href="Hnav.css">
	<style type="text/css">

	</style>
</head>



<body>

<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="ar.php">Add data</a></li>
  <li><a href="delete_row.php">Delete data</a></li>
  <li><a href="update.php">Edit & Update </a></li>
  
</ul>

<?php // connect.php allows connection to the database

  require 'connect.php'; //using require will include the connect.php file each time it is called.

  function validate()
  {
    global $error;
    global $conn;
    $error = "Book successfully removed.";

    if (empty($_POST['id']))
    {
      $error = "Please enter the book id";
      return false;
    }

    if (is_numeric($_POST['id'])== false)
    {
      $error = "book id can only be numbers";
      return false;
    }
    if (strlen($_POST['id']) > 3)
    {
      $error = "id is too long";
      return false;
    }
    
    $id = $_POST['id'];
    $query = "SELECT id FROM books WHERE id = "."'id'";

    $result = $conn->query($query);

    if (!(mysqli_num_rows($result) > 0))
    {
      $error = "Error: id is not found in the database.";
    }
    
    return true;
  }



    if (isset($_POST['id'])   &&
        isset($_POST['title']) &&
        isset($_POST['author'])
		)
		
      
  {
    $id     = assign_data($conn, 'id');
    $title  = assign_data($conn, 'title');
    $author = assign_data($conn, 'author');
    

    $validated = validate();
    
    if ($validated)
    {
      $query = "DELETE FROM books WHERE id = ('$id')";
      $result =$conn->query($query);

      if (!$result) echo "INSERT failed: $query<br>".
      $conn->error . "<br><br>";
    }


  }


echo<<<_HTML

  <form action="  " method="post">
  
    Book id: <input type="text" name="id"> <br><br>
    Book title: <input type="text" name="title"> <br><br>
    Author name: <input type="text" name="author"> <br><br>
    Genre: <input type="text" name="genre" value = ""> <br><br>
    Year: <input type="text" name="year" value = ""> <br><br>

    <input type="submit" value="ADD RECORD">
	
   </form>
_HTML;

echo "<p>";
if (isset($error))
{echo "<p><em>$error</em></p>";}
echo "</p>";



function assign_data($conn, $var)
{
  return $conn->real_escape_string($_POST[$var]);
}


$query  = "SELECT * FROM books";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);

$rows = $result->num_rows;


print<<<_HTML
 <b>Here is your Book list</b>

<table id = "book_table">
    <tr>
    <th>Book id</th>
    <th>Title</th>
    <th>Author</th>
    <th>Genre</th>
    <th>Year</th>
    </tr>
_HTML;


 if ($result->num_rows >0)
    {
    echo "The books list:<br><br>";
    while($row = $result->fetch_assoc()) 
      {
          echo "<tr>";
          echo "<td>".$row["id"]."</td>";
          echo "<td>".$row["title"]."</td>";
          echo "<td>".$row["author"]."</td>";
          echo "<td>".$row["genre"]."</td>";
          echo "<td>".$row["year"]."</td>";
          echo "</tr>";
      }
    } 
    else 
    {
      echo "0 results";
    }


print<<<_HTML
</table>
_HTML;
  
  ?>


