Setup:
- `docker compose up`

Routes:
- The base route is `localhost`.
- `GET` to `/` to show all books.
- `GET` to `/show` with an `id` in the body to show a specific book by id.
- `POST` to `/create` with `title`, `author`, and `pages` in the body to create a new book.
- `PUT/PATCH` to `/update` with `id`, `title`, `author`, and `pages` in the body to update an existing book.
- `DELETE` to `/delete` with an `id` in the body to delete a book by id.