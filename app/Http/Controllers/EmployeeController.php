<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all()->map(function ($employee) {
            $employee->custom_id = $this->generateEmployeeID($employee);
            return $employee;
        });
    
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = ['Nhân sự', 'Kế toán', 'Marketing', 'Kỹ thuật', 'Bán hàng'];
        $positions = ['Nhân viên', 'Trưởng phòng', 'Giám đốc', 'Thực tập sinh'];

        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'department' => 'required',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);
    
        // Kiểm tra nếu đã có một Giám đốc trong phòng ban đó
        if ($request->position === 'Giám đốc') {
            $existingDirector = Employee::where('position', 'Giám đốc')
                                        ->where('department', $request->department)
                                        ->exists(); // Kiểm tra xem có bản ghi nào không
    
            if ($existingDirector) {
                return redirect()->route('employees.index')
                    ->with('error', 'Mỗi phòng ban chỉ được có một Giám đốc!');
            }
        }
    
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Nhân viên đã được thêm.');
    }
    

    

    public function edit(Employee $employee)
    {
        $departments = ['Nhân sự', 'Kế toán', 'Marketing', 'Kỹ thuật', 'Bán hàng'];
        $positions = ['Nhân viên', 'Trưởng phòng', 'Giám đốc', 'Thực tập sinh'];

        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }


    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'department' => 'required',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);
    
        // Kiểm tra nếu có một Giám đốc khác trong cùng phòng ban khi cập nhật
        if ($request->position === 'Giám đốc') {
            $existingDirector = Employee::where('position', 'Giám đốc')
                                        ->where('department', $request->department)
                                        ->where('id', '!=', $employee->id) // Loại trừ chính mình
                                        ->exists();
    
            if ($existingDirector) {
                return redirect()->route('employees.index')
                    ->with('error', 'Mỗi phòng ban chỉ được có một Giám đốc!');
            }
        }
    
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Thông tin nhân viên đã được cập nhật.');
    }
    

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Nhân viên đã bị xóa.');
    }

    public function generateEmployeeID($employee): string
    {
        // Lấy chữ cái đầu của chức vụ (viết hoa)
        $positionInitials = implode('', array_map(function($word) {
            return strtoupper(mb_substr($word, 0, 1));
        }, explode(' ', $employee->position)));

        // Lấy năm nhập công ty
        $year = date('Y', strtotime($employee->hire_date));

        // Tạo ID: VD "GD-2025"
        return "{$positionInitials}-{$year}";
    }


}
