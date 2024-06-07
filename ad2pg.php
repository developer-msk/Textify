<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $text_content = $_POST['text_content'];
    $visibility = $_POST['visibility'];

    // Load user data
    $users = json_decode(file_get_contents('public_data/users/users.json'), true);

    // Check if user exists
    $user_exists = false;
    foreach ($users as $user) {
        if ($user['id'] == $user_id) {
            $user_exists = true;
            break;
        }
    }

    if (!$user_exists) {
        echo "User does not exist";
        return;
    }

    // Prepare text data
    $text_data = [
        "user_id" => $user_id,
        "text_content" => $text_content
    ];

    // Write text data to the appropriate JSON file based on visibility
    switch ($visibility) {
        case 'public':
            $file = 'public_data/texts/public/public_texts.json';
            break;
        case 'private':
            $file = 'public_data/texts/private/private_texts.json';
            break;
        case 'unlisted':
            $file = 'public_data/texts/unlisted/unlisted_texts.json';
            break;
        default:
            echo "Invalid visibility";
            return;
    }

    $texts = json_decode(file_get_contents($file), true);
    $texts[] = $text_data;
    file_put_contents($file, json_encode($texts));

    echo "Text added successfully";
}
?>
