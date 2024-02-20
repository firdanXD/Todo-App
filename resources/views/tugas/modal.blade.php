<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="mb-3">
                  <label for="Judul" class="form-label">Judul</label>
                  <input type="text" class="form-control" id="judul">
                </div>
                <div class="mb-3">
                    <label for="desripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="3"></textarea>
                  </div>
                  <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="tambah()" id="tambah">Tambah</button>
                  </div>
        </div>
      </div>
    </div>
  </div>