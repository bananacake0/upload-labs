<p align="center">
  <img title="portainer" src='img/logo.png' />
</p>

<p align="center">
  <img title="portainer" src='https://img.shields.io/badge/version-0.1-brightgreen.svg' />
  <img title="portainer" src='https://img.shields.io/badge/php-5.*-yellow.svg' />
  <img title="portainer" src='https://img.shields.io/badge/license-MIT-red.svg' />
</p>

---

> **upload-labs** is a PHP-based lab specifically designed to collect various file upload vulnerabilities encountered in penetration testing and CTF challenges. Its goal is to help users gain a comprehensive understanding of file upload vulnerabilities. The project currently includes **20 levels**, each demonstrating a different file upload technique.

## 0x01 Screenshot

#### 1.1 Home Page

![主界面](doc/index.jpg)

#### 1.2 Each Level

![每一关](doc/pass.jpg)

#### 1.3 View Code

![代码](doc/code.jpg)

## 0x02 Install

#### 2.1 Environmental Requirements

If you want to set up the environment yourself, please configure the environment as follows to run each pass properly.

|Configuration items|disposition|description|
|:---|:---|:---|
|operating system|Window or Linux|Windows is recommended, except for Pass-19, which must be under linux, the rest of the passes can be run on Windows|
|PHP version|Recommend 5.2.17|Other versions may cause some passes to not be broken|
|PHP components|php_gd2,php_exif|Some passes rely on these two components|
|Middleware|Set up Apache to connect in moudel mode||

#### 2.3 Docker quick setup

Create an image

```bash
cd upload-labs/docker
docker build -t upload-labs .
```

Create a container

```bash
docker run -d -p 8080:80 upload-labs:latest
```

## 0x03 Summary

#### 3.1 The target machine contains a classification of vulnerability types

![上传漏洞分类](doc/mind-map.png)

#### 3.2 How do I determine the type of upload vulnerability?

![判断上传漏洞类型](doc/sum_up.png)

## 0x04 Thanks

* Credit to [c0ny1](https://github.com/c0ny1) for his work. Using Google translate, i translated to English.
