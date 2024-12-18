<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json($student);
    }
    // Create a new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'grade' => 'required|string|max:50',
            'gender' => 'required|string|in:Male,Female',
            'favourite_sports' => 'array',
            'favourite_sports.*' => 'string|max:50',
        ]);

        $student = Student::create([
            'name' => $validated['name'],
            'age' => $validated['age'],
            'grade' => $validated['grade'],
            'gender' => $validated['gender'],
            'favourite_sports' => json_encode($validated['favourite_sports'] ?? []),
        ]);

        return response()->json($student, 201);
    }

    // Update an existing student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer|min:1',
            'grade' => 'sometimes|required|string|max:50',
            'gender' => 'sometimes|required|string|in:Male,Female',
            'favourite_sports' => 'sometimes|array',
            'favourite_sports.*' => 'string|max:50',
        ]);

        $student->update(array_merge(
            $validated,
            ['favourite_sports' => json_encode($validated['favourite_sports'] ?? $student->favourite_sports)]
        ));

        return response()->json($student);
    }

    // Delete a student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
