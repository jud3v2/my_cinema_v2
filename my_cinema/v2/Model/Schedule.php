<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Model.php';
class Schedule extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function getSchedule($limit): false|array
    {
        $query = $this->database->prepare("SELECT * FROM cinema.movie
            JOIN cinema.movie_schedule ON cinema.movie.id = cinema.movie_schedule.id_movie
            JOIN cinema.room ON cinema.movie_schedule.id_room = cinema.room.id WHERE cinema.movie.duration != 0 ORDER BY  movie_schedule.date_begin DESC LIMIT $limit");
        $query->execute();
        return $query->fetchAll();
    }

    public function getScheduleById($id): mixed
    {
        $query = $this->database->prepare("SELECT * FROM movie_schedule WHERE id = :id");
        $query->execute([
            "id" => $id
        ]);
        return $query->fetch();
    }

    public function getScheduleByDate($date): false|array
    {
        $query = $this->database->prepare("SELECT * FROM movie_schedule WHERE date_begin = :date");
        $query->execute([
            "date" => $date
        ]);
        return $query->fetchAll();
    }
    public function getScheduleByRoomID($id_room): false|array
    {
        $query = $this->database->prepare("SELECT * FROM movie_schedule WHERE id_room = :id_abo");
        $query->execute([
            "id_abo" => $id_room
        ]);
        return $query->fetchAll();
    }

    public function getScheduleByMovieID($id): false|array
    {
        $query = $this->database->prepare("SELECT * FROM movie_schedule WHERE id_movie = :id");
        $query->execute([
            "id" => $id
        ]);
        return $query->fetchAll();
    }

        public function  joindMovieAndRoomWithTitleOfMovie($title): false|array
        {
                $query = $this->database->prepare("SELECT * FROM cinema.movie
            JOIN cinema.movie_schedule ON cinema.movie.id = cinema.movie_schedule.id_movie
            JOIN cinema.room ON cinema.movie_schedule.id_room = cinema.room.id
            WHERE cinema.movie.title LIKE :title");
                $query->execute(['title' => $title]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
        }
}