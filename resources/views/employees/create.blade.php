@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary"><i class="fas fa-user-plus"></i> Thêm Nhân Viên</h2>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên Nhân Viên</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Chức Vụ</label>
            <select name="position" id="position" class="form-control">
                @foreach ($positions as $position)
                    <option value="{{ $position }}">{{ $position }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Phòng Ban</label>
            <select name="department" id="department" class="form-control">
                @foreach ($departments as $department)
                    <option value="{{ $department }}">{{ $department }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="hire_date" class="form-label">Ngày Nhập</label>
            <input type="date" name="hire_date" id="hire_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Lương</label>
            <input type="number" step="0.01" name="salary" id="salary" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Lưu Nhân Viên
        </button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
