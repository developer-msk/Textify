<!DOCTYPE html>
<html>
<head>
    <title>Texts List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            padding-left: 500px;
            padding-right: 500px;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            border-left: 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 3px;
        }

        .username {
            font-weight: bold;
            color: #007bff;
        }

        .text-content {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Texts List</h2>
        <ul>
            <?php
            $users = json_decode(file_get_contents('public_data/users/users.json'), true);
            $public_texts = json_decode(file_get_contents('public_data/texts/public/public_texts.json'), true);

            foreach ($public_texts as $text) {
                $username = '';
                foreach ($users as $user) {
                    if ($user['id'] == $text['user_id']) {
                        $username = $user['username'];
                        break;
                    }
                }
                echo '<li>';
                echo '<span class="username">' . $username . '</span>';
                echo '<div class="text-content">' . $text['text_content'] . '</div>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</body>
</html>
