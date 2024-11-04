Setup:
- `docker compose up -d`
- `docker exec app bash`
- `composer install`

Info:
- Books have 4 properties: `id`, `title`, `author` and `pages`.
- `id` is automatically generated when a book is created.
- `title` is a string that is required when creating a book.
- `author` is a string that is required when creating a book.
- `pages` is an integer that is required when creating a book.

Routes:
- The base route is `localhost`.
- `GET` to `/books` to show all books.
- `GET` to `/books/show/{id}` to show a specific book by id.
- `POST` to `/books` with properties `title`, `author`, and `pages` in the body to create a new book.
- `PUT/PATCH` to `/books` with `id`, `title`, `author`, and `pages` in the body to update an existing book by its `id`.
- `DELETE` to `/books/{id}` to delete a book by id.

Tests:
- `docker compose up -d`
- `docker exec app bash`
- `composer test`
