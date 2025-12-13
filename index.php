<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App Buat Ngelist Tugas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        
        <header class="header">
            <h1>Hi, Rafi!</h1>
            <div class="search-add-area">
                <input type="text" id="search-task" placeholder="Cari tugas...">
                <button id="show-add-form-btn" class="btn-primary">+</button>
            </div>
        </header>

        <div id="add-task-popup" class="popup-overlay">
            <div class="popup-content">
                <h2>Tambah Tugas Baru</h2> 
                
                <form id="add-task-form">
                    
                    <input type="hidden" id="task-id-to-edit" name="idTugas"> 

                    <label for="namaTugas">Nama Tugas:</label>
                    <input type="text" id="namaTugas" name="namaTugas" required>

                    <label for="deskripsiTugas">Deskripsi:</label>
                    <textarea id="deskripsiTugas" name="deskripsiTugas"></textarea>

                    <label for="tanggalDeadline">Deadline:</label>
                    <input type="date" id="tanggalDeadline" name="tanggalDeadline">
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Tugas</button>
                        <button type="button" id="close-popup-btn" class="btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <main class="task-board">
            
            <div class="task-column belum-selesai">
                <h2>Belum Selesai</h2>
                <div id="belum-selesai-list" class="task-list">
                    </div>
            </div>

            <div class="task-column sudah-selesai">
                <h2>Sudah Selesai</h2>
                <div id="sudah-selesai-list" class="task-list">
                    </div>
            </div>
            
        </main>
    </div>

    <script src="script.js"></script> 
</body>
</html>