@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-warning"><i class="fas fa-edit"></i> Sửa Nhân Viên</h2>

    <div class="modal fade show" id="editEmployeeModal" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh Sửa Nhân Viên</h5>
                    <a href="{{ route('employees.index') }}" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="edit-id" value="{{ $employee->id }}">

                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Tên Nhân Viên</label>
                            <input type="text" name="name" id="edit-name" value="{{ $employee->name }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-position" class="form-label">Chức Vụ</label>
                            <select name="position" id="edit-position" class="form-control">
                                @foreach ($positions as $position)
                                    <option value="{{ $position }}" {{ $employee->position == $position ? 'selected' : '' }}>
                                        {{ $position }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-department" class="form-label">Phòng Ban</label>
                            <select name="department" id="edit-department" class="form-control">
                                @foreach ($departments as $department)
                                    <option value="{{ $department }}" {{ $employee->department == $department ? 'selected' : '' }}>
                                        {{ $department }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-hire_date" class="form-label">Ngày Nhập</label>
                            <input type="date" name="hire_date" id="edit-hire_date" value="{{ $employee->hire_date }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-salary" class="form-label">Lương</label>
                            <input type="number" step="0.01" name="salary" id="edit-salary" value="{{ $employee->salary }}" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Cập Nhật
                        </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript cập nhật dữ liệu vào modal khi nhấn "Sửa" -->
<!-- @section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");
                const position = this.getAttribute("data-position");
                const department = this.getAttribute("data-department");
                const hire_date = this.getAttribute("data-hire_date");
                const salary = this.getAttribute("data-salary");

                document.getElementById("edit-id").value = id;
                document.getElementById("edit-name").value = name;
                document.getElementById("edit-position").value = position;
                document.getElementById("edit-department").value = department;
                document.getElementById("edit-hire_date").value = hire_date;
                document.getElementById("edit-salary").value = salary;

                document.getElementById("editEmployeeForm").action = `/employees/${id}`;
            });
        });
    });
</script>
@endsection

@endsection -->
