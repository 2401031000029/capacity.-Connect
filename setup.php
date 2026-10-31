<?php
// Run once from your browser after importing schema.sql, then delete this file or restrict access.
require_once 'config.php';
try {
 $pdo=db();
 $seed=[
  ['Platform Admin','admin@capacityconnect.local','Admin@123','admin'],
  ['Demo Trainer','trainer@capacityconnect.local','Trainer@123','trainer'],
  ['Demo Trainee','trainee@capacityconnect.local','Trainee@123','trainee'],
 ];
 foreach($seed as $u){$s=$pdo->prepare('SELECT id FROM users WHERE email=?');$s->execute([$u[1]]);if(!$s->fetch()){$s=$pdo->prepare('INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)');$s->execute([$u[0],$u[1],password_hash($u[2],PASSWORD_DEFAULT),$u[3]]);}}
 $s=$pdo->prepare('SELECT id FROM users WHERE email=?');$s->execute(['trainer@capacityconnect.local']);$trainerId=(int)$s->fetchColumn();
 $count=(int)$pdo->query('SELECT COUNT(*) FROM courses')->fetchColumn();
 if($count===0){$seedCourses=[['Web Development Essentials','Technology','Learn the foundations of HTML, CSS and JavaScript. Build responsive pages and understand how the web works.','💻'],['Python Programming','Programming','Practice Python fundamentals, variables, conditions, loops, functions and problem solving.','🐍'],['Data Analysis Basics','Data Science','Discover data preparation, analysis and visualization techniques for turning information into useful insights.','📊'],['Introduction to Artificial Intelligence','Artificial Intelligence','Explore artificial intelligence concepts, machine learning workflows and responsible AI applications.','🤖']];$s=$pdo->prepare('INSERT INTO courses(title,category,description,icon,trainer_id,status) VALUES(?,?,?,?,?,?)');foreach($seedCourses as $c)$s->execute([$c[0],$c[1],$c[2],$c[3],$trainerId,'published']);}
 echo '<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="assets/style.css"><main class="page-shell"><div class="panel setup-success"><h1>Capacity Connect is ready!</h1><p>Demo users have been created and sample courses added if the database was empty.</p><h2>Demo logins</h2><p><b>Admin:</b> admin@capacityconnect.local / Admin@123</p><p><b>Trainer:</b> trainer@capacityconnect.local / Trainer@123</p><p><b>Trainee:</b> trainee@capacityconnect.local / Trainee@123</p><p class="alert error">For local demonstration only. Change these passwords and delete or protect setup.php before deployment.</p><a class="btn btn-primary" href="index.php">Open website →</a></div></main>';
} catch(Throwable $e){http_response_code(500);echo '<h1>Setup failed</h1><p>Make sure MySQL is running, schema.sql has been imported, and config.php has the correct database credentials.</p><pre>'.htmlspecialchars($e->getMessage(),ENT_QUOTES,'UTF-8').'</pre>' ;}
