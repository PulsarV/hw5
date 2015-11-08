<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 1:10
 */

namespace Entity;

class Book extends AbstractEntity
{
    private $isbn;
    private $author;
    private $title;
    private $price;

    /**
     * Book constructor.
     * @param $isbn
     * @param $author
     * @param $title
     * @param $price
     */
    public function __construct($isbn, $author, $title, $price)
    {
        $this->isbn = $isbn;
        $this->author = $author;
        $this->title = $title;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}