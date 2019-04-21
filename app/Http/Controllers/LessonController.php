<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonController extends BaseApiController
{
    /**
     * @var \App\Transformer\LessonTransformer
     */
    protected $lessonTransformer;

    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();

        return $this->respond([
            'data' => $this->lessonTransformer->transformCollection($lessons->toArray()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! $request->title || ! $request->body) {
            return $this
                ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->respondWithError('Parameter failed validation for a lesson.');
        }

        Lesson::create($request->merge(['some_bool' => 1])->all());

        return $this->responseCreated('Lesson successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (! $lesson) {
            return $this->responseNotFound('Lesson does not exist.');
        }

        return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson->toArray()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
