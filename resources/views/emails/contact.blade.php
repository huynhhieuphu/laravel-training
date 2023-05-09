<h1 style="text-align: center">[Mail trong Laravel] Thông tin liên hệ</h1>
<h2>Người gửi: {{ $fullName ?? false }}</h2>
<h2>E-mail: {{ $email ?? false }}</h2>
<h3 style="text-align: center">Tiêu đề: {{ $subject ?? false }}</h3>
<h4>Nội dung: </h4>
<p>{{ $content ?? false }}</p>
