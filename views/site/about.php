<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>

CREATE TABLE `test_state` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (`id`)
);


CREATE TABLE `test_task` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
`state_id` int(11) NOT NULL,
`priority` int(11) DEFAULT NULL,
`description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
`icon` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `test_task_ibfk_1` (`state_id`),
CONSTRAINT `test_task_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `test_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;