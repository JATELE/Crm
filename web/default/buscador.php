<div class="navbar navbar-expand-lg border-bottom border-body py-4 px-3" style="background-color: #EDF8F6;">
    <div class="container-fluid d-flex justify-content-end align-items-center flex-wrap gap-3">
      <!-- Buscador -->
      <div class="input-group" style="max-width: 300px;">
        <input type="text" class="form-control" id="inputBusqueda" placeholder="Buscar productos..."
          aria-label="Buscar">
        <button class="btn btn-outline-secondary" type="button" id="btnBuscar">
          <i class="fa fa-search"></i>
        </button>
      </div>

      <!-- Filtro con estilo bootstrap pero funcionalidad original -->
      <div class="dropdown filtro-container">
        <button class="btn btn-outline-secondary dropdown-toggle filtro-btn" type="button" id="filtroDropdown"
          data-bs-toggle="dropdown" aria-expanded="false">
          ☰ Ordenar por
        </button>
        <ul class="dropdown-menu opciones-filtro" aria-labelledby="filtroDropdown">
          <li><a class="dropdown-item" href="#" data-order="asc">Precio más bajo</a></li>
          <li><a class="dropdown-item" href="#" data-order="desc">Precio más alto</a></li>
        </ul>
      </div>
    </div>
  </div>