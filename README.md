# About Mutter

**Mutter** is a lightweight scaffold for blogging and creating web pages. It's free and open source, and it works on any hosts which provides a PHP enviroment<sup>[1](#fn1)</sup> like LAMP, WAMP, LNMP, etc.

When using **Mutter**, you'll got Markdown<sup>[2](#fn2)</sup> support out-of-the-box.

Mutter is designed to be portable and hackable. We highly recommend you dig into the source code if you really want to use it. If you are interested, follow these steps:

1. Open `index.php` with your favorite code editor
2. Read the code with comments
3. Follow up the comments, edit code, save, run in the browser. simple as that way.

Source of **Mutter** doesn't contains a bunch of complex logic, so take it easy and just read and modify it to fit your use case.

## Dependents

If you are willing to use **Mutter** as a lightweight scaffold system, there are no extra requirement for your developmemt enviroment. But for the current default status of **Mutter**, it's a blogging system and we are using some commonly used modules, they are [DOM](https://secure.php.net/manual/en/book.dom.php) (for ParsedownExtra) and [mbstring](https://secure.php.net/manual/en/book.mbstring.php) (for UTF-8 support). Check out the links for details.

## License

**Mutter** licensed under MIT License.

------

<a name="fn1">1</a>: Although I haven't test on other enviroments, it will always works under PHP 5.4+ .  
<a name="fn2">2</a>: Actually **Mutter** is using [Parsedown Extra](https://github.com/erusev/parsedown-extra) which is an extension of [Parsedown](/) that adds support for [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).