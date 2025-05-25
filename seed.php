<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/*
require_once "Connectdb64.php";

// List of 20 genuine Indian male names
$names = [
    "Aarav", "Vivaan", "Arjun", "Aditya", "Dhruv",
    "Reyansh", "Rohan", "Karan", "Anirudh", "Siddharth",
    "Pranav", "Manav", "Aryan", "Krish", "Shaurya",
    "Yash", "Ishaan", "Lakshya", "Vihaan", "Tanish"
];

// Sample confessions
$sampleConfessions = [
    "I was 22 when I found myself entangled in a relationship that dimmed my spirit. He was older, controlling, and I lost touch with who I was. The breaking point came when he asked my mother for my late grandmother's ring to propose. My gut reaction was a resounding No! That moment was my awakening. I embarked on a journey of self-love, dining alone, attending concerts solo, and rediscovering my worth. Then, I met Ben on a dating app. Our connection was instant, leading me to move from California to Sydney within four months. Now, I wake up every day feeling cherished and free, living a life I once thought was unattainable.​",
    "Our paths crossed during rehearsals for a musical in Sydney. Lachlan and I bonded over our shared love for surfing and skateboarding. When he had to leave the show due to an injury, we continued our connection through long video calls. One evening, he invited me to dinner, and during a walk on Maroubra beach, we shared our first kiss. Weeks later, he said, I love you during a phone call. It took me days to gather the courage to say it back. Despite the challenges of long-distance as we pursued our careers in musical theatre, our love endured. Now, we're co-starring in a production together, our love story coming full circle.",
    "I never imagined that a simple Uber Pool ride would change my life. Mark and I started chatting during the ride, and by the end, we had exchanged numbers. Our connection grew stronger with each date, and eventually, we realized we were meant for each other. Sometimes, love finds you in the most unexpected places.​",
    "I met Alyssa on Tumblr, a platform where I found solace and inspiration. Our connection grew through regular FaceTime calls and texts, despite the 4,678-mile distance between the UK and Texas. After months of waiting, we finally met in London, and our bond translated seamlessly to real life. Alyssa eventually moved to the UK to pursue her master's degree, and together, we now promote LGBTQ+ equality and mental wellbeing. Our love story is a testament to the serendipity of online connections and the incredible happiness they can bring.",
    "I found myself confiding in a friend, sharing intimate details of my life and relationship. Our emotional connection deepened, blurring boundaries. While we never crossed the physical line, the emotional betrayal felt just as profound. My partner noticed my changed demeanor, but I denied any wrongdoing. The guilt of emotional infidelity lingered, affecting our bond.",
    "I met Vince on a dating app, and our connection was immediate. Within two weeks, we confessed our love for each other and decided to delete the app. One day, while driving to a wedding, Vince started tearing up, expressing how happy he was with me. I secretly recorded the moment, capturing his heartfelt words. Sharing it on TikTok, the video went viral, resonating with many. Our love story reminds me that sometimes, the most genuine moments are the ones that touch hearts the deepest.",
    "I was 26 when I met him at a community event. His charm was undeniable, and our connection felt instantaneous. We spent countless evenings discussing our dreams, planning a future together. After six years, I discovered he wasn't who he claimed to be. He was an undercover officer, and our entire relationship was part of his assignment. He even attended my father's funeral under his false identity. The betrayal shattered my sense of reality, leaving me questioning every memory we shared",
    "While my partner was away on a business trip, I engaged in intimate conversations with someone I met online. What started as harmless flirtation escalated, leading to explicit exchanges. The guilt consumed me, especially when I saw the trust in my partner's eyes upon their return. I never confessed, but the weight of my secret continues to burden me.",
    "I met her during our freshman year of college. She was the kind of person who lit up every room she entered. We shared classes, study sessions, and countless late-night conversations. My feelings for her grew with each passing day, but I was too afraid to risk our friendship. After graduation, she moved to another city, and we gradually lost touch. Years later, I saw her wedding photos on social media. My heart sank, not because she was happy, but because I realized I had missed my chance. I often wonder what could have been if I had just told her how I felt.",
    "We met online, and our conversations quickly turned into late-night calls and shared playlists. He spoke of love and a future together, and I believed every word. After six months, we decided to meet in person. He insisted on meeting at a secluded spot, and I agreed. That night, he drugged me and stole my belongings, including my grandmother's heirloom necklace. I reported the incident, but he vanished without a trace. The emotional scars linger, making it hard to trust again.",
    "In high school, I developed a crush on my best friend. We did everything together—studied, hung out, and confided in each other. I wrote her a letter confessing my feelings but never had the courage to give it to her. Years later, I found out she had feelings for me too but thought I didn't feel the same. We both moved on, but I still have that unsent letter tucked away, a reminder of what might have been.​",
    "Working late nights with a charming colleague led to an unexpected office romance. We kept our interactions discreet, but the thrill of secrecy added to the allure. Eventually, my partner sensed the distance between us, leading to constant arguments. I never admitted my infidelity, but the strain on our relationship was evident.​",
    "After moving into our new home, I noticed my husband spending a lot of time helping our neighbor, Lauren. He assured me it was just neighborly assistance, but something felt off. One afternoon, I came home early and saw them embracing on her porch. The sight was a dagger to my heart. Confronting him led to denials and gaslighting. Eventually, he admitted to the affair, and we separated. The betrayal from someone I trusted implicitly left me questioning my judgment",
    "She was the lead singer in our college band, and I was the guitarist. Our chemistry on stage was undeniable, and we spent countless hours rehearsing and performing together. I fell for her, but I was too scared to disrupt our dynamic. After college, she pursued a solo career and moved away. I still listen to our old recordings, her voice reminding me of the love I never confessed.",
    "I began writing to an inmate, Matthew, as part of a pen-pal program. Over time, our letters turned into love notes, and I found myself emotionally invested. We planned a future together, even setting a wedding date for his release. I moved closer to the prison, eagerly awaiting our new life. Then, without warning, he stopped responding. I later discovered he had started a relationship with another woman upon his release. The realization that I had been a placeholder shattered me",
    "We were lab partners in our biology class. She was brilliant, kind, and had a laugh that made even the dullest lectures enjoyable. We spent hours studying together, and my feelings for her grew. I planned to tell her after finals, but she transferred to another university. I never saw her again, and I regret not telling her how I felt when I had the chance.",
    "Being in the film industry, I was accustomed to on-screen romances, but ours felt real. He was charismatic, and our chemistry was undeniable. We kept our relationship private, but rumors began to swirl about his involvement with another actress. He denied them, assuring me of his loyalty. However, the tabloids soon published photos of them together, confirming my fears. The betrayal was not just personal but public. I had to navigate heartbreak under the scrutiny of the media.",
    "Every evening, we would take walks around campus, talking about everything and nothing. I cherished those moments and fell in love with her during those strolls. I wanted to tell her but feared ruining our friendship. After graduation, we went our separate ways. I still think about those walks and wonder if she ever felt the same.​",
    "During my best friend's stag weekend in Portugal, I met a vibrant holiday representative. One thing led to another, and we ended up in bed together. Initially, I convinced myself it was a one-time lapse, but I continued the affair in secret. When my girlfriend discovered incriminating texts, I was forced to admit my betrayal. The guilt and regret have haunted me ever since. ",
    "I had been married for several years when I started an affair with a colleague. At the time, I justified my actions by blaming marital dissatisfaction. Looking back, I realize I betrayed a partner who had always shown me love and commitment. The affair caused immense pain and irreparable damage to our relationship."
];

foreach ($names as $index => $username) {
    $confession = $sampleConfessions[$index];
    $type = 'public';
    $likes = rand(0, 50);
    $views = rand(10, 100);
    $gender = 'male';
    $time = date('Y-m-d H:i:s', strtotime("-$index days"));

    //$email = strtolower($username) . "@example.com";
    $email = strtolower($username) . rand(1000, 9999) . "@example.com";

    $password = password_hash("defaultpassword", PASSWORD_DEFAULT);

    // 1. Insert into user64 table
    $stmtUser = $conn->prepare("INSERT INTO user64 (username, email, password, gender) VALUES (?, ?, ?, ?)");
    $stmtUser->bind_param("ssss", $username, $email, $password, $gender);
    $stmtUser->execute();

    // 2. Get the last inserted sr_no
    $userSrNo = $conn->insert_id;

    // 3. Insert into confession table (use sr_no as foreign key)
    $stmtConfession = $conn->prepare("INSERT INTO confession (sr_no, username, confession, type, likes, views, gender, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtConfession->bind_param("isssisss", $userSrNo, $username, $confession, $type, $likes, $views, $gender, $time);
    $stmtConfession->execute();
}


echo "✅ Seeded 20 confessions and users successfully.";
*/
?>