скопировать репозиторий в папку на компьютере.

## 1 вариант (необходмо запустить только сайт news.local на компьютере):
1. cd proxy
2. docker-compose up -d
3. cd ..
4. docker-compose up -d
5. прописать в файле hosts "127.0.0.1 news.local" 

В результате будет запущен прокси и сайт news.local.

## 2 вариант (необходимо запустить сайт vulnbank и news.local):
1. cd proxy
2. docker-compose up -d
3. cd ..
4. docker run --name vulnbank --network proxy -e VIRTUAL_HOST="vulnbank.local" -p 8080:80 -d vulnbank/vulnbank
5. docker-compose up -d
6. прописать в файле hosts "127.0.0.1 news.local vulnbank.local" 
