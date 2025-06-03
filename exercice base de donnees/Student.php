<?php
class Student {
    private $repository;

    public function __construct(PDO $pdo) {
        $this->repository = new Repository($pdo, 'student');
    }

    public function getStudentsBySection($sectionId) {
        $stmt = $this->repository->pdo->prepare("SELECT * FROM student WHERE section_id = :section_id");
        $stmt->execute(['section_id' => $sectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}