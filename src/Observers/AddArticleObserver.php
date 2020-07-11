<?php

namespace App\Observers;

use App\Models\Subscribe;

class AddArticleObserver implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        $result = '';
        $subscribeEmails = Subscribe::getEmails();

        foreach ($subscribeEmails as $email) {
            $result .= "Кому: {$email}" . PHP_EOL;
            $result .= "Заголовок письма: На сайте добавлена новая запись: “{$subject->title}”" . PHP_EOL;
            $result .= "Содержимое письма:" . PHP_EOL;
            $result .= "Новая статья: “{$subject->title}”," . PHP_EOL;
            $result .= shortLine($subject->text) . PHP_EOL;
            $result .= "<a href='/articles/{$subject->slug}'>Читать</a>" . PHP_EOL;
            $result .= "--------------------------" . PHP_EOL;
            $result .= "<a href='/unsubscribed/{$email}'>Отписаться от рассылки</a>" . PHP_EOL;
            $result .= "##########################################################################" . PHP_EOL;
        }

        $file = APP_DIR . '/subscribes_log.txt';
        file_put_contents($file, $result, FILE_APPEND);
    }
}