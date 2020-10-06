<?php
namespace App\Services;

use App\Models\Test;
use Illuminate\Http\Request;

class TestService extends Service
{
		private $testModel;

		public function __construct(Test $testModel)
    {
				$this->testModel = $testModel;
    }

    public function getTestUnscored(int $test_id)
    {
        return $this->testModel->getTestUnscored($test_id);
    }

		public function createTest($request)
    {
        return $this->testModel->createTest($request);
    }
}
