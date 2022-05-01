<?php

declare(strict_types=1);

class Review
{
    public int $id;
    public int $score;
    public string $text;
    public DateTime $date;
    public string $reviewer;


    public function __construct(int $id, int $score, string $text, string $date, string $reviewer)
    {
        // TODO : ADAPT THE DATETIME LATTER ::: THE DB CONTAINS AN ERROR (epecho mode not set)

        $this->id = $id;
        $this->score = $score;
        $this->text = $text;
        $this->date = new DateTime($date);
        $this->reviewer = $reviewer;
    }

    public function getReviewerName(PDO $db) : string
    {
        $stmt = $db->prepare('
            SELECT DISTINCT username
            FROM User
            WHERE UserId = ?
        ');

        $stmt->execute(array($this->reviewer));

        return $stmt->fetch()['username'];
    }
}

