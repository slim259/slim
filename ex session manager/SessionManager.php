<?php
class SessionManager {
    private $sessionName = 'app_session';

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[$this->sessionName])) {
            $_SESSION[$this->sessionName] = [
                'visit_count' => 0,
                'first_visit' => date('Y-m-d H:i:s')
            ];
        }
    }

    public function incrementVisit() {
        $_SESSION[$this->sessionName]['visit_count']++;
    }

    public function getVisitCount() {
        return $_SESSION[$this->sessionName]['visit_count'];
    }

    public function getWelcomeMessage() {
        $count = $this->getVisitCount();

        if ($count === 1) {
            return "Bienvenue à notre plateforme";
        } else {
            return "Merci pour votre fidélité, c'est votre {$count}ème visite";
        }
    }

    public function resetSession() {
        $_SESSION[$this->sessionName] = [
            'visit_count' => 0,
            'first_visit' => date('Y-m-d H:i:s')
        ];
        session_regenerate_id(true);
    }

    public function getSessionData() {
        return $_SESSION[$this->sessionName];
    }
}
?>