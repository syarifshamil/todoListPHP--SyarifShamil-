<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
    <!-- profile web -->
    <link rel="icon" type="image/jpeg" href="image/iconweb.jpeg">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container mt-4">
             <?php
                // Menampilkan notifikasi jika ada
                if (isset($_SESSION['Message'])) {
                    echo '<div class="notification ' . $_SESSION['Type'] . '">'
                        . $_SESSION['Message'] 
                        . '<button type="button" class="btn-close" onclick="this.parentElement.style.display=\'none\'" aria-label="Close" style=""></button></div>';  
                    
                    // Hapus notifikasi setelah ditampilkan
                    unset($_SESSION['Message']);
                    unset($_SESSION['Type']);
                }
            ?>
    <div class="card">
        <div class="card-header bg-brown text-white">
            List Activities
        </div>
        <!-- Display table -->
        <div class="card-body ">
            <?php
                if(isset($_SESSION["users"]) && !empty($_SESSION['users'])) {
                    echo '<table class="table table-bordered table-striped table-hover">';
                    echo '<thead><tr> 
                    <th>Activity</th> 
                    <th>Priority</th> 
                    <th>Action</th>
                    </tr></thead>' ;
                    echo '<tbody>';
                    foreach ($_SESSION['users'] as $index => $user) {
                        echo '<tr>';
                        echo '<td>' . $user['Activity'] . '</td>';
                        echo '<td>' . $user['Priority'] . '</td>';
                        // Delete and edit button
                        echo '<td>
                                <form method="POST" action="DeleteActivities.php" style="display:inline-block;">
                                    <input type="hidden" name="index" value="' . $index . '">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">
                                        <i class="bi bi-trash3-fill"></i> 
                                    </button>
                                </form>
                            
                                <form method="POST" action="index.php" style="display:inline-block;">
                                    <input type="hidden" name="edit_index" value="' . $index . '">
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> 
                                    </button>
                                </form>
                            </td>';

                    }
                    echo '</tbody></table>';
            
                } else {
                    echo '<div class="alert alert-danger">Tidak ada data</div>';
                }
            ?>
        </div>
    </div>
    <!-- Button Add Activity -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-primary w-100">Add Activity</a>
        </div>
    </div>

    <!-- Javascript Notifikasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.querySelector('.notification');
            if (notification) {
                // Menampilkan notifikasi dengan animasi
                setTimeout(function() {
                    notification.classList.add('show');
                }, 100); // Menunggu sedikit sebelum menampilkan

                // Menghilangkan notifikasi setelah 2 detik
                setTimeout(function() {
                    notification.classList.remove('show');
                }, 2000); // Durasi 2 detik
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>


