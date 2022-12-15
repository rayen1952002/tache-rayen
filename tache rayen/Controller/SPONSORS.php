<?php
include '../config.php';
include '../Model/SPONSORS.php';

class SPONSORS
{
    public function listsponsors()
    {
        $sql = "SELECT * FROM sponsors";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteClient($id)
    {
        $sql = "DELETE FROM sponsors WHERE idsponsor = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addClient($sponsors)
    {
        $sql = "INSERT INTO sponsors 
        VALUES (NULL, :fn,:ln, :ad,:dob)";
        $db = config::getConnexion();
        try {
            print_r($sponsors->getDob()->format('Y-m-d'));
            $query = $db->prepare($sql);
            $query->execute([
                'fn' => $sponsors->getFirstName(),
                'ln' => $sponsors->getLastName(),
                'ad' => $sponsors->getAddress(),
                'dob' => $sponsors->getDob()->format('Y/m/d')
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateClient($client, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE sponsors SET 
                    firstName = :firstName, 
                    lastName = :lastName, 
                    address = :address, 
                    dob = :dob
                WHERE idsponsors= :idsponsors'
            );
            $query->execute([
                'idwponsors' => $id,
                'firstName' => $client->getFirstName(),
                'lastName' => $client->getLastName(),
                'address' => $client->getAddress(),
                'dob' => $client->getDob()->format('Y/m/d')
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showsponsors($id)
    {
        $sql = "SELECT * from sponsors where idsponsors = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $client = $query->fetch();
            return $client;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
