Setup:
- `docker compose up`

Routes:
- The base route is `localhost`.
- `GET` to `/` to show all books.
- `GET` to `/show?id=[id]` to show a specific book by id.
- `POST` to `/create?title=[title]&author=[author]&pages=[pages]` to create a new book.
- `PUT/PATCH` to `/update?id=[id]&title=[title]&author=[author]&pages=[pages]` to update an existing book.
- `DELETE` to `/delete?id=[id]` to delete a book by id.