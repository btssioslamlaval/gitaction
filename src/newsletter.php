<?php

function isAdult(int $age): bool {
    return $age >= 18;
}

function isValidEmail(string $email): bool {
    $email = trim($email);
    return $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
