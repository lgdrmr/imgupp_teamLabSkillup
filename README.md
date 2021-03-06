# Imgupp

Imguppは画像をコメントと共に投稿することが可能なSNSです．投稿に対して*Like*をつけることも可能です．
http://imgupp.herokuapp.com/home

## 実装

* テーブルの設計では，各ユーザの情報を格納するものと各投稿の情報を格納するものを用意し，Likeは中間テーブルを用いて表現
* ログイン状態や/homeのページ数などはSession情報として保持
* 各ページで実行するログインチェックや/homeでのページ管理は関数化して，コードを見やすくした

## サイトデザイン

* カードデザインを用いたモダンな見た目
* レスポンシブデザインによりスマホでもPCでも見やすい
* 各種操作ボタンにはツールチップで操作内容が分かりやすい
* 投稿画面は/homeと同じような見た目で投稿前に見た目を確認できる

## 追加したい機能

* 画像の読み込み速度
* キャプションのバリデーションチェック強化(絵文字やスクリプト入力などでデータベースエラーが起こる可能性あり)
* Like関連のJavascriptに画像IDを用いているところ
* /homeでタイトルを押すと1ページ目に戻るようにしたい
* /homeでどこのページにいるのかわかりにくい

## Reference

[チームラボスキルアップ講座](https://team-lab.github.io/skillup/)

## Author

[Tomoki Sawai](https://github.com/tmxdev)
