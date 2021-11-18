<?php

class Problem {

    private $status;
    private $datetime;
    private $title;

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus(int $status) {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDatetime(): DateTime {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime(DateTime $datetime) {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function __toString() {
        return 'Problem {' .'Status = ' .$this->status .', \nTitle = \'' 
                .$this->title .'\'' .', Datetime = \'' .$this->datetime .'\'' .'}';
    }

}
