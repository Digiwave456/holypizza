<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'messageContent' => $request->message
        ];

        try {
            // Проверяем настройки почты перед отправкой
            $mailConfig = [
                'driver' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'username' => config('mail.mailers.smtp.username'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name')
            ];

            Log::info('Mail configuration check', $mailConfig);

            // Проверяем наличие пароля
            if (empty(config('mail.mailers.smtp.password'))) {
                throw new \Exception('SMTP password is not configured');
            }

            // Отправляем письмо пользователю
            Mail::send('emails.feedback', $data, function($message) use ($data) {
                $message->from(config('mail.from.address'), config('mail.from.name'))
                       ->to($data['email'])
                       ->subject('Спасибо за обратную связь - HolyPizza');
            });

            Log::info('User feedback email sent successfully', [
                'to' => $data['email'],
                'name' => $data['name']
            ]);

            // Отправляем уведомление администратору
            Mail::send('emails.feedback', $data, function($message) use ($data) {
                $message->from(config('mail.from.address'), config('mail.from.name'))
                       ->to(config('mail.from.address'))
                       ->subject('Новое сообщение обратной связи - HolyPizza');
            });

            Log::info('Admin notification email sent successfully', [
                'to' => config('mail.from.address')
            ]);

            return back()->with('success', 'Спасибо за ваше сообщение! Мы свяжемся с вами в ближайшее время.');
        } catch (\Swift_TransportException $e) {
            Log::error('SMTP Connection Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data,
                'mail_config' => $mailConfig ?? []
            ]);

            return back()->with('error', 'Ошибка подключения к почтовому серверу. Пожалуйста, проверьте настройки SMTP.');
        } catch (\Exception $e) {
            Log::error('Error sending feedback email', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data,
                'mail_config' => $mailConfig ?? []
            ]);

            return back()->with('error', 'Произошла ошибка при отправке сообщения: ' . $e->getMessage());
        }
    }
} 