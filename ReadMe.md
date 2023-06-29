Скопировать репозиторий в папку на компьютере. Все дальнейшие действия совершаются в данной папке.

#### 1 вариант (необходмо запустить только сайт news.local на компьютере):
1. cd proxy
2. docker-compose up -d
3. cd ..
4. docker-compose up -d
5. прописать в файле hosts "127.0.0.1 news.local" 

#### 2 вариант (необходимо запустить сайт vulnbank и news.local):
1. cd proxy
2. docker-compose up -d
3. cd ..
4. docker run --name vulnbank --network proxy -e VIRTUAL_HOST="vulnbank.local" -p 8080:80 -d vulnbank/vulnbank
5. docker-compose up -d
6. прописать в файле hosts "127.0.0.1 news.local vulnbank.local" 

<br><br><br><br><br>
>Код сайта news.local и докер с сайтом vulnbank любезно предоставлены Positive Technologies для изучения PTAF
