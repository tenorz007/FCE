<?php
use Fce\Repositories\Database\EloquentSemesterRepository;

/**
 * Created by PhpStorm.
 * User: Cheezzy Tenorz
 * Date: 2/22/2016
 * Time: 8:12 PM
 */
class EloquentSemesterRepositoryTest extends TestCase
{
    protected static $semesterRepository;

    /**
     * The basic models that are needed for all tests.
     */
    protected $semester;

    public static function setUpBeforeClass()
    {
        self::$semesterRepository = new EloquentSemesterRepository;
    }

    public function setUp()
    {
        parent::setUp();
        $this->semester = factory(Fce\Models\Semester::class)->create();
    }

    public function testGetSemesters()
    {
        $createdSemesters = factory(Fce\Models\Semester::class, 2)->create();
        $createdSemesters = array_merge(
            [EloquentSemesterRepository::transform($this->semester)['data']],
            EloquentSemesterRepository::transform($createdSemesters)['data']
        );

        $semesters = self::$semesterRepository->getSemesters();

        $this->assertCount(count($createdSemesters), $semesters['data']);
        $this->assertEquals($createdSemesters, $semesters['data']);
    }

    public function testSetCurrentSemester()
    {
        factory(Fce\Models\Semester::class, 2)->create();
        $semester = self::$semesterRepository->setCurrentSemester($this->semester->id);

        $currentSemester = self::$semesterRepository->getCurrentSemester();

        $this->assertTrue($semester);
        $this->assertEquals($this->semester->id, $currentSemester['data']['id']);
    }

    /**
     * @depends testSetCurrentSemester
     */
    public function testGetCurrentSemester()
    {
        factory(Fce\Models\Semester::class, 2)->create();
        self::$semesterRepository->setCurrentSemester($this->semester->id);

        $this->semester = self::$semesterRepository->getCurrentSemester();

        $this->assertTrue($this->semester['data']['current_semester']);
    }

    /**
     * @depends testGetCurrentSemester
     */
    public function testGetCurrentSemesterException()
    {
        $this->setExpectedException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        self::$semesterRepository->getCurrentSemester();
    }

    public function testCreateSemester()
    {
        $attributes = factory(Fce\Models\Semester::class)->make()->toArray();

        $semester = self::$semesterRepository->createSemester($attributes);

        $this->assertArraySubset($attributes, $semester['data']);
    }

    public function testAddQuestionSet()
    {
        $types = ['midterm', 'final', 'other'];
        $questionSets = factory(Fce\Models\QuestionSet::class, 3)->create();
        $questionSets = \Fce\Repositories\Database\EloquentQuestionSetRepository::transform($questionSets)['data'];

        // Check that there are no questionSets in the semester
        $this->assertEmpty($this->semester->questionSets->toArray());

        foreach ($questionSets as $questionSet) {
            self::$semesterRepository->addQuestionSet(
                $this->semester->id,
                $questionSet['id'],
                ['evaluation_type' => array_shift($types)]
            );
        }

        $semesterQuestionSets = \Fce\Repositories\Database\EloquentQuestionSetRepository::transform(
            $this->semester->fresh()->questionSets
        )['data'];

        // Check that the added questionSets are in the semester
        $this->assertNotEmpty($semesterQuestionSets);
        $this->assertCount(count($questionSets), $semesterQuestionSets);
        $this->assertEquals($questionSets, $semesterQuestionSets);
    }

    /**
     * @depends testAddQuestionSet
     */
    public function testGetQuestionSets()
    {
        $questionSet = factory(Fce\Models\QuestionSet::class)->create();
        $questionSet = \Fce\Repositories\Database\EloquentQuestionSetRepository::transform($questionSet)['data'];

        self::$semesterRepository->addQuestionSet(
            $this->semester->id,
            $questionSet['id'],
            ['evaluation_type' => 'midterm']
        );

        $semesterQuestionSet = self::$semesterRepository->getQuestionSets($this->semester->id)[0];
        $this->assertEquals($questionSet['id'], $semesterQuestionSet['id']);
        $this->assertEquals(['evaluation_type' => 'midterm', 'status' => 'Locked'], $semesterQuestionSet['details']);
    }

    /**
     * @depends testAddQuestionSet
     * @depends testGetQuestionSets
     */
    public function testSetQuestionSetStatus()
    {
        $status = 'Open';
        $questionSet = factory(Fce\Models\QuestionSet::class)->create();
        $questionSet = \Fce\Repositories\Database\EloquentQuestionSetRepository::transform($questionSet)['data'];

        self::$semesterRepository->addQuestionSet(
            $this->semester->id,
            $questionSet['id'],
            ['evaluation_type' => 'midterm']
        );
        self::$semesterRepository->setQuestionSetStatus(
            $this->semester->id,
            $questionSet['id'],
            $status
        );

        $semesterQuestionSet = self::$semesterRepository->getQuestionSets($this->semester->id)[0];
        $this->assertEquals($status, $semesterQuestionSet['details']['status']);
    }
}
