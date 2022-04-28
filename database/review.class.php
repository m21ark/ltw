<?php

declare(strict_types=1);

class Review
{
    public int $id;
    public int $score;
    public string $text;
    public DateTime $date;
    // also photo


    public function __construct(int $id, int $score, string $text, string $date)
    {
        // TODO : ADAPT THE DATETIME LATTER ::: THE DB CONTAINS AN ERROR (epecho mode not set)

        $this->id = $id;
        $this->score = $score;
        $this->text = $text;
        $this->date = new DateTime($date);
    }
}

    // TODO:: GET REVIEW MEDIUM FOR A RESTURANT
