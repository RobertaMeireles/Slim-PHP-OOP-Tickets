<?php namespace TicketManager\Models;

use PDO;

class TicketRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getPendent() {
        $sql = "SELECT * FROM tickets WHERE done != 1 ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getArchived() {
        $sql = "SELECT * FROM tickets WHERE done = 1 ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function byId($id) {
        $sql = "SELECT * FROM tickets WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO tickets (
                    title, description, severity, created_at, done
                ) VALUES (
                    :title, :description, :severity, NOW(), 0
                )";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $sql = "DELETE FROM tickets WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }

    public function markAsDone($id) {
        $sql = "UPDATE tickets SET done = 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}