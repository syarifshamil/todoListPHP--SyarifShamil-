<?php session_start();

// Jika ada index yang ingin di-edit
if (isset($_POST['edit_index'])) {
    $edit_index = $_POST['edit_index'];
    $edit_activity = $_SESSION['users'][$edit_index]['Activity'];
    $edit_priority = $_SESSION['users'][$edit_index]['Priority'];
} else {
    $edit_index = null;
    $edit_activity = '';
    $edit_priority = 'low';
}
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
    <!-- css -->
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container mt-4">
        <?php
        // Menampilkan notifikasi
            if (isset($_SESSION['Message'])) {
                // Tentukan class notifikasi berdasarkan tipe
                $notificationClass = isset($_SESSION['Type']) && $_SESSION['Type'] === 'error' ? 'Delete' : 'add';
                echo '<div class="notification ' . $notificationClass . ' show">'
                    . $_SESSION['Message'] 
                    . '<button type="button" class="btn-close" onclick="this.parentElement.style.display=\'none\'" aria-label="Close"></button></div>';
                unset($_SESSION['Message']); // Clear the message after displaying
                unset($_SESSION['Type']);
            }
        ?>

        <div class="card">
            <div class="card-header bg-dark text-white">To Do List</div>
            <div class="card-body">
                <form method="POST" action="UpdateActivity.php">
                    <!-- Field Activity -->
                    <div class="mb-3">
                        <label for="Activity" class="form-label">Aktivitas</label>
                        <input type="text" class="form-control" name="Activity" value="<?php echo $edit_activity; ?>" required>
                    </div>
                    <!-- Field Priority -->
                    <div class="mb-3">
                        <label for="Priority" class="form-label">Prioritas</label>
                        <select name="Priority" id="Priority" class="form-select">
                            <option value="Low" <?php if ($edit_priority == 'Low') echo 'selected'; ?>>Rendah</option>
                            <option value="Medium" <?php if ($edit_priority == 'Medium') echo 'selected'; ?>>Sedang</option>
                            <option value="High" <?php if ($edit_priority == 'High') echo 'selected'; ?>>Tinggi</option>
                        </select>
                    </div>
                    
                    <!-- Jika sedang edit, tambahkan hidden input untuk menyimpan index -->
                    <?php if ($edit_index !== null): ?>
                        <input type="hidden" name="edit_index" value="<?php echo $edit_index; ?>">
                    <?php endif; ?>
                    
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        <?php echo $edit_index !== null ? 'Update' : 'kirim'; ?>
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="ListActivities.php" class="btn btn-secondary">Cek Aktivitas</a>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
