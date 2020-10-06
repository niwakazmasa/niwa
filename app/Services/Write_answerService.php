<?php
namespace App\Services;

use App\Models\Write_answer;
use Illuminate\Http\Request;

class Write_answerService extends Service
{
		private $write_answerModel;

		public function __construct(Write_answer $write_answerModel)
    {
				$this->write_answerModel = $write_answerModel;
    }

		public function getUnscored()
    {
         return $this->write_answerModel->getUnscored();
    }

		public function getWriteAnswer(int $id)
    {
        return $this->write_answerModel->getWriteAnswer($id);
    }

		public function getUsersWriteAnswer(int $user_id, int $test_id)
    {
        return $this->write_answerModel->getUsersWriteAnswer($user_id, $test_id);
    }

		public function getEditWriteAnswer(int $user_id, int $test_id, int $question_number)
    {
        return $this->write_answerModel->getEditWriteAnswer($user_id, $test_id, $question_number);
    }

		public function editWrite_answer(Write_answer $write_answer, int $judgment)
    {
      	return $this->write_answerModel->editWrite_answer($write_answer,$judgment);
    }
}
