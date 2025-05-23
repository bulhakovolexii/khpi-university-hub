# KhPI University Hub

Дочірня тема для wordpress, що базується на темі University Hub від WEN Themes і є її редизайном з дотриманням корпоративного стилю Національного технічного університету «Харківський політехнічний інститут».

![theme screenshot](./wp-content/themes/khpi-university-hub/screenshot.png)

## Розробка

1. встановити Node.js ([інструкція](https://nodejs.org/en/download/prebuilt-installer));
2. перейти до кореневого каталогу теми;
3. виконати команду `npm install`;
4. для генерації стилів використовується препроцесор SASS в синтаксисі SCSS ([інструкція](https://sass-lang.com/));
5. відстеження змін та збирання `.css` файлів **в процесі розробки**, виконується командою `npm run sass-dev`.

## Локальне середовище розробки (Docker)

Для зручної розробки використовується docker-compose, який автоматично налаштовує WordPress, завантажує дамп бази даних і запускає сервер.

### Запуск

1. Переконатися, що встановлено [Docker](https://docs.docker.com/get-started/get-docker/) та docker-compose.
2. Перейти до кореневого каталогу проєкту.
3. Виконати команду: `docker-compose up -d`
4. Перейти в браузері на <http://localhost:8080>.

> [!important]
> При першому запуску, сервер видасть помилку через відсутність файлів батьківської теми.

### Початкове налаштування

1. Увійти в адмін-панель WordPress (<http://localhost:8080/wp-admin/>) з логіном `admin` та паролем `1111`.
2. В меню “Теми” завантажити батьківську тему University Hub.
3. Активувати дочірню тему KhPI University Hub.

## Збірка

1. встановити Node.js ([інструкція](https://nodejs.org/en/download/prebuilt-installer));
2. перейти до кореневого каталогу теми;
3. виконати команду `npm install`;
4. виконати команду `npm run build`.
