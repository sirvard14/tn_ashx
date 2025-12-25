<?php 

// ---------- Classes ---------- 

class User { 
    public $name; 
    public $surname; 
    protected $passport; 
    protected $phone; 
    public $age; 

    public function __construct($name, $surname, $passport, $phone, $age) { 
        $this->name = $name; 
        $this->surname = $surname; 
        $this->passport = $passport; 
        $this->phone = $phone; 
        $this->age = $age; 
    } 

    public function getPassport() { 
        return $this->passport; 
    } 

    public function getPhone() { 
        return $this->phone; 
    } 
} 

class Student extends User { 
    public $gpa; 
    public $faculty; 
    public $course; 

    public function __construct($name, $surname, $passport, $phone, $age, $gpa, $faculty, $course) { 
        parent::__construct($name, $surname, $passport, $phone, $age); 
        $this->gpa = $gpa; 
        $this->faculty = $faculty; 
        $this->course = $course; 
    } 
} 

// ---------- Data ---------- 

$students = [ 
    new Student("Անի", "Սարգսյան", "AB123456", "+37499123456", 20, 18.5, "ՏՏ", 2), 
    new Student("Գոռ", "Հակոբյան", "AC987654", "+37444111222", 21, 17.2, "Ֆինանսներ", 3), 
    new Student("Մարի", "Պետրոսյան", "AE111222", "+37477123456", 19, 19.1, "Ինֆորմատիկա", 1) 
]; 

// Եթե ֆորմայի միջոցով լրացվում է նոր Student 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $students[] = new Student( 
        $_POST['name'] ?? '', 
        $_POST['surname'] ?? '', 
        $_POST['passport'] ?? '', 
        $_POST['phone'] ?? '', 
        (int)($_POST['age'] ?? 0), 
        (float)($_POST['gpa'] ?? 0), 
        $_POST['faculty'] ?? '', 
        (int)($_POST['course'] ?? 0) 
    ); 
}
?> 

<!DOCTYPE html> 
<html lang="hy"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Student List</title> 
    <style> 
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; padding: 20px; } 
        table { border-collapse: collapse; width: 80%; margin: auto; background-color: #fff; } 
        th, td { border: 1px solid #999; padding: 10px; text-align: center; } 
        th { background-color: #4CAF50; color: white; } 
        tr:nth-child(even) { background-color: #f2f2f2; } 
        h2, h3 { text-align: center; } 
        form { width: 50%; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; } 
        input { width: 100%; padding: 8px; margin: 5px 0; } 
        input[type="submit"] { background: #4CAF50; color: white; border: none; cursor: pointer; } 
        input[type="submit"]:hover { background: #45a049; } 
    </style> 
</head> 

<body> 

<h2>Student-ների ամբողջական տվյալները</h2> 

<table>  
    <tr> 
        <th>Անուն</th> 
        <th>Ազգանուն</th> 
        <th>Տարիք</th> 
        <th>Հեռախոս</th> 
        <th>Անձնագիր</th> 
        <th>ՄՈԳ</th> 
        <th>Ֆակուլտետ</th> 
        <th>Կուրս</th> 
    </tr> 

    <?php foreach ($students as $s): ?> 
        <tr> 
            <td><?= htmlspecialchars($s->name) ?></td>
            <td><?= htmlspecialchars($s->surname) ?></td>
            <td><?= htmlspecialchars($s->age) ?></td>
            <td><?= htmlspecialchars($s->getPhone()) ?></td>
            <td><?= htmlspecialchars($s->getPassport()) ?></td>
            <td><?= htmlspecialchars($s->gpa) ?></td>
            <td><?= htmlspecialchars($s->faculty) ?></td>
            <td><?= htmlspecialchars($s->course) ?></td>
        </tr> 
    <?php endforeach; ?> 
</table>

