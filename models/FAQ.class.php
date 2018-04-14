<?php

class FAQ {

	private $idFAQ;
	private $question;
	private $answer;
	private $idLocation;

    /**
     * FAQ constructor.
     * @param $idFAQ
     * @param $question
     * @param $answer
     */
    public function __construct($idFAQ, $question, $answer, $idLocation)
    {
        $this->idFAQ = $idFAQ;
        $this->question = $question;
        $this->answer = $answer;
        $this->idLocation = $idLocation;
    }

    /**
     * @return mixed
     */
    public function getIdLocation()
    {
        return $this->idLocation;
    }

    /**
     * @param mixed $idLocation
     */
    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }

    /**
     * @return mixed
     */
    public function getIdFAQ()
    {
        return $this->idFAQ;
    }

    /**
     * @param mixed $idFAQ
     */
    public function setIdFAQ($idFAQ)
    {
        $this->idFAQ = $idFAQ;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
}

?>
