# 原生PHP电商网站小项目（PHP结课项目）  
## 实现功能
* 网站首页  
  * 登录 
  * 注册
  * 更改密码
  * 购买商品
  * 加购物车
  * 加收藏夹
  * 商品搜索
  * 商品展示
  * 订单签收
  * 订单评价
* 商家界面
  * 登录
  * 注册
  * 更改密码
  * 查看订单
  * 发货
  * 添加/修改商品
* 网站后台管理界面
  * 登录
  * 评论管理
  * 商品管理
  * 订单管理
  * 用户管理
  * 商家管理
  * 网站图片管理

## 开发环境
* 集成软件：XAMPP V3.3.0
* Apache版本：2.4.47
* php版本：V7.4.19
* Mysql版本：Ver 15.1 Distrib 10.4.19-MariaDB


## 数据库
 1. 创建anmai_store数据库
 2. 将anmai_store.sql文件导入数据库
 3. 修改mysql连接配置
     * 修改common/database.php
     * 修改merchant/conn/connectsql_db.php


## 基本文件信息（相对项目根目录）
* 网站首页：index.php
* 商家界面：merchant/index.php
* 网站后台管理界面：admin/index.php

## 商品分类（编码对应0-9）
0-数码  
1-办公  
2-服饰  
3-模玩  
4-食品  
5-箱包  
6-厨具  
7-茶酒  
8-家具  
9-其他
