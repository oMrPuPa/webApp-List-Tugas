const popup = document.getElementById('add-task-popup');
const showBtn = document.getElementById('show-add-form-btn');
const closeBtn = document.getElementById('close-popup-btn');
const form = document.getElementById('add-task-form');
const taskContainerBelum = document.getElementById('belum-selesai-list'); 
const taskContainerSudah = document.getElementById('sudah-selesai-list'); 

const searchInput = document.getElementById('search-task'); 
const taskIdInput = document.getElementById('task-id-to-edit');
const popupTitle = document.querySelector('.popup-content h2'); 
const submitButton = document.querySelector('#add-task-form button[type="submit"]');

let currentTaskMode = 'add'; 

function createTaskHtml(task) {
    const tugasStts = task.tugas_stts == 1; 
    
    return `
        <div class="task-item ${tugasStts ? 'completed' : ''}">
            <h3>${task.nama_tugas}</h3>
            <p>${task.deskripsi}</p>
            <p style="font-size: 0.9em; color: ${tugasStts ? '#4CAF50' : '#FF9800'};">
                Deadline: ${task.tanggal_deadline}
            </p>
            <div class="task-actions">
                <button class="btn-action" 
                    onclick="updateStatus(${task.id}, ${tugasStts ? 0 : 1})">
                    ${tugasStts ? 'Tandai Belum' : 'Tandai Selesai'}
                </button>
                <button class="btn-action" onclick="editTask(${task.id})">Edit</button>
                <button class="btn-action btn-delete" onclick="deleteTask(${task.id})">Hapus</button>
            </div>
        </div>
    `;
}

function renderTasks(data) {
    taskContainerBelum.innerHTML = '';
    taskContainerSudah.innerHTML = '';
    
    if (data.success && data.data) {
        const tasksBelum = data.data.belum;
        const tasksSudah = data.data.sudah;

        if (tasksBelum.length === 0) {
            taskContainerBelum.innerHTML = '<p style="margin-top: 15px; color: #777;">Tidak ada tugas yang perlu diselesaikan.</p>';
        } else {
            tasksBelum.forEach(task => {
                taskContainerBelum.innerHTML += createTaskHtml(task);
            });
        }
        
        if (tasksSudah.length === 0) {
            taskContainerSudah.innerHTML = '<p style="margin-top: 15px; color: #777;">Belum ada tugas yang selesai.</p>';
        } else {
             tasksSudah.forEach(task => {
                taskContainerSudah.innerHTML += createTaskHtml(task);
            });
        }
    } else {
         taskContainerBelum.innerHTML = '<p style="color: red;">Error: Gagal memuat data dari server.</p>';
    }
}

function resetForm() {
    currentTaskMode = 'add';
    popupTitle.textContent = 'Tambah Tugas Baru';
    submitButton.textContent = 'Simpan Tugas';
    form.reset();
    if (taskIdInput) {
        taskIdInput.value = ''; 
    }
}

function loadTasks(searchKeyword = '') {
    let url = 'readTugas.php';
    if (searchKeyword.length > 0) {
        url += `?search=${encodeURIComponent(searchKeyword)}`;
    }
    
    fetch(url) 
        .then(response => {
            if (!response.ok) {
                throw new Error('HTTP Error: ' + response.status);
            }
            return response.json(); 
        })
        .then(data => {
            renderTasks(data); 
        })
        .catch(error => {
            console.error('Error saat memuat tugas:', error);
        });
}

function handleFormSubmit(event) {
    event.preventDefault();

    const formData = new FormData(form);
    let url = '';

    if (currentTaskMode === 'add') {
        url = 'createTugas.php';
    } else if (currentTaskMode === 'edit') {
        url = 'updateTugas.php'; 
    }

    fetch(url, {
        method: 'POST', 
        body: formData 
    })
    .then(response => response.text())
    .then(result => {
        console.log("Pesan Server (Submit):", result);
        popup.style.display = 'none';
        resetForm(); 
        loadTasks();
    })
    .catch(error => {
        console.error('Error saat submit form:', error);
    });
}

function updateStatus(taskId, newStatus) {
    const data = {
        idTugas: taskId,
        status: newStatus 
    };
    
    fetch('updateTugas.php', { 
        method: 'POST', 
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data)
    })
    .then(response => response.text())
    .then(result => {
        console.log("Pesan Server (UPDATE STATUS):", result);
        loadTasks();
    })
    .catch(error => {
        console.error('Error saat update status:', error);
    });
}

function deleteTask(taskId) {
    if (!confirm("Anda yakin ingin menghapus tugas ini?")) {
        return;
    }
    
    const data = { idTugas: taskId };

    fetch('deleteTugas.php', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data)
    })
    .then(response => response.text())
    .then(result => {
        console.log("Pesan Server (DELETE):", result);
        loadTasks(); 
    })
    .catch(error => {
        console.error('Error saat menghapus tugas:', error);
    });
}

function editTask(taskId) {
    fetch(`readSingleTugas.php?id=${taskId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const task = data.data;

                currentTaskMode = 'edit';
                popupTitle.textContent = 'Edit Tugas';
                submitButton.textContent = 'Simpan Perubahan';

                taskIdInput.value = task.id;
                document.getElementById('namaTugas').value = task.nama_tugas;
                document.getElementById('deskripsiTugas').value = task.deskripsi;
                document.getElementById('tanggalDeadline').value = task.tanggal_deadline;
                
                popup.style.display = 'flex';
                
            } else {
                alert('Gagal memuat data tugas: ' + data.pesan);
            }
        })
        .catch(error => {
            console.error('Error saat mengambil data untuk edit:', error);
            alert('Koneksi gagal saat mengambil data edit.');
        });
}

document.addEventListener('DOMContentLoaded', () => {
    showBtn.addEventListener('click', () => {
        popup.style.display = 'flex';
        resetForm();
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
        resetForm(); 
    });
    
    form.addEventListener('submit', handleFormSubmit);

    searchInput.addEventListener('input', () => {
        const keyword = searchInput.value.trim();
        loadTasks(keyword);
    });
    
    loadTasks();
});