<?php
include '../config.php';


class points
{
    function showpoints($libelle)
    {
                $sql = "SELECT * FROM course WHERE label LIKE '%" . $libelle . "%'";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $courses = $query->fetchAll();
            return $courses;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function upcomingCourse()
    {
        echo date("Y/m/d");
        $sql = "SELECT * FROM course WHERE dateCourse >= '" . date("Y-m-d") . "'";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $courses = $query->fetchAll();
            return $courses;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listCourses()
    {
        $sql = "SELECT * FROM course";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function bookCourse($idCourse, $idsposnors)
    {
        $sql = "INSERT INTO reservation  
        VALUES (NULL, :idsponsors,:idpoints)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idsponsors' => $idsposnors,
                'idCourse' => $idCourse
            ]);
            $course = $this->getCourse($idCourse);
            echo $course['nbPlaces'] - 1;
            $query = $db->prepare(
                'UPDATE course SET nbPlaces = ' . $course['nbPlaces'] - 1
                    . ' WHERE idCourse= ' . $idCourse
            );
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getCourse($id)
    {
        $sql = "SELECT * from course where idCourse = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $course = $query->fetch();
            return $course;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
