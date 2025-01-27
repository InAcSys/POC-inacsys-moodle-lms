<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MoodleRest;

class CourseController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255|min:10',
            'shortname' => 'required|string|min:3',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $new_course = array(
            'courses' => array(
                array(
                    'fullname' => $request['fullname'],
                    'shortname' => $request['shortname'],
                    'categoryid' => $request['category_id']
                )
            )
        );

        $rest = new MoodleRest(env('MOODLE_API_URL'), env('MOODLE_API_TOKEN'));
        $rest->request('core_course_create_courses', $new_course, MoodleRest::METHOD_POST);
    }

    public function get_all() {
        $rest = new MoodleRest(env('MOODLE_API_URL'), env('MOODLE_API_TOKEN'));
        $courses = $rest->request('core_course_get_courses');

        return response()->json($courses);
    }

    public function get_by_id(Request $request) {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array|integer|min_length:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $rest = new MoodleRest(env('MOODLE_API_URL'), env('MOODLE_API_TOKEN'));
        $courses = $rest->request('core_course_get_courses', ['ids' => $request['ids']]);

        return response()->json($courses);
    }
}
