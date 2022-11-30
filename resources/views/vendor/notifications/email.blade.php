@component('mail::message')
# 仮登録が完了しました。
 
{{ config('app.name') }} への登録ありがとうございます。
 
サービスのログインを有効にするには、
以下のリンクよりご利用のメールアドレスの確認を承認してください。
<?php
$color = match ($level) {
    'success', 'error' => $level,
    default => 'primary',
};
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
メールアドレス認証
@endcomponent
 
@component('mail::panel')
☆ このメールに心当たりがありませんか？<br>
もしお心当たりのない場合、本メールは破棄していただくようお願いいたします
@endcomponent
 
{{ config('app.name') }}
@endcomponent