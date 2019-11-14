# think-short-url
### ThinkPHP 短地址生成 扩展包

### 安装
```
$ composer require xiaodi/think-short-url:dev-master
```

### 百度
#### 创建
```php
use ShortUrl\Facade\ShortUrl;

ShortUrl::make('baidu')->create('https://www.baidu.com');
```

#### 还原
```php
use ShortUrl\Facade\ShortUrl;

ShortUrl::make('baidu')->query('https://dwz.cn/JCRnHXWE');
```

#### 删除
```php
use ShortUrl\Facade\ShortUrl;

ShortUrl::make('baidu')->delete('JCRnHXWE');
```

### 新浪
#### 创建
```php
use ShortUrl\Facade\ShortUrl;

ShortUrl::make('sina')->create('https://www.baidu.com');
```

### 快捷助手
```php
// 生成百度短链
shorturl_baidu($url);

// 生成新浪短链
shorturl_sina($url);
```
