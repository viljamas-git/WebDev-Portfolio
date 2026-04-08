<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;

header('Content-Type: application/json; charset=utf-8');

// This endpoint only accepts form submissions sent as POST requests.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.',
    ]);
    exit;
}

$firstName = trim((string) ($_POST['first-name'] ?? ''));
$lastName  = trim((string) ($_POST['last-name'] ?? ''));
$email     = trim((string) ($_POST['email'] ?? ''));
$phone     = trim((string) ($_POST['phone'] ?? ''));
$subject   = trim((string) ($_POST['subject'] ?? ''));
$message   = trim((string) ($_POST['message'] ?? ''));

$fieldErrors = [];

// Validate each field and collect errors so the client can show all issues at once.
if ($firstName === '') {
    $fieldErrors['first-name'] = 'First name is required.';
} elseif (mb_strlen($firstName) > 100) {
    $fieldErrors['first-name'] = 'First name must be 100 characters or fewer.';
}

if ($lastName === '') {
    $fieldErrors['last-name'] = 'Last name is required.';
} elseif (mb_strlen($lastName) > 100) {
    $fieldErrors['last-name'] = 'Last name must be 100 characters or fewer.';
}

if ($email === '') {
    $fieldErrors['email'] = 'Email is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fieldErrors['email'] = 'Email format is invalid.';
}

$phonePattern = '/^(\+?\d{1,3}[\s-]?)?(\(?\d{3}\)?[\s-]?)?\d{3}[\s-]?\d{4}$/';

if ($phone === '') {
    $fieldErrors['phone'] = 'Phone number is required.';
} elseif (!preg_match($phonePattern, $phone)) {
    $fieldErrors['phone'] = 'Phone number format is invalid.';
}

if (mb_strlen($subject) > 150) {
    $fieldErrors['subject'] = 'Subject must be 150 characters or fewer.';
}

if ($message === '') {
    $fieldErrors['message'] = 'Message is required.';
} elseif (mb_strlen($message) > 2000) {
    $fieldErrors['message'] = 'Message must be 2000 characters or fewer.';
}

if (!empty($fieldErrors)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please fix the form errors and try again.',
        'fieldErrors' => $fieldErrors,
        'errors' => array_values($fieldErrors),
    ]);
    exit;
}

$apiKey = '';

// Configure the Mailtrap sending client with your API key.
$mailtrap = MailtrapClient::initSendingEmails(
    apiKey: $apiKey
);

$safeSubject = $subject !== '' ? $subject : 'New website contact form submission';
$fullName = trim($firstName . ' ' . $lastName);

// Build a plain-text email body from the sanitized form input.
$textBody = implode("\n", [
    'A new contact form submission was received.',
    '',
    'Name: ' . $fullName,
    'Email: ' . $email,
    'Phone: ' . $phone,
    '',
    'Message:',
    $message,
]);

$mail = (new MailtrapEmail())
    ->from(new Address('hello@demomailtrap.co', 'Mailtrap Test'))
    ->to(new Address(''))
    ->subject($safeSubject)
    ->text($textBody)
    ->category('Integration Test');

$response = $mailtrap->send($mail);

// Return a JSON response for the frontend to handle success UI state.
echo json_encode([
    'success' => true,
    'message' => 'Thanks! Your message has been sent successfully.',
    'mailtrap' => ResponseHelper::toArray($response),
]);
