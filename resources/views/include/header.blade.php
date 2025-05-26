<header>
    <nav class="navbar navbar-expand-md fixed-top shadow-sm" style="background: linear-gradient(135deg, #667eea, #764ba2);">
      <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
          <i class="bi bi-check2-square me-2"></i>To Do App
        </a>
        <button
          class="navbar-toggler bg-white"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link text-white fw-semibold active" href="#">
                <i class="bi bi-house-door me-1"></i>Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fw-semibold" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
              </a>
            </li>
          </ul>
          <a
            class="btn btn-light rounded-pill px-4 py-2 fw-semibold"
            href="{{ route('task.add') }}"
          >
            <i class="bi bi-plus-circle me-1"></i>Add Task
          </a>
        </div>
      </div>
    </nav>
  </header>
  