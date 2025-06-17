{{-- views\welcome.blade.php --}}
@extends('layouts.default') 
@section("content")

<main class="flex-shrink-0 pt-5">
  <div class="container" style="max-width: 600px">
    {{-- Flash Messages --}}
    @if(session()->has("success"))
    <div class="alert alert-success shadow-sm rounded-3">
      {{ session()->get("success") }}
    </div>
    @endif

    @if(session("error"))
    <div class="alert alert-danger shadow-sm rounded-3">
      {{ session("error") }}
    </div>
    @endif

    {{-- Card Container --}}
    <div class="my-5 p-4 bg-white bg-opacity-75 rounded-4 shadow-lg" style="backdrop-filter: blur(10px);">
      <div class="mb-4">
        <h4 class="fw-bold text-primary">Welcome, {{ auth()->user()->name }}</h4>
      </div>

      <h6 class="border-bottom pb-2 mb-4 text-dark-emphasis">📝 Your Task List</h6>

      @forelse ($tasks as $task)
      <div class="d-flex align-items-start mb-4 border-bottom pb-3">
        <div class="me-3">
          <i class="bi bi-chevron-right fs-4 text-secondary"></i>
        </div>

        <div class="flex-grow-1">
          <div class="d-flex justify-content-between align-items-center">
            <strong class="text-dark">
              {{ $task->title }}
              <span class="badge bg-info text-dark ms-2">{{ $task->deadline }}</span>
            </strong>
            <div class="d-flex gap-2">
              <a href="{{ route('task.status.update', $task->id) }}" class="btn btn-outline-success btn-sm rounded-circle" title="Mark as Done">
                <i class="bi bi-check-lg"></i>
              </a>
              <a href="{{ route('task.delete', $task->id) }}" class="btn btn-outline-danger btn-sm rounded-circle" title="Delete">
                <i class="bi bi-trash"></i>
              </a>
            </div>
          </div>
          <small class="text-secondary">{{ $task->description }}</small>
        </div>
      </div>
      @empty
      <p class="text-muted">You don't have any tasks yet.</p>
      @endforelse

      {{-- Pagination --}}
      <div class="mt-4 d-flex justify-content-center">
        {{ $tasks->links() }}
      </div>
    </div>
  </div>
</main>
@endsection
