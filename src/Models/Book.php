<?php
namespace App\Models;

class Book {
	protected string $isbn;
	protected string $title;
	protected int $authorId;
	protected ? string $edition;

	public function getIsbn() {
		return $this->isbn;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getAuthorId() {
		return $this->authorId;
	}
	public function getEdition() {
		return $this->edition;
	}

	public function setIsbn($isbn) {
		$this->isbn = $isbn;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setAuthor($author) {
		$this->author = $author;
	}
	public function setEdition($edition) {
		$this->edition = $edition;
	}
}