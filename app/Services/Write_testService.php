<?php
namespace App\Services;

use App\Models\Write_test;
use Illuminate\Http\Request;

class Write_testService extends Service
{
		private $write_testModel;

		public function __construct(Write_test $write_testModel)
    {
        $this->write_testModel = $write_testModel;
    }

		public function serchTest(int $test_id, int $question_number)
    {
        return $this->write_testModel->serchTest($test_id, $question_number);
    }
}
