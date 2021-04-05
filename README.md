<h1>Blog - Test</h1>
<p></p>
<h3>Requirements</h3>
<ol>
    <li>PHP 7</li>
    <li>Composer 2</li>
    <li>MySql</li>
</ol>
<p></p>
<h3>Installation</h3>
<ol>
    <li>git clone https://github.com/nicohs103/blog.git</li>
    <li>cd blog</li>
    <li>composer install</li>
    <li>cp .env.example .env</li>
    <li>edit database in .env</li>
    <li>php artisan key:generate</li>
    <li>composer migrate --seed</li>
    <li>php artisan serve</li>
    <li>got to http://127.0.0.1:8000</li>
</ol>
<p></p>
<h4>Admins user:</h4>
<p>user: admin@admin.com<br/>pass: admin</p>
<p></p>
<h3>Posts Importer:</h3>
<p>Config your server to run 'php artisan schedule:run' every minute OR</p>
<p>Execute in command line '<strong>php artisan GetExternalPosts</strong>'</p>
<p></p>
