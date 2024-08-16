<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Responses\StudentResponse;
use App\Services\Interfaces\StudentServiceInterface;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Student manager",
 *     version="1.0.0",
 *     description="Documentation for student manager",
 *     @OA\Contact()
 * )
 */
class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentServiceInterface $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * @OA\Get(
     *     path="/api/students",
     *     tags={"Students"},
     *     summary="Get list of student",
     *     description="Returns a list of students",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if($params) {
            $params = $params['values'];

            if (is_null($params[1])) {
                $params = [];
            }
        }

        $students = $this->studentService->getAllStudents($params);
        return StudentResponse::collection($students);
    }

    /**
     * @OA\Get(
     *     path="/api/student/{id}",
     *     tags={"Students"},
     *     summary="Get student by ID",
     *     description="Returns a student by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Student ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Student not found"
     *     )
     * )
     */
    public function show($id)
    {
        $student = $this->studentService->getStudentById($id);

        if ($student) {
            return new StudentResponse($student);
        }

        return response()->json(['message' => 'Student not found'], 404);
    }

    /**
     * @OA\Post(
     *     path="/api/student",
     *     tags={"Students"},
     *     summary="Create a new student",
     *     description="Creates a new student",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string", example="John Doe"),
     *              @OA\Property(property="age", type="integer", example="30"),
     *              @OA\Property(property="grade_first_semester", type="integer", example="5"),
     *              @OA\Property(property="grade_second_semester", type="integer", example="5"),
     *              @OA\Property(property="teacher_id", type="integer", example="1"),
     *              @OA\Property(property="classroom_id", type="integer", example="2"),
     *          )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Invalid data"
     *      )
     * )
     */
    public function store(StoreStudentRequest $request)
    {
        $student = $this->studentService->createStudent($request->validated());
        return new StudentResponse($student);
    }

    /**
     * @OA\Put(
     *     path="/api/student/{id}",
     *     tags={"Students"},
     *     summary="Update an existing student",
     *     description="Updates an existing student",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Student ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string", example="John Doe"),
     *              @OA\Property(property="age", type="integer", example="30"),
     *              @OA\Property(property="grade_first_semester", type="integer", example="5"),
     *              @OA\Property(property="grade_second_semester", type="integer", example="5"),
     *              @OA\Property(property="teacher_id", type="integer", example="1"),
     *              @OA\Property(property="classroom_id", type="integer", example="2"),
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="Invalid data"
     *      ),
     *     @OA\Response(
     *         response=404,
     *         description="Student not found"
     *     )
     * )
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $updated = $this->studentService->updateStudent($id, $request->validated());

        if ($updated) {
            $student = $this->studentService->getStudentById($id);
            return new StudentResponse($student);
        }

        return response()->json(['message' => 'Student not found'], 404);
    }

    /**
     * @OA\Delete(
     *     path="/api/student/{id}",
     *     tags={"Students"},
     *     summary="Delete a student",
     *     description="Deletes a student",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Student ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Student not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $deleted = $this->studentService->deleteStudent($id);

        if ($deleted) {
            return response()->json(['message' => 'Student deleted successfully']);
        }

        return response()->json(['message' => 'Student not found'], 404);
    }
}
