<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //return all the course list
    public function courseList()
    {

        //select the fields
        $result = Course::select('name', 'thumbnail', 'lesson_num', 'id')->get();
        // //Different way is 
        // $result = Course::get(['name', 'thumbnail', 'lesson_num', 'id']);
        // $result = Course::get(); //Get All Fields

        try {
            return response()->json([
                'code' => 200,
                'msg' => 'Course List',
                'data' => $result
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 500,
                'msg' => 'Server internal error',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function courseDetail(Request $request)
    {
        $id = $request->id;
        $result = Course::where('id', '=', $id)->select(
            'id',
            'name',
            'description',
            'thumbnail',
            'lesson_num',
            'video_length',
            'price'
        )->first();

        try {
            return response()->json([
                'code' => 200,
                'msg' => 'My course detail is here',
                'data' => $result,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 500,
                'msg' => 'Server internal error',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
