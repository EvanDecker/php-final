Setup:
- `docker compose up`

Routes:
- The base route is `localhost`.
- `GET` `/` to show all books.
- `GET` `/show?id=[id]` to show a specific book by id.
- `POST` `/create?title=[title]&author=[author]&pages=[pages]` to create a new book.
- `PUT/PATCH` `/update?id=[id]&title=[title]&author=[author]&pages=[pages]` to update an existing book.
- `DELETE` `/delete?id=[id]` to delete a book by id.