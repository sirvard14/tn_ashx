<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
$errors = [];

// --- 1. Required fields ---
$requiredFields = ['name', 'surname', 'email', 'birthdate', 'phone', 'password', 'password_confirm'];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errors[$field] = 'Դաշտը պարտադիր է լրացման։';
    }
}

// Proceed only if required fields exist
if (empty($errors) && !empty($_POST)) {

    // --- 2. Name & Surname: only letters (Armenian or English) ---
    if (!preg_match('/^[a-zA-Zա-ֆԱ-Ֆ]+$/u', $_POST['name'])) {
        $errors['name'] = 'Անունը կարող է պարունակել միայն տառեր։';
    }

    if (!preg_match('/^[a-zA-Zա-ֆԱ-Ֆ]+$/u', $_POST['surname'])) {
        $errors['surname'] = 'Ազգանունը կարող է պարունակել միայն տառեր։';
    }

    // --- 3. Email format ---
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Էլ. փոստի ֆորմատը սխալ է։';
    }

    // --- 4. Age 18+ check ---
    $birthdate = DateTime::createFromFormat('Y-m-d', $_POST['birthdate']);
    if ($birthdate) {
        $today = new DateTime();
        $age = $birthdate->diff($today)->y;

        if ($age < 18) {
            $errors['birthdate'] = 'Պետք է լինի 18+։';
        }
    }

    // --- 5. Phone format +374 00 000 000 ---
    if (!preg_match('/^\+374\s\d{2}\s\d{3}\s\d{3}$/', $_POST['phone'])) {
        $errors['phone'] = 'Հեռախոսահամարը պետք է լինի "+374 00 000 000" ֆորմատով։';
    }

    // --- 6. Password confirmation ---
    if ($_POST['password'] !== $_POST['password_confirm']) {
        $errors['password_confirm'] = 'Գաղտնաբառերը չեն համընկնում։';
    }
}

if (!empty($errors)) {
    echo "<pre>";
    print_r($errors);
    echo "</pre>";
} elseif (!empty($_POST)) {
    echo "✔ Բոլոր ստուգումները հաջող անցան։";
}
?>

<form method="POST">
    <label>anun : <input type="text" name="name"></label><br>
    <label>azganun: <input type="text" name="surname"></label><br>
    <label>Email: <input type="text" name="email"></label><br>
    <label>cndyan taretiv: <input type="date" name="birthdate"></label><br>
    <label>heraxos: <input type="text" name="phone" placeholder="+374 00 000 000"></label><br>
    <label>gaxtnabar: <input type="password" name="password"></label><br>
    <label>krknel gaxtnabar: <input type="password" name="password_confirm"></label><br>
    <button type="submit">uxarkel</button>
</form>

</body>
</html>
