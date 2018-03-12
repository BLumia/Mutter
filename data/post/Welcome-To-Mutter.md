title: Welcome to Mutter
date: 2018/1/23 14:26:25
updated: 2018/1/30 17:41:16
---

# Welcome to Mutter

[<i class="bl-icon i i-repo"></i> GitHub](https://github.com/BLumia/Mutter)

Whatever you are looking for a scaffold engine which lightweight but easy-to-use, or looking for a blogging platform which is hackable, or just wanna check it out what this project is, welcome to **Mutter** :D

**Mutter** is a lightweight scaffold for blogging and creating web pages. It's free and open source, and it works on any hosts which provides a PHP enviroment[^1] like LAMP, WAMP, LNMP, etc.

When using **Mutter**, you'll got Markdown[^2] support out-of-the-box.

## Getting Start

Mutter is designed to be portable and hackable. We highly recommend you dig into the source code if you really want to use it. If you are interested, follow these steps:

1. Open `index.php` with your favorite code editor
2. Read the code with comments
3. Follow up the comments, edit code, save, run in the browser. simple as that way.

Source of **Mutter** doesn't contains a bunch of complex logic, so take it easy and just read and modify it to fit your use case.

## Blogging Support

For user who wanna use **Mutter** just for blogging, what you should do is get ready for your PHP enviroment (the [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) and [`DOM`](https://secure.php.net/manual/en/book.dom.php) extensions are required), and then just upload the source file and it's done.

All your blog post should put in `data/post` folder, and single page should put in `data/singlepage`. In [Markdown](https://michelf.ca/projects/php-markdown/extra/) format. To hacking into this part, checkout `index.php` and you can see things about `Routing`, `PageGenerator` and `StaticPageGenerator`. BTW, we got not only out-of-the-box markdown support, but also with [Front-Matter](https://hexo.io/docs/front-matter.html) support! So if you are come from Hexo[^3], you can just feel free to put your posts into the `data/post` folder without doing anything special. 

For create theme or modify theme, take a look at `data/static` and you can find the css files and page templete files. There are also a `iconfont.css` provided for use icon fonts. To make your own iconfont pack, checkout [Iconfont](http://www.iconfont.cn/) website by Alibaba.

## Simple Website Creating Support

Since the goal of **Mutter** is a lightweight scaffold website creating engine, it will always make the source tiny and easy to understand.

The code base use a MVC-like structure, the router `Routing` manage the url parsing and routing, and the module `Infra` manage the page's data source and prepare for render, finally it use `TemplateEngine` to render the page. There are some built-in `Infra`s are ready to use for blogging purpose and example purpose. The `TemplateEngine` also support sub-infra so you can also use an `Infra` as a page component like footer and heading-navigator.

To checkout how it works, just dig into the source code, and happy hacking :D

## The End

If you got any problem, reach [**Mutter** on GitHub](https://github.com/BLumia/Mutter) and feel free to open an issue.

Anyway, thank you for trying **Mutter**. Have a nice day~

[^1]: Although I haven't test on other enviroments, it will always works under PHP 5.4+ .
[^2]: Actually **Mutter** is using [Parsedown Extra](https://github.com/erusev/parsedown-extra) which is an extension of [Parsedown](/) that adds support for [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).
[^3]: The front-matter support is depends on the module/Infra implement. And we only support YAML format front-matter. To hacking into this part, checkout `tryYAMLFrontMatter()` in `core/Utils.Function.php` for front-matter parsing and `Infra/PageGenerator.class.php` (and the `StaticPageGenerator` one) for how we use the parsed front-matter.