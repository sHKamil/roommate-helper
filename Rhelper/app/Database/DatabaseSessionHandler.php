<?php

// not usied for now

namespace app\Database;

use app\Database\DatabasePDO;

class DatabaseSessionHandler implements \SessionHandlerInterface {
    private $db;

    public function __construct() {
        $this->db = new DatabasePDO;
    }

    public function open(string $savePath, string $sessionName) : bool {
        return true;
    }

    public function close() : bool {
        return true;
    }

    public function read(string $sessionId) : string|false {
        $query = "SELECT session_data FROM sessions WHERE session_id = :sessionId";
        $stmt = $this->db->query($query, [':sessionId' => $sessionId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return ($result) ? $result['session_data'] : '';
    }

    public function write(string $sessionId, string $sessionData) : bool {
        $query = "REPLACE INTO sessions (session_id, session_data, session_timestamp) 
                  VALUES (:sessionId, :sessionData, :timestamp)";
        $stmt = $this->db->query($query, [
            ':sessionId' => $sessionId,
            ':sessionData' => $sessionData,
            ':timestamp' => time()
        ]);

        return ($stmt->rowCount() === 1);
    }

    public function destroy(string $sessionId) : bool {
        $query = "DELETE FROM sessions WHERE session_id = :sessionId";
        $stmt = $this->db->query($query, [':sessionId' => $sessionId]);

        return ($stmt->rowCount() === 1);
    }

    public function gc(int $maxLifetime) : int|false {
        $expiryTime = time() - $maxLifetime;
        $query = "DELETE FROM sessions WHERE session_timestamp < :expiryTime";
        $stmt = $this->db->query($query, [':expiryTime' => $expiryTime]);

        return $stmt->rowCount();
    }
}
