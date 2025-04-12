<?php
require_once 'includes/config.php';
require_once 'includes/db.php';

$db = new Database();
$questions = $db->getActiveQuestions();
$success = isset($_GET['success']) ? $_GET['success'] : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kejutan Ulang Tahun untuk <?= FRIEND_NAME ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="surprise-container">
        <div id="letter-closed">
            <p>Klik untuk membuka surat!</p>
        </div>
        
        <div id="open-card">
            <h1>Selamat Ulang Tahun!</h1>
            <h2>🎂 <?= FRIEND_NAME ?> 🎂</h2>
            
            <div id="cake-container">
                <div id="candle"></div>
                <div id="flame"></div>
                <img id="cake" src="assets/images/cake.png" alt="Kue Ulang Tahun">
            </div>
            
            <div id="message">
                <p>Hai <?= FRIEND_NAME ?>,</p>
                <p>Selamat ulang tahun yang ke-<?= FRIEND_AGE ?> ya! Semoga di usia yang baru ini kamu diberikan kesehatan, kebahagiaan, dan kesuksesan selalu.</p>
                <p>Wish you a happy birthday and a prosperous life ahead!, Kamu sudah hebat sejauh ini, Lanjutkan adel. Aku tau kamu bisa menghadapi segala tantangan yang ada di hidupmu.🎉</p>
                <p>Salam hangat dari ku Zaidan.</p>
            </div>
            
            <button id="music-btn">🎵 Putar Musik</button>
            <button id="confetti-btn">🎊 Luncurkan Konfeti!</button>
            <button id="message-btn">💌 Tulis Pesan</button>
        </div>
    </div>

    <!-- Popup Message Form -->
    <div id="message-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h3>Tulis Pesan Mu disini (Jawaban Tidak akan tersimpan)</h3>
            <form action="messages/submit.php" method="post">
                <input type="text" name="sender_name" placeholder="Namamu" required>
                <?php foreach ($questions as $index => $question): ?>
                    <div class="question">
                        <p><?= $question['question_text'] ?></p>
                        <textarea name="answers[<?= $question['id'] ?>]" placeholder="Jawabanmu..." required></textarea>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Kirim Pesan</button>
            </form>
        </div>
    </div>

    <!-- Success Popup -->
    <?php if ($success): ?>
    <div id="success-popup" class="popup show">
        <div class="popup-content">
            <p>🎉 Pesanmu berhasil terkirim! Terima kasih!</p>
            <button class="close-success-btn">Tutup</button>
        </div>
    </div>
    <?php endif; ?>

    <audio id="birthday-song" src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" loop></audio>
    <script src="assets/js/script.js"></script>
    
    
</body>
</html>