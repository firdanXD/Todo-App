<div class="modal fade" id="taskmodal" tabindex="-1" aria-labelledby="taskmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content bg-dark text-white">
          <div class="modal-header border-0">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="id_tugas" id="id_tugas">
              <div class="mb-3">
                  <label for="judul" class="form-label">Judul</label>
                  <input type="text" class="form-control" id="detail-judul">
              </div>
              <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea class="form-control" id="detail-deskripsi" rows="3"></textarea>
              </div>
              <div class="row">
                  <div class="col-8 text-end">
                      <label for="list" class="visually-hidden">Tambah List</label>
                      <input type="text" class="form-control" id="list" placeholder="Tambah List">
                  </div>
                  <div class="col-4 text-end">
                      <button type="button" class="btn btn-success" onclick="tambahList()">Tambah List</button>
                  </div>
              </div>
              <br>
              <ul class="list-group" id="list-check">
              </ul>
              <br>
              <br>
              <div class="text-end">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="simpan" onclick="ubah()">Simpan</button>
              </div>
          </div>
      </div>
  </div>
</div>