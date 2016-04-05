<?php

/* [Created by SkaeX @ 2016-03-07 12:27:23]
*/

use Fce\Http\Controllers\QuestionController;
use Fce\Http\Requests\QuestionRequest;
use Fce\Repositories\Contracts\QuestionRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestionControllerTest extends TestCase
{
    protected $repository;
    protected $controller;

    public function setUp()
    {
        parent::setUp();
        $this->repository = $this->getMockBuilder(QuestionRepository::class)->getMock();
        $this->controller = new QuestionController($this->repository);
    }

    public function testIndex()
    {
        $this->repository->expects($this->once())
            ->method('getQuestions');

        $this->controller->index();
    }

    public function testIndexException()
    {
        $this->repository->expects($this->once())
            ->method('getQuestions')
            ->will($this->throwException(new Exception));

        $this->assertEquals(
            $this->controller->respondInternalServerError('Could not list questions'),
            $this->controller->index()
        );
    }

    public function testIndexNotFoundException()
    {
        $this->repository->expects($this->once())
            ->method('getQuestions')
            ->will($this->throwException(new ModelNotFoundException));

        $this->assertEquals(
            $this->controller->respondNotFound('Could not find any questions'),
            $this->controller->index()
        );
    }

    public function testShow()
    {
        $this->repository->expects($this->once())
            ->method('getQuestionById')->with(parent::ID);

        $this->controller->show(parent::ID);
    }

    public function testShowNotFoundException()
    {
        $this->repository->expects($this->once())
            ->method('getQuestionById')->with(parent::ID)
            ->will($this->throwException(new ModelNotFoundException));

        $this->assertEquals(
            $this->controller->respondNotFound('Could not find question'),
            $this->controller->show(parent::ID)
        );
    }

    public function testShowException()
    {
        $this->repository->expects($this->once())
            ->method('getQuestionById')->with(parent::ID)
            ->will($this->throwException(new Exception));

        $this->assertEquals(
            $this->controller->respondInternalServerError('Could not show question'),
            $this->controller->show(parent::ID)
        );
    }

    public function testCreate()
    {
        $request = new QuestionRequest;

        $this->repository->expects($this->once())
            ->method('createQuestion')
            ->with($request->description, $request->category, $request->title);

        $this->controller->create($request);
    }

    public function testCreateException()
    {
        $request = new QuestionRequest;

        $this->repository->expects($this->once())
            ->method('createQuestion')
            ->with($request->description, $request->category, $request->title)
            ->will($this->throwException(new Exception));

        $this->assertEquals(
            $this->controller->respondInternalServerError('Could not create question'),
            $this->controller->create($request)
        );
    }
}