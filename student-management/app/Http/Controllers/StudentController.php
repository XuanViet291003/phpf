<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'name');
        $order = $request->get('order', 'asc');
        $search = $request->get('search', '');

        $query = Student::query();

        if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('major', 'like', "%$search%")
              ->orWhere('age', 'like', "%$search%");
        });
        }

        $students = $query->orderBy($sortBy, $order)->paginate(10);
        return response()->json($students);
    }

    public function search(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
        //     'email' => 'required|email|unique:students,email',
        // ]);
        // $query = Student::query();

        // if ($request->has('name')) {
        //     $query->where('name', 'like', '%' . $request->name . '%');
        // }
        // if ($request->has('email')) {
        //     $query->where('email', 'like', '%' . $request->email . '%');
        // }

        // return response()->json($query->get());
    }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1',
            'major' => 'required|string|max:255',
        ],[
            'name.regex' => 'Names must contain only letters and spaces.',
        ]);

        $student = Student::create($validated);
        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'sometimes|email|unique:students,email,'.$id,
            'age' => 'sometimes|integer|min:1',
            'major' => 'sometimes|string|max:255',
        ]);

        $student->update($validated);
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ]);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted']);
    }
}